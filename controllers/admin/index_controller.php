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

        $modules2 = new Module(['indikatordokumen', 'daftardokumen']);
        $middle = new View();
        $middle->Assign('modules2', $modules2->Render());
        $this->Assign('middle', $modules2->Render());
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

			<script type="text/javascript">
		/*        $(document).ready(function () {
		        var unique_id = $.gritter.add({
		            // (string | mandatory) the heading of the notification
		            title: \'Welcome to Dashgum!\',
		            // (string | mandatory) the text inside the notification
		            text: \'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.\',
		            // (string | optional) the image to display on the left
		            image: \'public/assets/img/ui-sam.jpg\',
		            // (bool | optional) if you want it to fade out on its own or just sit there
		            sticky: true,
		            // (int | optional) the time you want it to be alive for before fading out
		            time: \'\',
		            // (string | optional) the class name you want to apply to that specific message
		            class_name: \'my-sticky-class\'
		        });

		        return false;
		        });*/
			</script>

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
        $this->getHeaderFooter();
        $this->Load_View('general/index');
    }
    public function departemen() {
        $this->Load_View('admin/departemen');
    }

}
