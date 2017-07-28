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
        $this->script_bottom = '';
        $departemen = new Departemen;
        $this->Assign('listdepartemen', $departemen->getDepartemen());
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
        var_dump($_SESSION);
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
        $i = 0;
        $exp = '';
        $list = new Dokumen;
        $listbydepartemen = $list->getAllNewByPenerima($_SESSION['departemen']);
        foreach ($listbydepartemen as $r) {
            $date_span = date_diff(date_create(date("Y-m-d")), date_create(date($r->tglkirim)));
            if ($date_span->days > 1) {
                $exp = 'warning1';
            } else if ($date_span->days > 2) {
                $exp = 'warning2';
            } else if ($r->status == '1') {
                $exp = 'unread';
            }
            $arrlist = (Object) [];
            $arrlist->iddoc = $r->iddoc;
            $arrlist->tgl = $r->tgl;
            $arrlist->jam = $r->jam;
            $arrlist->tipe = $r->tipe;
            $arrlist->kategori = $r->kategori;
            $arrlist->nodoc = $r->nodoc;
            $arrlist->judul = $r->judul;
            $arrlist->perihal = $r->perihal;
            $arrlist->pengirim = $r->pengirim;
            $arrlist->penerima = $r->penerima;
            $arrlist->status = $r->status;
            $arrlist->tglkirim = $r->tglkirim;
            $arrlist->jamkirim = $r->jamkirim;
            $arrlist->tglterima = $r->tglterima;
            $arrlist->jamterima = $r->jamterima;
            $arrlist->data1 = $r->data1;
            $arrlist->data2 = $r->data2;
            $arrlist->data3 = $r->data3;
            $arrlist->data4 = $r->data4;
            $arrlist->data5 = $r->data5;
            $arrlist->data6 = $r->data6;
            $arrlist->data7 = $r->data7;
            $arrlist->data8 = $r->data8;
            $arrlist->data9 = $r->data9;
            $arrlist->data10 = $r->data10;
            $arrlist->expstatus = $exp;
            $data[] = $arrlist;
            $i++;
        }
        $this->Assign('list', $data);
        $this->getHeaderFooter();
        $this->Load_View('operator/dokumen');
    }
    public function view($id) {
        $dokumen = new Dokumen;
        $data = $dokumen->show($id);
        $dokumen->setStatus($id, '2');
        $this->Assign('dokumen', $data);
        $this->getHeaderFooter();
        $this->Load_View('operator/dokumen_view');
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
    public function download($id) {
        $dokumen = new Dokumen;
        $data = $dokumen->show($id);
        $file = ROOT . '/data/dokumen/' . $data->data2;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($data->data3) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
    public function tolak($id) {
        $dokumen = new Dokumen;
        $dokumen->setStatus($id, '3');
        redirect(SITE_ROOT . 'operator/dokumen/masuk');
    }
    public function hapus($id, $force = false) {
        $suratmasuk = new SuratMasuk;
        $suratmasuk->hapus($id, $force);
        redirect(SITE_ROOT, 'operator/dokumen/masuk');
    }
    public function pulihkan($id) {
        $suratmasuk = new SuratMasuk;
        $suratmasuk->pulihkan($id);
        redirect(SITE_ROOT, 'operator/dokumen/masuk');
    }
    public function disposisi($id) {
        $this->Assign('buatDisposisi', 1);
        $this->Assign('dokumeninduk', $id);
        $this->view($id);
    }
    public function disposisiSimpan() {
        if (empty($_POST)) {return;}
        $tgldisposisi = $_POST['tgl'];
        $jamdisposisi = $_POST['jam'];
        $tipe = $_POST['tipe'];
        $dokumeninduk = $_POST['dokumeninduk'];
        $memo = $_POST['memo'];
        $pengirim = $_SESSION['id'];
        $penerimas = $_POST['penerima'];
        $departemenpenerimas = $_POST['departemenpenerima'];
        $dokumeninduk = new Dokumen;
        $di = $dokumeninduk->show($_POST['dokumeninduk']);
        var_dump($di);
        $i = 0;
        foreach ($penerimas as $i => $nama) {
            $i++;
            if ($nama == '' || $departemenpenerimas[$i] == '') {
                continue;
            }
            $dokumen = new Dokumen;
            $data = [

            ];
        }
    }
}
