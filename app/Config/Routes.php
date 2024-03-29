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
        $routes->presenter('denah');
        $routes->presenter('tipekamar');
        $routes->get('tiket/penyewa', 'Tiket::index/penyewa');
        $routes->get('tiket/karyawan', 'Tiket::index/karyawan');
        $routes->presenter('tiket');
        $routes->presenter('tiketdetail');
        $routes->presenter('karyawan');
        $routes->presenter('penghuni');
        $routes->group('penyewaan', ['filter' => 'isAdmin', 'namespace' => 'App\Controllers\Admin'], static function ($routes) {
            $routes->get('/', 'PenyewaanController::index');
            $routes->get('detail_penyewaan/(:num)', 'PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'PenyewaanController::pembayaran_detail/$1');
        });
    });

    //Karyawan
    $routes->group('karyawan', ['filter' => 'isKaryawan', 'namespace' => 'App\Controllers\Karyawan'], static function ($routes) {
        $routes->get('tiket/penyewa', 'Tiket::index/penyewa');
        $routes->get('tiket/karyawan', 'Tiket::index/karyawan');
        $routes->presenter('tiket');
        $routes->presenter('tiketdetail');
        $routes->get('/', 'Dashboard::index');
        $routes->presenter('penghuni');
        $routes->presenter('kamar');
        $routes->presenter('denah');
        $routes->group('penyewaan', ['filter' => 'isKaryawan', 'namespace' => 'App\Controllers\Karyawan'], static function ($routes) {
            $routes->get('/', 'PenyewaanController::index');
            $routes->get('detail_penyewaan/(:num)', 'PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'PenyewaanController::pembayaran_detail/$1');
            $routes->post('lunas/(:num)', 'PenyewaanController::lunas/$1');
            $routes->post('bayar_cod/(:num)', 'PenyewaanController::bayar_cod/$1');
        });
    });

    // Penghuni
    $routes->group('penghuni', ['filter' => 'isPenghuni', 'namespace' => 'App\Controllers\Penghuni'], static function ($routes) {
        $routes->presenter('tiket');
        $routes->presenter('tiketdetail');
        $routes->get('/', 'PenyewaanController::index');
        $routes->post('/', 'PenyewaanController::index');
        $routes->get('kamar_detail/(:num)', 'PenyewaanController::kamar_detail/$1');
        $routes->group('penyewaan', ['filter' => 'isPenghuni', 'namespace' => 'App\Controllers\Penghuni'], static function ($routes) {
            $routes->get('/', 'PenyewaanController::penyewaan');
            $routes->post('/', 'PenyewaanController::save');
            $routes->get('detail_penyewaan/(:num)', 'PenyewaanController::penyewaan_detail/$1');
            $routes->get('detail_pembayaran/(:num)', 'PenyewaanController::pembayaran_detail/$1');
            $routes->get('bayar/(:num)', 'PenyewaanController::pay/$1');
            $routes->post('bayar/(:num)', 'PenyewaanController::pay/$1');
            $routes->post('cancel/(:num)', 'PenyewaanController::cancel/$1');
            $routes->post('delete/(:num)', 'PenyewaanController::delete/$1');
        });
    });

    $routes->post('/penyewaan_detail/buatNoInvoice', 'paymentController::buatNoInvoice');
    $routes->post('/penyewaan_detail/payMidtrans', 'paymentController::payMidtrans');
    $routes->post('/penyewaan_detail/payment', 'paymentController::payment');
    $routes->post('/kamar/detailKamar', 'Kamar::detailKamar');

    // filter

    // laporan
    $routes->get('(:any)/laporan', 'LaporanController::index');
    $routes->get('(:any)/laporan/cetak_karyawan', 'LaporanController::cetak_karyawan');
    $routes->get('(:any)/laporan/cetak_penyewa', 'LaporanController::cetak_penghuni');
    $routes->get('(:any)/laporan/cetak_kamar', 'LaporanController::cetak_kamar');
    $routes->get('(:any)/laporan/cetak_penyewaan', 'LaporanController::cetak_penyewaan');
    $routes->get('(:any)/laporan/cetak_pembayaran', 'LaporanController::cetak_pembayaran');
    $routes->get('(:any)/laporan/cetak_pembayaran_detail', 'LaporanController::cetak_pembayaran_detail');
    // cetak komplain
    $routes->get('(:any)/laporan/cetak_komplain/(:num)', 'LaporanController::cetak_komplain/$1/$2');

    // Auth
    $routes->get('(:any)/setting', 'Auth::setting');
    $routes->post('(:any)/update/(:any)', 'Auth::update/$1');
    $routes->post('/logout', 'Auth::logout');

    //  guest
    $routes->get('/', 'Home::index', ['filter' => 'isGuest']);
    $routes->post('/', 'Home::index', ['filter' => 'isGuest']);
    $routes->get('/denah', 'Home::denah', ['filter' => 'isGuest']);
    $routes->get('/(:any)/denah', 'Home::denah');
    $routes->get('/kamar_detail/(:num)', 'Home::kamar_detail/$1', ['filter' => 'isGuest']);
    $routes->post('/temp_sewa', 'Home::temp_sewa', ['filter' => 'isGuest']);
});

$routes->presenter('dashboard');

// login
// $routes->get('/admin', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('/payment', 'Payment::index');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('registerProcess', 'Auth::registerProcess');
$routes->get('/forgot_password', 'Auth::resetPass');
$routes->post('/sendLink', 'Auth::sendLink');
$routes->get('/reset/(:any)', 'Auth::resetPw/$1');
$routes->post('/reset/(:any)', 'Auth::resetProcess/$1');



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
