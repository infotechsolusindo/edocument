<?php
class SuratKeluar_Controller extends Controller {
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
    }
    public function uploadFile($file) {
        $file_tmp = $file['tmp_name'];
        $filename = date('Ymdhhmmss') . '-' . $file['name'];
        $fullpath = ROOT . '/data/dokumen/' . $filename;
        move_uploaded_file($file_tmp, $fullpath);
        return $fullpath;
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
        $list = new SuratKeluar;
        $this->Assign('list', $list->getAllNew());
        $departemen = new Departemen;
        $this->Assign('listdepartemen', $departemen->getDepartemen());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratkeluar');
    }
    public function daftarTerkirim() {
        $list = new SuratKeluar
        ;
        $this->Assign('list', $list->getTerkirim());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratkeluar');
    }
    public function daftarDiterima() {
        $list = new SuratKeluar;
        $this->Assign('list', $list->getDiterima());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratkeluar');
    }
    public function daftarDitolak() {
        $list = new SuratKeluar;
        $this->Assign('list', $list->getDitolak());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratkeluar');
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
        }

        $data = [
            'tgl' => $_POST['tgl'],
            'jam' => $_POST['jam'],
            'kategori' => $_POST['kategori'],
            'nodoc' => $_POST['nodoc'],
            'judul' => $_POST['judul'],
            'perihal' => $_POST['perihal'],
            'pengirim' => $_POST['pengirim'],
            'penerima' => $_POST['penerima'],
            'data1' => $_POST['departemenpenerima'], // departemen penerima
            'data2' => $filedokumen,
            'status' => '0',
        ];
        $suratkeluar = new SuratKeluar;
        if ($error == '') {
            $result = $suratkeluar->tambah($data);
            if (!$result) {
                redirect(SITE_ROOT, 'tu/suratkeluar');
            }
        }

        $this->Assign('tambahForm', 1);
        $this->index();
    }
    public function ubah($id) {
        $suratkeluar = new SuratKeluar;
        $data = $suratkeluar->show($id);
        $this->Assign('ubahForm', 1);
        $this->Assign('iddoc', $data->iddoc);
        $this->Assign('tgl', $data->tgl);
        $this->Assign('jam', $data->jam);
        $this->Assign('nodoc', $data->nodoc);
        $this->Assign('judul', $data->judul);
        $this->Assign('perihal', $data->perihal);
        $this->Assign('pengirim', $data->pengirim);
        $this->Assign('penerima', $data->penerima);
        $list = new SuratKeluar;
        $this->Assign('list', $list->getAllNew());
        $departemen = new Departemen;
        $this->Assign('listdepartemen', $departemen->getDepartemen());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratkeluar');
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
        ];

        $suratkeluar = new SuratKeluar;
        if ($error == '') {
            $result = $suratkeluar->ubah($data, $_POST['iddoc']);
            if (!$result) {
                redirect(SITE_ROOT, 'tu/suratkeluar');
            }
        }
        $this->Assign('ubahForm', 1);
        $this->index();
    }
    public function hapus($id) {
        $suratkeluar = new SuratKeluar;
        $suratkeluar->hapus($id);
        redirect(SITE_ROOT, 'tu/suratkeluar');
    }

}
