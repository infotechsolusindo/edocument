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
        $sidebarleft = new View();
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

        logs('Masuk index Controller');
        // if(!checkSession()){
        //     logs('Session tidak ditemukan');
        //     redirect(SITE_ROOT,'auth/login');
        // }
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

    public function test() {
        $mail = new Email;
        $mail->to('infotech.solusindo@gmail.com');
        $mail->subject('Testing email');
        $mail->body('coba lagi');
        $mail->sendemail();
        /*
    // var_dump($mail);
    // $mail->sendemail();
    // if(is_object($mail)){
    //     echo 'ini object';
    // }*/
    }
    public function cekemail() {
        $this->Load_Model('Pool');
        $data = $this->model->getAllNew();
        var_dump($data);
    }
}
