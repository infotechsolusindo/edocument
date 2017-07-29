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
    public function getAllNewByPengirim($departemenpengirim, $status = null) {
        $sql = "select * from dokumen where data4 = $departemenpengirim and (status <> '0' and tipe <> '3' and status <> '3' and status <> 'x' and status <> 'D' and status <> 'S') ";
        if (isset($status)) {
            $sql .= " and status = $status";
        }
        return $this->_db->Exec($sql);
    }
    public function getAllNewByPenerima($departemenpenerima, $status = null) {
        $sql = "select * from dokumen where data1 = $departemenpenerima and (status <> '0' and tipe <> '3'  and status <> '3' and status <> 'x' and status <> 'D' and status <> 'S') ";
        if (isset($status)) {
            $sql .= " and status = $status";
        }
        return $this->_db->Exec($sql);
    }
    public function getAllArsipByPenerima($departemenpenerima, $status = null) {
        $sql = "select * from dokumen where data1 = $departemenpenerima and status = 'S' and tipe <> '3'";
        if (isset($status)) {
            $sql .= " and status = $status";
        }
        return $this->_db->Exec($sql);
    }
    public function setKategori($kategori) {
        $this->kategori = $kategori;
    }
    public function setTable($table) {
        $this->_table = $table;
    }
    public function show($id) {
        $sql = "select d.*,k.kategori as nmkategori,p.name as departemen from dokumen as d" .
            " left join kategoridokumen as k on k.id = d.kategori" .
            " left join departemen as p on p.iddepartemen = d.data1" .
            " where iddoc = $id";
        $result = $this->_db->Exec($sql);
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
    public function hapus($id) {
        return $this->_db->Exec("delete from dokumen where id = $id");
    }
    public function tambahInfo($idx, $value) {
        $this->info[$idx] = $value;
    }
    public function getInfo($idx) {
        return $this->info[$idx];
    }
    public function setStatus($id, $status, $note = null) {
        $updatetime = '';
        $notes = '';
        if ($status == '1') {
            $updatetime = ", tglkirim = date(now()), jamkirim = time(now()) ";
        }
        if ($status == '2') {
            $updatetime = ", tglterima = date(now()), jamterima = time(now()) ";
        }
        if ($note && $note !== '') {
            logs('disini');
            $notes = ", data5 = '$note'";
        }

        $sql = "update dokumen set status = '$status' $notes $updatetime where iddoc = $id";
        return $this->_db->Exec($sql);
    }
}
