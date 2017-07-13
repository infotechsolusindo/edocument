<?php
class MenuGroup_Controller extends Controller {
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
        $list = new _MenuFactory;
        $this->Assign('list', $list->getMenuList());
        $this->getHeaderFooter();
        $this->Load_View('admin/menugroup');
    }
    public function tambahSimpan() {
        $error = '';
        if (!isset($_POST)) {
            $error = 'Data tidak ditemukan';
            $this->Assign('errorMessage', $error);
            return $this->index();
        }
        // $this->Assign('parent', $_POST['parent']);
        // $this->Assign('name', $_POST['name']);
        // $this->Assign('url', $_POST['url']);
        // $this->Assign('icon', $_POST['icon']);

        if ($_POST['name'] == '') {
            logs('name kosong');
            $error = 'Nama menu tidak boleh kosong';
            $this->Assign('errorMessage', $error);
        }
        if ($error == '') {
            $data = [
                'mparent' => $_POST['parent'],
                'mname' => $_POST['name'],
                'url' => $_POST['url'],
                'icon' => $_POST['icon'],
            ];
            $menu = new _Menu;
            $result = $menu->simpan($data);
            if (!$result) {
                redirect(SITE_ROOT, 'admin/menu');
            }
        }
        $this->Assign('tambahForm', 1);
        $this->index();
    }
    public function ubah($id) {
        $kategoridokumen = new KategoriDokumen;
        $data = $kategoridokumen->show($id);
        $this->Assign('ubahForm', 1);
        $this->Assign('id', $id);
        $this->Assign('kategoridokumen', $data->kategori);
        $this->Assign('deskripsi', $data->deskripsi);
        $this->index();
    }
    public function ubahSimpan() {
        $error = '';
        if (!isset($_POST)) {
            $error = 'Data pengubahan tidak ditemukan';
            $this->Assign('errorMessage', $error);
            $this->index();
        }
        $this->Assign('id', $_POST['id']);
        $this->Assign('kategoridokumen', $_POST['kategoridokumen']);
        $this->Assign('deskripsi', $_POST['deskripsi']);
        if ($_POST['kategoridokumen'] == '') {
            $error = 'Kategori dokumen tidak boleh kosong';
            $this->Assign('errorMessage', $error);
        }
        $data = [
            'id' => $_POST['id'],
            'kategori' => $_POST['kategoridokumen'],
            'deskripsi' => $_POST['deskripsi'],
        ];

        $kategoridokumen = new KategoriDokumen;
        if ($error == '') {
            $result = $kategoridokumen->ubah($data, $_POST['id']);
            if (!$result) {
                redirect(SITE_ROOT, 'admin/kategoridokumen');
            }
        }
        $this->Assign('ubahForm', 1);
        $this->index();
    }
    public function hapus($id) {
        $kategoridokumen = new KategoriDokumen;
        $kategoridokumen->hapus($id);
        redirect(SITE_ROOT, 'admin/kategoridokumen');
    }

}
