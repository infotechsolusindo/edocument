<?php
class Index_Controller extends Controller {
    private $style;
    private $script_top;
    private $script_bottom;

    public function __construct() {
        logs('Masuk TU Controller');
        parent::__construct();
        $this->Load_View('tu/index');
        $modules = new Module(['menu']);
        $sidebarleft = new View;
        $sidebarleft->Assign('modules', $modules->Render());
        $this->Assign('sidebarleft', $sidebarleft->Render('sidebarleft', false));

        $modules2 = new Module(['indikatordokumen', 'daftardokumen']);
        $middle = new View();
        $middle->Assign('modules2', $modules2->Render());
        $this->Assign('middle', $modules2->Render());
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

    public function index() {
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
    }
    public function suratmasuk() {
        $this->Assign('nama', $nama);
        $this->Assign('list', $list = []);
        return $this->Load_View('tu/suratmasuk');
    }

}