<?php
class Dokumen_Controller extends Controller {
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
        $this->script_bottom = '
		  <script>
		      //custom select box

		      $(function(){
		          $(\'select.styled\').customSelect();
		      });

		  </script>
		';
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
        $data = [];
        $list = new Dokumen;
        foreach ($list->getAllNew() as $l) {
            switch ($l->status) {
            case 1:$status = "Sending";
                break;
            case 2:$status = "Complete";
                break;
            default:
                $status = "-";
                break;
            }
            $data[] = (Object) [
                'tgl' => $l->tgl,
                'jam' => $l->jam,
                'nodoc' => $l->nodoc,
                'judul' => $l->judul,
                'status' => $status,
                'statuscode' => $l->status,
            ];
        }
        $this->Assign('list', $data);
        $this->getHeaderFooter();
        $this->Load_View('operator/dokumen');
    }

    public function tambah() {
        $this->getHeaderFooter();
        // $this->Load_View('dokumen/tambah');
    }

    public function masuk() {
        $data = [];
        $list = new Dokumen;
        foreach ($list->getAllNew() as $l) {
            switch ($l->status) {
            case 1:$status = "Sending";
                break;
            case 2:$status = "Complete";
                break;
            default:
                $status = "-";
                break;
            }
            $data[] = (Object) [
                'tgl' => $l->tgl,
                'jam' => $l->jam,
                'nodoc' => $l->nodoc,
                'judul' => $l->judul,
                'status' => $status,
                'statuscode' => $l->status,
            ];
        }
        $this->Assign('list', $data);
        $this->getHeaderFooter();
        $this->Load_View('operator/dokumen');
    }
    public function keluar() {
        $data = [];
        $list = new Dokumen;
        foreach ($list->getAllNew() as $l) {
            switch ($l->status) {
            case 1:$status = "Sending";
                break;
            case 2:$status = "Complete";
                break;
            default:
                $status = "-";
                break;
            }
            $data[] = (Object) [
                'tgl' => $l->tgl,
                'jam' => $l->jam,
                'nodoc' => $l->nodoc,
                'judul' => $l->judul,
                'status' => $status,
                'statuscode' => $l->status,
            ];
        }
        $this->Assign('list', $data);
        $this->getHeaderFooter();
        $this->Load_View('operator/dokumen');
    }
}