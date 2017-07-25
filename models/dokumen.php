<?php
class Dokumen extends Model {
    protected $kategori;
    protected $data;
    protected $info = [];
    function __construct() {
        logs(get_class($this));
        $db = DB_ENGINE;
        parent::__construct(new $db);
        $this->_db->setTable('dokumen');
    }
    public function getAllNew() {
        return $this->_db->Exec("select * from dokumen where status = '0' order by tgl desc");
    }
    public function getAllNewByPengirim($pengirim, $status = 0) {
        return $this->_db->Exec("select * from dokumen where pengirim = '$pengirim' and status = '$status'");
    }
    public function getAllNewByPenerima($penerima, $status = 0) {
        return $this->_db->Exec("select * from dokumen where penerima = '$penerima' and status = '$status'");
    }
    public function setKategori($kategori) {
        $this->kategori = $kategori;
    }
    public function setTable($table) {
        $this->_table = $table;
    }
    public function show($id) {
        $result = $this->_db->Exec("select * from dokumen where iddoc = $id");
        $doc = $result[0];
        $this->data[1] = $doc->data1;
        $this->data[2] = $doc->data2;
        $this->data[3] = $doc->data3;
        $this->data[4] = $doc->data4;
        $this->data[5] = $doc->data5;
        $this->data[6] = $doc->data6;
        $this->data[7] = $doc->data7;
        $this->data[8] = $doc->data8;
        $this->data[9] = $doc->data9;
        $this->data[10] = $doc->data10;
        return $doc;
    }
    final public function tambah($data) {
        return $this->_db->create($data);
    }
    final public function ubah($data, $id) {
        return $this->_db->update($data, $id, 'iddoc');
    }
    final public function hapus($id) {
        return $this->_db->Exec("delete from dokumen where id = $id");
    }
    public function tambahInfo($idx, $value) {
        $this->info[$idx] = $value;
    }
    public function getInfo($idx) {
        return $this->info[$idx];
    }
}
