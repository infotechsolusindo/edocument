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
        $this->style = '';
        $this->script_top = '<script src="public/assets/js/chart-master/Chart.js"></script>';
        $this->script_bottom = '
		    <script src="public/assets/js/sparkline-chart.js"></script>
			<script src="public/assets/js/zabuto_calendar.js"></script>

			<script type="application/javascript">
		        $(document).ready(function () {
		            $("#date-popover").popover({html: true, trigger: "manual"});
		            $("#date-popover").hide();
		            $("#date-popover").click(function (e) {
		                $(this).hide();
		            });

		            $("#my-calendar").zabuto_calendar({
		                action: function () {
		                    return myDateFunction(this.id, false);
		                },
		                action_nav: function () {
		                    return myNavFunction(this.id);
		                },
		                ajax: {
		                    url: "show_data.php?action=1",
		                    modal: true
		                },
		                legend: [
		                    {type: "text", label: "Special event", badge: "00"},
		                    {type: "block", label: "Regular event", }
		                ]
		            });
		        });


		        function myNavFunction(id) {
		            $("#date-popover").hide();
		            var nav = $("#" + id).data("navigation");
		            var to = $("#" + id).data("to");
		            console.log(\'nav \' + nav + \' to: \' + to.month + \'/\' + to.year);
		        }
		    </script>


		';
        /* Hitung dokumen yang baru masuk */
        $dokumen = new Dokumen;
        $docs = $dokumen->getAllNewByPenerima($_SESSION['departemen']);
        // var_dump($docs);
        /* Hitung disposisi baru */
        $disposisi = new Disposisi;
        $disps = $disposisi->getAllNewByPenerima($_SESSION['departemen']);

        logs('Masuk operator index Controller');
        $this->getHeaderFooter();

        $this->Load_View('general/index');
    }
    public function tambah() {
        $dokumen = new Dokumen;
        $dokumen->setKategori();

    }
    public function tambahSimpan() {}
    public function ubah() {

    }
    public function ubahSimpan() {}

}
