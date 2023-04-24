<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    // Admin
    $routes->group('admin', ['filter' => 'isAdmin', 'namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');
        $routes->presenter('fasilitas');
        $routes->presenter('kamar');
        $routes->presenter('karyawan');
        $routes->presenter('penghuni');
        $routes->group('penyewaan', ['filter' => 'isAdmin'], static function ($routes) {
            $routes->get('/', 'Admin\PenyewaanController::index');
            $routes->get('detail_penyewaan/(:num)', 'Admin\PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'Admin\PenyewaanController::pembayaran_detail/$1');
            $routes->get('bayar/(:num)', 'Admin\PenyewaanController::pay/$1');
        });
    });

    //Karyawan
    $routes->group('karyawan', ['filter' => 'isKaryawan', 'namespace' => 'App\Controllers\Karyawan'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');
        $routes->presenter('karyawan');
        $routes->presenter('penghuni');
        $routes->presenter('kamar');
        $routes->group('penyewaan', ['filter' => 'isKaryawan'], static function ($routes) {
            $routes->get('/', 'Karyawan\PenyewaanController::index');
            $routes->get('detail_penyewaan/(:num)', 'Karyawan\PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'Karyawan\PenyewaanController::pembayaran_detail/$1');
            $routes->get('bayar/(:num)', 'Karyawan\PenyewaanController::pay/$1');
        });
    });

    // Penghuni
    $routes->group('penghuni', ['filter' => 'isPenghuni', 'namespace' => 'App\Controllers\Penghuni'], static function ($routes) {
        $routes->get('', 'kamar::index');
        $routes->presenter('penghuni');
        $routes->presenter('penyewaandetail');
        $routes->group('penyewaan', ['filter' => 'isPenghuni'], static function ($routes) {
            $routes->get('/', 'Penghuni\PenyewaanController::index');
            $routes->post('/', 'Penghuni\PenyewaanController::save');
            $routes->get('detail_penyewaan/(:num)', 'Penghuni\PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'Penghuni\PenyewaanController::pembayaran_detail/$1');
            $routes->get('bayar/(:num)', 'Penghuni\PenyewaanController::pay/$1');
        });
    });

    $routes->post('/penyewaan_detail/buatNoInvoice', 'paymentController::buatNoInvoice');
    $routes->post('/penyewaan_detail/payMidtrans', 'paymentController::payMidtrans');
    $routes->post('/penyewaan_detail/payment', 'paymentController::payment');
    $routes->post('/kamar/detailKamar', 'Kamar::detailKamar');
});

$routes->presenter('dashboard');

// login
// $routes->get('/admin', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('/payment', 'Payment::index');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('registerProcess', 'Auth::registerProcess');
$routes->post('/resetProses', 'Auth::resetProses');
$routes->post('/resetpwProses', 'Auth::resetpwProses');
$routes->get('/logout', 'Auth::logout');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
