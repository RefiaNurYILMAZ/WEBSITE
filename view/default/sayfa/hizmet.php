<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "hizmetlerimiz";
$sayfa = "hizmet";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> '' and kid = 1");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],"hizmetlerimiz", $boyut);
$sidebar = $this->dbLangSelect("hizmetlerimiz", "aktif = 1 and baslik <> '' and kid = 1");


$detay_resim = $this->dbResimAl($veri["detay_resim"],"hizmetlerimiz", "1200x400");
$detay = $this->temizle($veri["detay"]);



$coklu_galeri = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'hizmetlerimiz' and tur = 'resim' and aktif = 1  and data_id = $getID and sil <> 1 ORDER BY sira ASC");
  


$hizmet_sidebar   = $this->dbLangSelect("hizmetlerimiz","aktif = 1 and baslik <> '' ");



if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>



        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs img1">
            <div class="container">
                <div class="breadcrumbs-inner">
                    <h1 class="page-title">
                        <?=$baslik?>
                        <span class="watermark"><?=$baslik?></span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumbs End -->








     <!--       <div class="container mt-50">
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                </div>
            </div> -->


            <div class="rs-project mt-4 mb-4">
                <div class="container">
                    <div class="row">  


                        <div class="col-lg-4">
                            <aside class="sidebar-area  pt-lg-0">
                                <div class="widget widget_categories">
                                    <ul class="services-list">

                                        <?
                                        foreach ($hizmet_sidebar as $item):
                                            $resim = $this->dbResimAl($item["resim"], $table,"375x238", true);
                                            $url = $this->getURL($item,"hizmet");
                                        ?>

                                            <li><a class="<?= $item['id'] == $getID ? 'active' : ' '  ?>" href="<?=$url?>" class=""><?=$item['baslik']?></a></li>

                                         <? endforeach;?>

                                    </ul>
                                </div>
                            </aside>
                        </div>


                        <div class="col-lg-8">
                            
                            <div class="sec-title mb-64">
                                <h2 class="title title4 pb-20">
                                    <?=$baslik?>
                                </h2>
                            </div>
                                
                                
                            <? if($detay_resim != '')  { ?>
                                <div class="col-lg-12 col-12">
                                    <img src="<?=$detay_resim?>" alt="">
                                </div>
                            <? } ?>

                            <div class="col-lg-12 col-12">
                                <div class="sec-title mb-64">
                                   <!-- <h2 class="title title4 pb-20">
                                        <?//=$baslik?>
                                    </h2> -->
                                        <?=$detay?>
                                </div>
                            </div>

                            <div class="row">
                               
                                    
                                        <?
                                            if($coklu_galeri != '') { 

                                            foreach ($coklu_galeri as $item) {
                                                    $hizmet_resim = $this->dbResimAl($item["dosya"], "hizmetlerimiz", "357x200", true);
                                                    $hizmet_resim2 = $this->dbResimAl($item["dosya"], "hizmetlerimiz","0x1200", true);
                                                
                                        ?>

                                            <div class="col-lg-4 col-6 mb-2">
                                                <a href="<?=$hizmet_resim2?>" class="lightbox" data-fancybox="images" data-caption="<?=$item['baslik']?>">
                                                    <div class="image d-flex align-items-center">
                                                        <img src="<?=$hizmet_resim?>">
                                                    </div>
                                                </a>
                                            </div>

                                        <? }  } ?>
                                
                            </div>

                        </div>

               
                    </div>
                </div>
            </div>


         
            <!--
            <div class="container mb-20">
                <div class="row">

          

                <?
                /*
                    if($coklu_galeri != '') { 

                    foreach ($coklu_galeri as $item) {
                            $hizmet_resim = $this->dbResimAl($item["dosya"], "hizmetlerimiz", "357x200", true);
                            $hizmet_resim2 = $this->dbResimAl($item["dosya"], "hizmetlerimiz","0x1200", true);
                   */     
                ?>

                    <div class="col-lg-4 col-6 mb-2">
                        <a href="<?//=$hizmet_resim2?>" class="lightbox" data-fancybox="images" data-caption="<?//=$item['baslik']?>">
                            <div class="image d-flex align-items-center">
                                <img src="<?//=$hizmet_resim?>">
                            </div>
                        </a>
                    </div>

                <? // }  } ?>

                </div>
            </div>

            -->
           