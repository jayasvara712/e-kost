<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Pdfgenerator;
use App\Models\ModelKamar;
use App\Models\ModelKaryawan;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;

class LaporanController extends BaseController
{
    private $menu = "<script language=\"javascript\">menu('m-laporan');</script>";
    // private $header = "<script language=\"javascript\">menu('m-page');</script>";
    private $url = "Laporan";
    private $nama_perusahaan = "E-Kost";
    private $alamat = "Denpasar, Bali";
    private $pemilik = "Made";

    protected $modelPenghuni;
    protected $modelKaryawan;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKaryawan = new ModelKaryawan();
        $this->modelKamar = new ModelKamar();
    }

    public function index()
    {
        $data = [
            'kamar' => $this->modelKamar->findAll(),
        ];
        return view('laporan/index', $data) . $this->menu;
    }

    public function cetak_karyawan()
    {
        $Pdfgenerator = new Pdfgenerator();

        // data
        $karyawan = $this->modelKaryawan->findAll();
        // title dari pdf
        $data = [
            'title'     => 'Data Karyawan',
            'owner'     => $this->pemilik,
            'company'   => $this->nama_perusahaan,
            'alamat'    => $this->alamat,
            'karyawan'  => $karyawan,
            'date'      => date('d M Y')
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_karyawan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('laporan/cetak_karyawan', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetak_penghuni()
    {
        $Pdfgenerator = new Pdfgenerator();

        // data
        $penghuni = $this->modelPenghuni->findAll();
        // title dari pdf
        $data = [
            'title'     => 'Data Penyewa',
            'owner'     => $this->pemilik,
            'company'   => $this->nama_perusahaan,
            'alamat'    => $this->alamat,
            'penghuni'  => $penghuni,
            'date'      => date('d M Y')
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_penghuni';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('laporan/cetak_penyewa', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetak_kamar()
    {
        $Pdfgenerator = new Pdfgenerator();

        // data
        $kamar = $this->modelKamar->getAll();
        // title dari pdf
        $data = [
            'title'     => 'Data Kamar',
            'owner'     => $this->pemilik,
            'company'   => $this->nama_perusahaan,
            'alamat'    => $this->alamat,
            'dataKamar'     => $kamar,
            'date'      => date('d M Y')
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_kamar';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = view('laporan/cetak_kamar', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetak_penyewaan()
    {
        $Pdfgenerator = new Pdfgenerator();

        $bulanInput = $this->request->getVar('bulan');
        $optionInput = $this->request->getVar('status');

        // data
        if ($optionInput == 'all') {
            $penyewaan = $this->modelPenyewaan->getByAll($bulanInput, '');
        } else {
            $penyewaan = $this->modelPenyewaan->getByAll($bulanInput, $optionInput);
        }
        // title dari pdf
        $data = [
            'title'     => 'Data Penyewaan Bulan ' . date('M, Y', strtotime($bulanInput)),
            'owner'     => $this->pemilik,
            'company'   => $this->nama_perusahaan,
            'alamat'    => $this->alamat,
            'penyewaan'     => $penyewaan,
            'date'      => date('d M Y')
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_kamar';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = view('laporan/cetak_penyewaan', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetak_pembayaran()
    {
        $Pdfgenerator = new Pdfgenerator();

        $bulanInput = $this->request->getVar('bulan');

        // data
        $pembayaran = $this->modelPenyewaanDetail->getByAll($bulanInput);

        // title dari pdf
        $data = [
            'title'         => 'Data Pembayaran Bulan ' . date('M, Y', strtotime($bulanInput)),
            'owner'         => $this->pemilik,
            'company'       => $this->nama_perusahaan,
            'alamat'        => $this->alamat,
            'pembayaran'    => $pembayaran,
            'date'          => date('d M Y')
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_kamar';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = view('laporan/cetak_pembayaran', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetak_pembayaran_detail()
    {
        $Pdfgenerator = new Pdfgenerator();

        $id = $this->request->getVar('id_penyewaan_detail');

        // data
        $penyewaan_detail = $this->modelPenyewaanDetail->getAllDetail($id);

        // title dari pdf
        $data = [
            'owner'                 => $this->pemilik,
            'company'               => $this->nama_perusahaan,
            'alamat'                => $this->alamat,
            'date'                  => date('d M Y'),
            'id_penyewaan'          => $penyewaan_detail[0]->id_penyewaan,
            'no_invoice'            => $penyewaan_detail[0]->no_invoice,
            'tgl_penyewaan'         => $penyewaan_detail[0]->tgl_penyewaan,
            'lama_penyewaan'        => $penyewaan_detail[0]->lama_penyewaan,
            'payment_method'        => $penyewaan_detail[0]->payment_method,
            'transaction_status'    => $penyewaan_detail[0]->transaction_status,
            'bank'                  => $penyewaan_detail[0]->bank,
            'va_number'             =>  $this->modelPenyewaanDetail->sensor_bank($penyewaan_detail[0]->va_number),
            'tgl_penyewaan'         => date('d M, Y', strtotime($penyewaan_detail[0]->tgl_penyewaan)),
            'transaction_time'      => date('d M, Y', strtotime($penyewaan_detail[0]->transaction_time)),
            'lama_penyewaan'        => $penyewaan_detail[0]->lama_penyewaan,
            'harga_kamar'           => number_format($penyewaan_detail[0]->payment, 0, ',', '.'),

            'nomor_kamar'           => $penyewaan_detail[0]->nomor_kamar,
            'payment'               => number_format($penyewaan_detail[0]->payment, 0, ',', '.'),

            'nama_penghuni'         => $penyewaan_detail[0]->nama_penghuni,
            'no_telp_penghuni'      => $penyewaan_detail[0]->no_telp_penghuni,
            'alamat_penghuni'       => $penyewaan_detail[0]->alamat_penghuni,
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_pembayaran_' . $penyewaan_detail[0]->no_invoice;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = view('laporan/cetak_pembayaran_detail', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
