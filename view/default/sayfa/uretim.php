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
$sayfa = "uretim";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> '' and kid = 4");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],"sayfa", $boyut);
$sidebar = $this->dbLangSelect("sayfa", "aktif = 1 and baslik <> '' and kid = 4");


if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>


<?
echo $this->_include('bolum/sayfa',[
    "baslik" => $this->lang->header($sayfa),
    "contentClass"=>"service-details pt-60 pb-60",
    "page" => $sayfa,
    "middle_line"=>true,
    //'breadcrumbs' => array(array("title"=>$this->lang->header($sayfa), "href"=>$this->baseURL($this->lang->link("kurumsal"), $lang, 1)), array("title"=>$baslik)),
    'type' => "open",
    'container'=>false,
    'row'=>false
], $this->theme);
?>

<!--
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
                echo $this->_include('bolum/belge',["katurl"=>$katurl, "lang"=>$lang], $this->theme);
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
                "baslik"=>$this->lang->header("kurumsal"),
                "id" => $id,
                "page" => $sayfa,
                "lang" => $lang,
                "katurl"=>$katurl,
            ));
            ?>
        </div>



    </div>
</div>
-->


<style>
    .widget {
    padding: 40px;
    margin-bottom: 30px;
    background-color: #f3f6f7;
    border-radius: 5px;
}

.widget_title {
    font-size: 20px;
    line-height: 1em;
    margin-bottom: 20px;
    margin-top: -0.07em;
}

.widget_nav_menu ul, .widget_meta ul, .widget_pages ul, .widget_archive ul, .widget_categories ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.widget_nav_menu li, .widget_meta li, .widget_pages li, .widget_archive li, .widget_categories li {
    display: block;
    position: relative;
}

.widget_nav_menu a:hover, .widget_meta a:hover, .widget_pages a:hover, .widget_archive a:hover, .widget_categories a:hover, .widget_nav_menu a.active, .widget_meta a.active, .widget_pages a.active, .widget_archive a.active, .widget_categories a.active {
    background-color: rgba(160,194,48, 1);
    color: white;
    box-shadow: 0 15px 43px 2px rgba(160,194,48;, 0.07);
}

</style>


<aside class="sidebar-area pt-30 pt-lg-0 pl-30">
   <div class="widget widget_categories">
      <h3 class="widget_title">ÜRÜNLERİMİZ</h3>
      <ul>
         <li>
            <a href="#" class="dropdown  active ">Medikal Ürünler
            <span style="float: right;" class="caret fa fa-angle-down"></span></a>
            <ul class="submenu" style="display: block;">
               <li><a class="" href="https://hunernano.com/urun-detay/tek-kullanimlik-tulum-kumasi-16.html">Tek Kullanımlık Tulum Kumaşı</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/tek-kullanimlik-medikal-yatak-ortusu-17.html">Tek Kullanımlık Medikal Yatak Örtüsü</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/tek-kullanimlik-medikal-kumas-cerrahi-onluk-kumasi-18.html">Tek Kullanımlık Medikal Kumaş (Cerrahi Önlük Kumaşı)</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/maske-esnek-kumasi-elastik-kulakli-19.html">Maske Esnek Kumaşı (Elastik Kulaklı)</a></li>
            </ul>
         </li>
         <li>
            <a href="#" class="dropdown ">Hijyen Bileşenleri
            <span style="float: right;" class="caret fa fa-angle-down"></span></a>
            <ul class="submenu">
               <li>
                  <a href="#" class="dropdown ">Bebek Bezi Bileşenleri
                  <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                  <ul class="submenu">
                     <li><a class="" href="https://hunernano.com/urun-detay/backsheet-20.html">Backsheet</a></li>
                     <li><a class="" href="https://hunernano.com/urun-detay/elastic-kumas-elastic-ears-21.html">Elastic Kumaş (Elastic ears)</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#" class="dropdown ">Yetişkin Bezi Bileşenleri
                  <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                  <ul class="submenu">
                     <li><a class="" href="https://hunernano.com/urun-detay/backsheet-22.html">Backsheet</a></li>
                     <li><a class="" href="https://hunernano.com/urun-detay/elastic-kumas-elastic-ears-23.html">Elastic Kumaş (Elastic ears)</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#" class="dropdown ">Hijyenik Ped Bileşenleri
                  <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                  <ul class="submenu">
                     <li><a class="" href="https://hunernano.com/urun-detay/backsheet-25.html">Backsheet</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li>
            <a href="#" class="dropdown ">Endüstriyel Ürünler
            <span style="float: right;" class="caret fa fa-angle-down"></span></a>
            <ul class="submenu">
               <li><a class="" href="https://hunernano.com/urun-detay/cati-ortuleri-8.html">Çatı Örtüleri</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/hali-dis-ambalaj-9.html">Halı Dış Ambalaj</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/palet-ortusu-10.html">Palet Örtüsü</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/duz-koruklu-torba-11.html">Düz Körüklü Torba</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/shrink-film-12.html">Shrink Film</a></li>
            </ul>
         </li>
         <li>
            <a href="#" class="dropdown active">Spunbond Nonwoven (Dokusuz Kumaş)
            <span style="float: right;" class="caret fa fa-angle-down"></span></a>
            <ul class="submenu" style="display: block;">
               <li><a class="" href="https://hunernano.com/urun-detay/ss-nonwoven-dokusuz-kumas-13.html">SS Nonwoven (Dokusuz Kumaş)</a></li>
               <li><a class="" href="https://hunernano.com/urun-detay/sms-nonwoven-dokusuz-kumas-14.html">SMS Nonwoven (Dokusuz Kumaş)</a></li>
            </ul>
         </li>
      </ul>
   </div>
</aside>
<?
echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>




