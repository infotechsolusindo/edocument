<?php
class Indikatordokumen {
    function __construct() {
        $totdokumenbaru = 0; //tipe 4,5,dan 6
        $totdisposisibaru = 0; //tipe 3
        $totsuratbaru = 0; //tipe 1 dan 2
        /* Hitung dokumen yang baru masuk */
        $dokumen = new Dokumen;
        $docs = $dokumen->getAllNewByPenerima($_SESSION['departemen']->iddepartemen, 1);
        $totsuratbaru = count($docs);
        /* Hitung disposisi baru */
        $disposisi = new Disposisi;
        $disps = $disposisi->getAllNewByPenerima($_SESSION['departemen']->iddepartemen, 1);
        $totdisposisibaru = count($disps);

        $this->totsuratbaru = $totsuratbaru;
        $this->totdisposisibaru = $totdisposisibaru;
        $this->totdokumenbaru = $totdokumenbaru;

    }
}
