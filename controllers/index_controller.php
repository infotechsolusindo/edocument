<?php
class Index_Controller extends Controller {
    private $style;
    private $script_top;
    private $script_bottom;

    public function __construct() {
        parent::__construct();
        if (!checkSession()) {
            session_destroy();
            return redirect(SITE_ROOT, 'auth/login');
        }
    }
    private function getMenus($menus) {
        foreach ($menus as $m) {
            $s .= "
                  <li class=\"mt\">
                      <a class=\"active\" href=\"/\">
                          <i class=\"fa fa-dashboard\"></i>
                          <span>$m->mname</span>
                      </a>
                  </li>
                " . PHP_EOL;
        }

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
        $menu = new MenuFactory;
        $menu->setGroup(9);
        $menu->setTopParent(1);
        $menus = $this->getMenus($menu->loadMenus());
        //$sidebarleft = new View();
        //$sidebarleft->Assign('menu',$menus);
        //$this->Assign('sidebarleft',$sidebarleft->Render('sidebarleft',false));
    }

    public function index() {
        $this->style = '';
        $this->script_top = '<script src="public/assets/js/chart-master/Chart.js"></script>';
        $this->script_bottom = '';

        logs('Masuk index Controller');
        if (isset($_SESSION['path']) && ($_SESSION['path'] !== '')) {
            redirect(SITE_ROOT, $_SESSION['path']);
        }
        $this->getHeaderFooter();
        $this->Load_View('general/index');
    }

    public function tu() {
        $this->style = '<link rel="stylesheet" href="public/assets/css/to-do.css">';
        $this->script_top = '';
        $this->script_bottom = '
		    <script src="public/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
		    <script src="public/assets/js/tasks.js" type="text/javascript"></script>
		    <script>
		    $(document).ready(function() {
		        TaskList.initTaskWidget();
		    });
		    </script>
		';

        $this->getHeaderFooter();
        $this->Load_View('tu/index');
    }
    public function about($data) {
        $this->Load_View('about');
        $this->Assign('heading', 'Tentang ' . APP_NAME);
        $this->Assign('content', ' Donec id ....');
    }
}
