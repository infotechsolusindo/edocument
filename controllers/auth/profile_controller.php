<?php
class Profile_Controller extends Controller {

    public function __construct() {
        parent::__construct();
        $modules = new Module(['menu']);
        $sidebarleft = new View;
        $sidebarleft->Assign('modules', $modules->Render());
        $this->Assign('sidebarleft', $sidebarleft->Render('sidebarleft', false));
        $this->style = '<link href="assets/css/style-responsive.css" rel="stylesheet">';
        $this->script_top = '';
        $this->script_bottom = '

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
    public function changePassword() {
        $this->getHeaderFooter();
        $this->Load_View('auth/changepassword');
    }
    public function changePasswordSimpan() {
        logs('Old:' . $_POST['oldpassword']);
        logs('New:' . $_POST['newpassword']);
        logs('Con:' . $_POST['confpassword']);
        $user = new User;
        if ($_POST['oldpassword'] !== '') {
            $u = $user->getUser($_SESSION['id']);
            if ($u->getpassword() === md5($_POST['oldpassword'])) {
                if ($_POST['newpassword'] == $_POST['confpassword']) {
                    $password = [
                        'password' => md5($_POST['newpassword']),
                    ];
                    $user->editUser($_SESSION['id'], $password);
                }
            }
        }
        return redirect(SITE_ROOT, $_SESSION['path']);
    }
}