<?php
class Disposisi extends Dokumen {
    private $dokumenreferensi;
    private $catatan;
    private $person;

    function __construct() {
        parent::__construct();
        $this->setKategori(1); //Surat Disposisi
    }
    public function getAllNewByPenerima($departemenpenerima, $status = null) {
        $sql = "select * from dokumen where data1 = $departemenpenerima and tipe = 3 and status <> 'D' and status <> 'S' ";
        if ($status) {
            $sql .= " and status = '$status'";
        }
        $sql .= " order by tgl desc,jam desc";
        return $this->_db->Exec($sql);
    }
    public function getAllNewByPengirim($departemenpengirim, $status = null) {
        $sql = "select * from dokumen where data4 = $departemenpengirim and tipe = 3 and status <> 'D' and status <> 'S' ";
        if ($status) {
            $sql .= " and status = '$status'";
        }
        $sql .= " order by tgl desc,jam desc";
        return $this->_db->Exec($sql);
    }
    public function getTerkirim() {
        $sql = "select * from dokumen where kategori = $this->kategori and status = '1' order by tgl desc";
    }
    public function getDiterima() {
        $sql = "select * from dokumen where kategori = $this->kategori and status = '2' order by tgl desc";
    }
    public function getDitolak() {
        $sql = "select * from dokumen where kategori = $this->kategori and status = 'x' order by tgl desc";
    }
}