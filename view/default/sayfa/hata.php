<?php
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */
$this->sayfaBaslik = "Hata 404 - ".$this->ayarlar("title_tr");
$kategoriler = $this->dbLangSelect("d_kategori", "aktif = 1");
?>

<style>
    a:active, a:hover {
    color: #ffc702 !important;
}
</style>

<div id="rs-page-error"  style="text-align: center;margin-top: 120px;" class="rs-page-error">
    <div class="error-text">
        <h1 class="error-code text-theme">HATA (404)</h1>
        <h3 class="error-message">ARADIĞINIZ SAYFA BULUNAMADI</h3>
        <a class="readon" href="javascript:history.back()" style="color:black" title="">Geri Dön</a>
    </div>
</div>




