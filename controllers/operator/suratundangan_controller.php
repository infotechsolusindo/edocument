<?php
class Surattugas_Controller extends Controller {
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
        $sidebarleft = new View();
        $sidebarleft->Assign('modules', $modules->Render());
        $this->Assign('sidebarleft', $sidebarleft->Render('sidebarleft', false));
        $this->Assign('sidebarleft', $sidebarleft->Render('sidebarleft', false));
        $this->style = '<link href="assets/css/style-responsive.css" rel="stylesheet">';
        $this->script_top = '';
        $this->script_bottom = '';
        $departemen = new Departemen;
        $this->Assign('listdepartemen', $departemen->getDepartemen());
        $data = new User;
        $users = $data->getUsers();
        $this->Assign('users', $users);
    }
    public function index() {
        $this->getHeaderFooter();
        $this->Load_View('operator/suratundangan');
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
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', getLoggedUser('fullname'));
        $header->Assign('style', $this->style);
        $header->Assign('script_top', $this->script_top);
        $this->Assign('header', $header->Render('header', false));
        $footer = new View();
        $footer->Assign('script_bottom', $this->script_bottom);
        $this->Assign('footer', $footer->Render('footer', false));
    }
    public function simpan() {
        $error = '';
        $filedokumen = '';
        $filename = '';
        if (!isset($_POST)) {
            $error = 'Data tidak ditemukan';
            $this->Assign('errorMessage', $error);
            return $this->index();
        }

        $this->Assign('tgl', $_POST['tgl']);
        $this->Assign('jam', $_POST['jam']);
        $this->Assign('nodoc', $_POST['nodoc']);
        // $this->Assign('judul', $_POST['judul']);
        $this->Assign('perihal', $_POST['perihal']);
        $this->Assign('pengirim', $_POST['pengirim']);
        $this->Assign('penerima', $_POST['penerima']);
        $this->Assign('departemenpenerima', $_POST['departemenpenerima']);

        if (!empty($_FILES) && (isset($_FILES['filedokumen']))) {
            $filedokumen = $this->uploadFile($_FILES['filedokumen']);
            $filename = $_FILES['filedokumen']['name'];
        }
        $departemenpenerimas = $_POST['departemenpenerima'];
        $penerimas = $_POST['penerimas'];
        $data = [
            'tgl' => $_POST['tgl'],
            'jam' => $_POST['jam'],
            'tipe' => 5,
            'kategori' => 11,
            'nodoc' => $_POST['nodoc'],
            // 'judul' => $_POST['judul'],
            'perihal' => $_POST['perihal'],
            'pengirim' => $_POST['pengirim'],
            'penerima' => $_POST['penerima'],
            'data1' => $_POST['departemen'], // departemen penerima
            'data2' => $filedokumen, //letak file di system
            'data3' => $filename, //nama asli file dokumen
            'data4' => $_SESSION['departemen']->iddepartemen, // departemen pengirim
            'status' => '1',
        ];
        $suratundangan = new Dokumen;
        if ($error == '') {
            $result = $suratundangan->tambah($data);
            if (!$result) {

                foreach ($_POST['departemenpenerima'] as $i => $nama) {
                    if ($nama == '' || $departemenpenerimas[$i] == '') {
                        continue;
                    }
                    $dokumen = new Dokumen;
                    $data = [
                        'tgl' => $_POST['tgl'],
                        'jam' => $_POST['jam'],
                        'tipe' => 5,
                        'kategori' => 11,
                        'nodoc' => $_POST['nodoc'],
                        // 'judul' => $_POST['judul'],
                        'perihal' => 'Salinan:' . $_POST['perihal'],
                        'pengirim' => $_POST['pengirim'],
                        'penerima' => $penerimas[$i],
                        'data1' => $departemenpenerimas[$i], // departemen penerima
                        'data2' => $filedokumen, //letak file di system
                        'data3' => $filename, //nama asli file dokumen
                        'data4' => $_SESSION['departemen']->iddepartemen, // departemen pengirim
                        'status' => '1',
                    ];
                    $dokumen->tambah($data);
                }
                redirect(SITE_ROOT, 'operator/suratundangan');
            }
        }
        $this->index();
    }
}