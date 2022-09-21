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
$sayfa = "kullanim_alanlari";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> ''");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim,slayt,icon");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],$table, $boyut);
$banner_resim = $this->dbResimAl($veri["slayt"],$table, "1920x650");
$sidebar = $this->dbLangSelect("hizmet", "aktif = 1 and baslik <> ''");


if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>


<?
echo $this->_include('bolum/sayfa',[
    "baslik" => $this->lang->header($sayfa),
    "contentClass"=>"intro-section rs-inner-blog  pt-94 pb-100 md-pt-64 md-pb-70 loaded",
    "page" => $sayfa,
    'resim'=>$banner_resim,
    'breadcrumb_class'=>'breadcrumbs-overlay',
    //'breadcrumbs' => array(array("title"=>$this->lang->header($sayfa), "href"=>$this->baseURL($this->lang->link("kurumsal"), $lang, 1)), array("title"=>$baslik)),
    'type' => "open",
    'container'=>false,
    'row'=>false
], $this->theme);
?>

<div class="container">
    <div class="row">



        <div class="col-lg-9 pr-50 md-pr-15 order-lg-1">
            <div class="blog-deatails">
                <? if ($resim){?>
                    <div class="bs-img">
                        <img src="<?=$resim?>" alt="<?=$baslik?>">
                    </div>
                <? } ?>

                <div class="blog-full">
                    <h2 class="title"><?=$baslik?></h2>
                    <div class="blog-desc">
                        <?=$this->detay($veri)?>
                    </div>
                </div>
            </div>


        </div>


        <div class="col-lg-3 col-md-12 order-lg-0  mt-50 mt-lg-0">
            <?php
            $this->sidebar(array(
                "sql" => $sidebar,
                'table'=>$table,
                "baslik"=>$this->lang->header($sayfa),
                "id" => $id,
                "page" => $sayfa,
                "lang" => $lang,
                "katurl"=>$katurl,
            ));
            ?>
        </div>



    </div>
</div>




<?
echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>



