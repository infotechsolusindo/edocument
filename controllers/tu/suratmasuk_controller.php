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
        $kategori = new kategoridokumen;
        $list = new SuratMasuk;
        $this->Assign('list', $list->getAllNew());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk');
    }
    public function daftarTerkirim() {
        $list = new SuratMasuk;
        $this->Assign('list', $list->getTerkirim());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk');
    }
    public function daftarDiterima() {
        $list = new SuratMasuk;
        $this->Assign('list', $list->getDiterima());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk');
    }
    public function daftarDitolak() {
        $list = new SuratMasuk;
        $this->Assign('list', $list->getDitolak());
        $this->getHeaderFooter();
        $this->Load_View('tu/suratmasuk');
    }
    public function tambahSimpan() {
        $error = '';
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

        if ($_POST['kategori'] == '') {
            logs('kategoridokumen kosong');
            $error = 'Kategori dokumen tidak boleh kosong';
            $this->Assign('errorMessage', $error);
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
    public function hapus($id) {
        $suratmasuk = new SuratMasuk;
        $suratmasuk->hapus($id);
        redirect(SITE_ROOT, 'tu/suratmasuk');
    }

}
