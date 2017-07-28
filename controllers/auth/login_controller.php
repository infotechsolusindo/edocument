<?php
class Login_Controller extends Controller {
    private $user;
    private $error;

    private $username;
    private $nama;
    private $email;
    // private $address;
    // private $phone;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!empty($_POST) && isset($_POST['login-submit'])) {
            logs('login_index');
            $this->login();
        }
        $this->Load_View('auth/login');
        $this->view->Assign('error', $this->error);
    }
    private function login() {
        //Check login cridential
        $user = new User($_POST['username']);
        if (empty($user)) {
            redirect(SITE_ROOT, 'index', 'User tidak valid');
        }

        if ($user->getpassword() !== md5(trim($_POST['password']))) {
            return redirect(SITE_ROOT, 'index');
        }
        $this->setSession($user);
    }

    private function setSession($user) {
        if (!$user || !is_object($user)) {
            session_destroy();
            return redirect(SITE_ROOT, 'auth/logout');
        }
        $_SESSION['id'] = $user->getuserid();
        $_SESSION['privileges'] = $user->getwewenang()->gpath;
        $_SESSION['idwewenang'] = $user->getwewenang()->idgroup;
        $_SESSION['nama'] = $user->getname();
        $_SESSION['time'] = time();
        $_SESSION['wewenang'] = $user->getwewenang()->gpath;
        $_SESSION['path'] = $_SESSION['privileges'] == '' ? $_SESSION['privileges'] . '/index' : $_SESSION['wewenang'] . '/index';
        $_SESSION['departemen'] = $user->getDepartemen($_SESSION['id']);
        logs(print_r($_SESSION));
        return redirect(SITE_ROOT, $_SESSION['path']);
    }
}
