
<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "hizmet";
$sayfa = "detay";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$resim = $this->dbResimAl($veri["resim"],"hizmet", $boyut);


if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>


<?
echo $this->_include('bolum/sayfa',[
    "baslik" => $baslik,
    "contentClass"=>" pt-80 pb-70 mt-lg-100",
    "page" => $sayfa,
    "middle_line"=>true,
    //'breadcrumbs' => array(array("title"=>$this->lang->header($sayfa), "href"=>$this->baseURL($this->lang->link("kurumsal"), $lang, 1)), array("title"=>$baslik)),
    'type' => "open",
    'container'=>false,
    'row'=>false
], $this->theme);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 justify-content-end d-flex  mb-40 mb-md-0">
            <? if ($resim){?>
                <img src="<?=$resim?>" alt="<?=$baslik?>" style="height: 460px; width: auto; max-width: inherit">
            <? } ?>
        </div>

        <div class="col-md-6 ">
            <div class="index-about">
                <h3 class="line-text"><?=$baslik?></h3>
                <?=$this->detay($veri)?>

            </div>
        </div>

    </div>
</div>




<?
echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>



