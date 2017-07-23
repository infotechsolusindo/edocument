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
        logs('Ambil menu group');
        $idgroup = null;
        if (isset($_GET['cmd']) && $_GET['cmd'] == 'refresh') {
            $idgroup = $_POST['group'] !== '' ? $_POST['group'] : null;
        }
        $menugroup = new MenuGroup;
        $mg = $menugroup->getmenugroup($idgroup);
        $user = new User;
        $ug = $user->getUserGroups();
        $menus = new _MenuFactory;
        $this->Assign('menu', $menus->getMenuList());
        $this->Assign('usergroup', $ug);
        $this->Assign('menugroup', $mg);
        $this->script_bottom = "
            <script>
              $('#group').on('change',function(){
                $('#groupform').submit();
              });
            </script>
        ";
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

        if (!isset($_POST['idgroup']) || $_POST['idgroup'] == '') {
            logs('group kosong');
            $error = 'Group belum dipilih';
            $this->Assign('errorMessage', $error);
        }
        if (!isset($_POST['idmenu']) || $_POST['idmenu'] == '') {
            logs('menu kosong');
            $error = 'Menu belum dipilih';
            $this->Assign('errorMessage', $error);
        }
        if ($error == '') {
            $data = [
                'idgroup' => $_POST['idgroup'],
                'idmenu' => $_POST['idmenu'],
            ];
            $menugroup = new MenuGroup;
            $result = $menugroup->simpanMenuGroup($data);
            if (!$result) {
                redirect(SITE_ROOT, 'admin/menugroup');
            }
        }
        $this->Assign('tambahForm', 1);
        $this->index();
    }
    public function ubah($idgroup, $idmenu) {
        $menugroup = new MenuGroup;
        $data = $menugroup->show($idgroup, $idmenu);
        $this->Assign('ubahForm', 1);
        $user = new User;
        $ug = $user->getUserGroups();
        $menus = new _MenuFactory;
        $this->Assign('menu', $menus->getMenuList());
        $this->Assign('usergroup', $ug);
        $this->Assign('idgroup', $idgroup);
        $this->Assign('idmenu', $idmenu);
        $this->index();
    }
    public function ubahSimpan() {
        $error = '';
        if (!isset($_POST)) {
            $error = 'Data tidak ditemukan';
            $this->Assign('errorMessage', $error);
            return $this->index();
        }

        if (!isset($_POST['idgroup']) || $_POST['idgroup'] == '') {
            logs('group kosong');
            $error = 'Group belum dipilih';
            $this->Assign('errorMessage', $error);
        }
        if (!isset($_POST['idmenu']) || $_POST['idmenu'] == '') {
            logs('menu kosong');
            $error = 'Menu belum dipilih';
            $this->Assign('errorMessage', $error);
        }
        if ($error == '') {
            $menugroup = new MenuGroup;
            $result = $menugroup->ubahMenuGroup($_POST['oldgroup'], $_POST['oldmenu'], $_POST['idgroup'], $_POST['idmenu']);
            if (!$result) {
                redirect(SITE_ROOT, 'admin/menugroup');
            }
        }
        $this->Assign('ubahForm', 1);
        $this->index();
    }
    public function hapus($id) {
        $menugroup = new MenuGroup;
        $menugroup->hapus($id);
        redirect(SITE_ROOT, 'admin/menugroup');
    }

}
