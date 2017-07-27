<?php
class SuratKeluar extends Dokumen {
    function __construct() {
        $db = DB_ENGINE;
        parent::__construct(new $db);
        $this->setTable('dokumen');
    }
/*
public function getAllNew() {
return $this->_db->Exec("SELECT * FROM $this->tbname WHERE kategori = $this->kategori and status = '0' ORDER BY tgl DESC");
}*/
    public function getTerkirim() {
        $sql = "select * from dokumen where tipe = '2' and status = '1' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getDiterima() {
        $sql = "select * from dokumen where where tipe = '2' and status = '2' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getDitolak() {
        $sql = "select * from dokumen where where tipe = '2' and status = 'x' order by tgl desc";
        return $this->_db->Exec($sql);
    }
}