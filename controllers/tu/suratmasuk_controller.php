<?php
class SuratMasuk_Controller extends Controller {
    private $style;
    private $script_top;
    private $script_bottom;

    public function __construct() {
        parent::__construct();
        if (!checkSession()) {
            session_destroy();
            return redirect(SITE_ROOT, 'auth/login');
        }
        $modules = new Module(['menu']);
        $sidebarleft = new View;
        $sidebarleft->Assign('modules', $modules->Render());
        $this->Assign('sidebarleft', $sidebarleft->Render('sidebarleft', false));
        $kategori = new kategoridokumen;
        $this->Assign('kategori', $kategori->getKategori());
        $departemen = new Departemen;
        $this->Assign('listdepartemen', $departemen->getDepartemen());
    }
    public function uploadFile($file) {
        $file_tmp = $file['tmp_name'];
        $filename = date('Ymdhhmmss') . '-' . $file['name'];
        $fullpath = '/data/dokumen/' . $filename;
        move_uploaded_file($file_tmp, ROOT . $fullpath);
        return $filename;
    }
    private function getHeaderFooter() {
        $header = new View();
        $header->Assign('app_title', APP_TITLE);
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', getLoggedUser('fullname'));
        $header->Assign('style', $this->style);
        $header->Assign('script_top', $this->script_top);
        $this->Assign('header', $header->Render('header', false));
        $footer = new View();
        $footer->Assign('script_bottom', $this->script_bottom);
        $this->Assign('footer', $footer->Render('footer', false));
    }

    public function index() {
        $result = new SuratMasuk;
        $arrlist = (Object) [];
        $list = [];
        $exp = '';
        $i = 0;
        $rsresult = $result->getAllNew();
        foreach ($rsresult as $r) {
            $date_span = date_diff(date_create(date("Y-m-d")), date_create(date($r->tgl)));
            if ($date_span->days > 1) {
                $exp = 'warning1';
            } else if ($date_span->days > 2) {
                $exp = 'warning2';
            }
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = $exp;
            $list[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $list);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk');
    }
    public function daftarTerkirim() {
        $result = new SuratMasuk;
        $arrlist = (Object) [];
        $list = [];
        $exp = '';
        $i = 0;
        $rsresult = $result->getTerkirim();
        foreach ($rsresult as $r) {
            $date_span = date_diff(date_create(date("Y-m-d")), date_create(date($r->tglkirim)));
            if ($date_span->days > 1) {
                $exp = 'warning1';
            } else if ($date_span->days > 2) {
                $exp = 'warning2';
            }
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = $exp;
            $list[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $list);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk_terkirim');
    }
    public function daftarDiterima() {
        $result = new SuratMasuk;
        $arrlist = (Object) [];
        $list = [];
        $exp = '';
        $i = 0;
        $rsresult = $result->getDiterima();
        foreach ($rsresult as $r) {
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = '';
            $list[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $list);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk_diterima');
    }
    public function daftarDitolak() {
        $result = new SuratMasuk;
        $arrlist = (Object) [];
        $list = [];
        $exp = '';
        $i = 0;
        $rsresult = $result->getDitolak();
        foreach ($rsresult as $r) {
            $date_span = date_diff(date_create(date("Y-m-d")), date_create(date($r->tgl)));
            if ($date_span->days > 1) {
                $exp = 'warning1';
            } else if ($date_span->days > 2) {
                $exp = 'warning2';
            }
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = $exp;
            $list[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $list);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk_ditolak');
    }
    public function daftarDihapus() {
        $result = new SuratMasuk;
        $arrlist = (Object) [];
        $list = [];
        $exp = '';
        $i = 0;
        $rsresult = $result->getDihapus();
        foreach ($rsresult as $r) {
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = '';
            $list[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $list);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk_dihapus');
    }
    public function tambahSimpan() {
        $error = '';
        $filedokumen = '';
        if (!isset($_POST)) {
            $error = 'Data tidak ditemukan';
            $this->Assign('errorMessage', $error);
            return $this->index();
        }

        $this->Assign('tgl', $_POST['tgl']);
        $this->Assign('jam', $_POST['jam']);
        $this->Assign('kategori', $_POST['kategori']);
        $this->Assign('nodoc', $_POST['nodoc']);
        $this->Assign('judul', $_POST['judul']);
        $this->Assign('perihal', $_POST['perihal']);
        $this->Assign('pengirim', $_POST['pengirim']);
        $this->Assign('penerima', $_POST['penerima']);
        $this->Assign('departemenpenerima', $_POST['departemenpenerima']);

        if ($_POST['kategori'] == '') {
            logs('kategoridokumen kosong');
            $error = 'Kategori dokumen tidak boleh kosong';
            $this->Assign('errorMessage', $error);
        }

        if (!empty($_FILES) && (isset($_FILES['filedokumen']))) {
            $filedokumen = $this->uploadFile($_FILES['filedokumen']);
            $filename = $_FILES['filedokumen']['name'];
        }

        $data = [
            'tgl' => $_POST['tgl'],
            'jam' => $_POST['jam'],
            'tipe' => 1,
            'kategori' => $_POST['kategori'],
            'nodoc' => $_POST['nodoc'],
            'judul' => $_POST['judul'],
            'perihal' => $_POST['perihal'],
            'pengirim' => $_POST['pengirim'],
            'penerima' => $_POST['penerima'],
            'data1' => $_POST['departemenpenerima'], // departemen penerima
            'data2' => $filedokumen, //letak file di system
            'data3' => $filename, //nama asli file dokumen
            'status' => '0',
        ];
        $suratmasuk = new SuratMasuk;
        if ($error == '') {
            $result = $suratmasuk->tambah($data);
            if (!$result) {
                redirect(SITE_ROOT, 'tu/suratmasuk');
            }
        }

        $this->Assign('tambahForm', 1);
        $this->index();
    }
    public function tambah(){
        $this->Assign('tambahForm',1);
        $this->index();
    }
    public function ubah($id) {
        $suratmasuk = new SuratMasuk;
        $data = $suratmasuk->show($id);
        $this->Assign('ubahForm', 1);
        $this->Assign('iddoc', $data->iddoc);
        $this->Assign('tgl', $data->tgl);
        $this->Assign('jam', $data->jam);
        $this->Assign('nodoc', $data->nodoc);
        $this->Assign('judul', $data->judul);
        $this->Assign('perihal', $data->perihal);
        $this->Assign('pengirim', $data->pengirim);
        $this->Assign('penerima', $data->penerima);
        $this->Assign('idkategori', $data->kategori);
        $this->Assign('iddepartemen', $data->data1); // iddepartemen dari penerima
        $this->Assign('filedokumen', $data->data2);

        $this->index();
    }
    public function ubahSimpan() {
        $error = '';
        if (!isset($_POST)) {
            $error = 'Data pengubahan tidak ditemukan';
            $this->Assign('errorMessage', $error);
            $this->index();
        }
        $this->Assign('iddoc', $_POST['iddoc']);
        $this->Assign('tgl', $_POST['tgl']);
        $this->Assign('jam', $_POST['jam']);
        $this->Assign('nodoc', $_POST['nodoc']);
        $this->Assign('judul', $_POST['judul']);
        $this->Assign('perihal', $_POST['perihal']);
        $this->Assign('pengirim', $_POST['pengirim']);
        $this->Assign('penerima', $_POST['penerima']);

        if ($_POST['kategori'] == '') {
            $error = 'Kategori dokumen tidak boleh kosong';
            $this->Assign('errorMessage', $error);
        }
        $data = [
            'iddoc' => $_POST['iddoc'],
            'tgl' => $_POST['tgl'],
            'jam' => $_POST['jam'],
            'kategori' => $_POST['kategori'],
            'nodoc' => $_POST['nodoc'],
            'judul' => $_POST['judul'],
            'perihal' => $_POST['perihal'],
            'pengirim' => $_POST['pengirim'],
            'penerima' => $_POST['penerima'],
            'status' => '0',
            'data1' => $_POST['departemenpenerima'],
        ];

        $suratmasuk = new SuratMasuk;
        if ($error == '') {
            $result = $suratmasuk->ubah($data, $_POST['iddoc']);
            if (!$result) {
                redirect(SITE_ROOT, 'tu/suratmasuk');
            }
        }
        $this->Assign('ubahForm', 1);
        $this->index();
    }
    public function hapus($id, $force = false) {
        $suratmasuk = new SuratMasuk;
        $suratmasuk->hapus($id, $force);
        redirect(SITE_ROOT, 'tu/suratmasuk');
    }
    public function pulihkan($id) {
        $suratmasuk = new SuratMasuk;
        $suratmasuk->pulihkan($id);
        redirect(SITE_ROOT, 'tu/suratmasuk');
    }
    public function view($id) {
        $dokumen = new Dokumen;
        $data = $dokumen->show($id);
        $this->Assign('dokumen', $data);
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk_view');
    }
    public function kirim($id) {
        $dokumen = new Dokumen;
        $dokumen->setStatus($id, '1');
        redirect(SITE_ROOT . '?url=tu/suratmasuk');
    }
    public function terima($id) {
        $dokumen = new Dokumen;
        $dokumen->setStatus($id, '2');
        redirect(SITE_ROOT . '?url=tu/suratmasuk');
    }
    public function tolak($id) {
        $dokumen = new Dokumen;
        $dokumen->setStatus($id, '3');
        redirect(SITE_ROOT . '?url=tu/suratmasuk');
    }
    public function download($id) {
        $dokumen = new Dokumen;
        $data = $dokumen->show($id);
        $file = ROOT . '/data/dokumen/' . $data->data2;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($data->data3) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}
