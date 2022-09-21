<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "sayfa";
$sayfa = "politikalar";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> '' and kid = 3");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],"sayfa", $boyut);
$sidebar = $this->dbLangSelect("sayfa", "aktif = 1 and baslik <> '' and kid = 3");


if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>


<?
echo $this->_include('bolum/sayfa',[
    "baslik" => $this->lang->header("politikalarimiz"),
    "contentClass"=>"service-details pt-60 pb-60",
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


        <div class="col-lg-8 order-lg-1">
            <div class="service-details-content">

                <h2 class="title"><?=$baslik?></h2>

                <div class="content-text add-ul-style add-table-style">
                    <?=$this->detay($veri)?>
                </div>

                <? if ($resim){?>
                    <div class="main-thumb mt-40">
                        <img src="<?=$resim?>" alt="<?=$baslik?>">
                    </div>
                <? } ?>


                <?
                $grid_size = "col-lg-4 col-6";
                $this->dosyalar(array(
                    "type" => "sayfa",
                    "tur" => "kurumsal",
                    "boyutlar" => $ek_boyut,
                    'data_id' => $id,
                    "grid_size" => $grid_size,
                    "katurl" => $katurl
                ));
                ?>




            </div>

        </div>




        <div class="col-lg-4 order-lg-0">
            <?php
            $this->sidebar(array(
                "sql" => $sidebar,
                'table'=>$table,
                "baslik"=>$this->lang->header("politikalarimiz"),
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



