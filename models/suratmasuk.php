<?php
class SuratMasuk extends Dokumen {
    function __construct() {
        $db = DB_ENGINE;
        parent::__construct(new $db);
        $this->setTable('dokumen');
    }

    public function getAllNew() {
        return $this->_db->Exec("select * from dokumen where tipe = '1' and status = '0' order by tgl desc");
    }
    public function getTerkirim() {
        $sql = "select * from dokumen where tipe = '1' and status = '1' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getDiterima() {
        $sql = "select * from dokumen where tipe = '1' and status = '2' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getKembali() {
        $sql = "select * from dokumen where tipe = '1' and status = '3' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getDitolak() {
        $sql = "select * from dokumen where tipe = '1' and status = 'x' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function getDihapus() {
        $sql = "select * from dokumen where tipe = '1' and status = 'D' order by tgl desc";
        return $this->_db->Exec($sql);
    }
    public function hapus($id, $force = false) {
        if ($force) {
            $sql = "delete from dokumen where iddoc = $id";
        } else {
            $sql = "update dokumen set status = 'D' where iddoc = $id";
        }
        return $this->_db->Exec($sql);
    }
    public function pulihkan($id) {
        $sql = "update dokumen set status = '0' where iddoc = $id";
        return $this->_db->Exec($sql);
    }
}