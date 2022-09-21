
<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "urun";
$sayfa = "urunkat";
$veri = $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and url = "'.$katurl.'-'.$id.'"', 'resim')[0];

//$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");


//var_dump($veri); die;

$p = 'kategori';
if(!is_array($veri)){
    $veri = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and url = "'.$katurl.'-'.$id.'"', 'resim')[0];
    $p = 'urun';
    if(!is_array($veri)){
        $dt = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> ""  and kid = '.$id, 'resim');
    }

}else {
    $dt = $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and ustu = '.$veri[$mid.'id'], 'resim');
    if(!is_array($dt)){ 
        $dt = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> ""  and kid = '.$veri[$mid.'id'], 'resim');
        $p = "urun";
    }
    if(is_array($dt)){
        $dm = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> ""  and kid = '.$veri[$mid.'id'], 'resim');

    }

    //var_dump($dm); die;

}

//*********************var_dump($p);
if($p == 'kategori'){
    $ust_kat = $this->dbLangSelectRow('kategori', ['id'=>$veri['ustu'], 'master_id'=>$veri['ustu']]);
}

//var_dump($p);

if($p == 'urun'){
    $ust_kat = $this->dbLangSelectRow('urun', ['kid'=>$veri['id'], 'master_id'=>$veri['id']]);
    $katt = $this->dbLangSelectRow('kategori', ['id'=>$veri['kid'], 'master_id'=>$veri['kid']]);
    /* ek */


$veri2 = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");

$getID2 = $this->getID($veri2);
$baslik = $this->temizle($veri2["baslik"]);


$resimler_galeri = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'urun' and tur = 'resim' and aktif = 1  and data_id = $id and sil <> 1 ORDER BY sira ASC");






$kid = $this->temizle($veri2["kid"]);
$kid2 = $this->temizle($veri2["kid2"]);
$detay = $this->temizle($veri2["detay"]);
$ozet = $this->temizle($veri2["ozet"]);
$kategori = $this->dbLangSelectRow("kategori",array("id"=>$kid, "master_id"=>$kid), "resim");
$marka = $this->dbLangSelectRow("marka_kategori",array("id"=>$kid2, "master_id"=>$kid2), "resim");

$marka_resim = $this->dbResimAl($marka["resim"], "marka_kategori", '375x238', true);

/* #ek */
}


$getID = $this->getID($veri);

$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);


$resimler = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = '".$p."' and tur = 'resim' and aktif = 1 and data_id = $getID and sil <> 1 ORDER BY sira ASC");



/* kategori sidebar */
$kategori_sidebar= $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and sil != 1 and ustu = 0', 'resim'); 

$kategori_sidebar_alt= $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and sil != 1 and ustu != 0', 'resim'); 




if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;
?>



<?  //var_dump($veri2);  var_dump($kid);  ?>

<div class="page-content bg-white">
		
        <!-- Banner  -->
        <div class="dz-bnr-inr dz-bnr-inr-sm overlay-black-middle text-center" style="background-image: url(<?=$assetURL?>img/bnr1.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1><?=$baslik?></h1>
                </div>
            </div>
        </div>
        <!-- Banner End -->



        <!-- ÜRÜN -->

        <section class="content-inner">

            <div class="rs-project style6 pt-50 pb-50 md-pt-70 md-pb-70">
                <div class="container">

                <? if (isset($dt) && is_array($dt)):?>
                
                <span style="margin-bottom: 30px; display:none" class="sub-text small"> <?=$baslik?></span>

                    <div class="row">


                        <div class="col-lg-4">
                            <aside class="sidebar-area  pt-lg-0 pb-20 side-bar sticky-top right">
                                <div class="widget widget_categories  widget style-1">  <!-- service_menu_nav -->


                                    <div class="widget-title">
                                        <h4 class="title"> <?=$this->lang->header('kategori')?> </h4>
                                    </div>


                                    <ul>  <!--  class="menu services-list" -->

                                        <?
                                        foreach ($kategori_sidebar as $item):
                                            $resim = $this->dbResimAl($item["resim"], $table,"375x238", true);
                                            $url = $this->getURL($item,"urunkat");
                                            $kategori_alt2 = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> '' and ustu=".$item[$mid.'id'], "resim", "");
                                            $kategori_noaltkategori = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> '' and ustu = 0 ", "resim", "");

                                        ?>

                                            <?// var_dump($kategori_sidebar); ?>

                                            <?//  var_dump($kategori_alt2);  ?>

                                            <? //var_dump($kategori_urun2);  ?> 



                                                <li class="">  <!--cat-item  "menu-item" -->
                                                    
                                                    
                                                    <a class="dropdown <?= $item['id'] == $getID ? 'active' : ' '  ?>" href="<?=$url?>" class=""><?=$item['baslik']?><span style="float: right;color: #0b2a3c;" class="caret fa fa-angle-down ms-2"></span></a>


                                                    <ul>  <!--  style="display: block;" -->

                                                        <? if($kategori_alt2 != '') { ?>
                                                           
                                                            <?
                                                            foreach ($kategori_alt2 as $item):
                                                                $resim = $this->dbResimAl($item["resim"], $table,"800x600", true);
                                                                $url = $this->getURL($item,"urunkat");
                                                                $kategori_urun2 = $this->dbLangSelect("urun", "aktif = 1 and baslik <> '' and kid=".$item[$mid.'id'], "resim", "");
                                                            ?>
                                                                    <? // if($kategori_urun2 != 0) {  ?>

                                                                        <li class="cat-item"><a class=" <?= $item['id'] == $getID ? 'active' : ' '  ?>" href="<?=$url?>"><?=$item['baslik']?></a></li>
                                                            
                                                                    <? // } ?>

                                                            <? endforeach;?>
                                                        <? } ?>

                                                        
                                                


                                                    </ul>


                                                </li>


                                        <? endforeach;?>

                                    </ul>
                                </div>
                            </aside>
                        </div>


                        <? //var_dump($p); die; ?>


                        <?  if($p != "urun") { ?>

                            <div class="col-lg-8">
                                <div class="row">
                                            <h3  class="category_title"> <?=$this->lang->header('alt_kategoir')?> </h3>


                                        <?   foreach ($dt as $item):
                                                $resim = $this->dbResimAl($item["resim"], $p, '400x400', true);
                                                $icon = $this->dbResimAl($item["icon"], $p, '64x64', true);
                                                $url = $this->getURL($item,"urunkat");
                                            ?>

                                            

                                            <div class="col-lg-6 col-md-6 mb-30 mb-5">
                                                <div class="content-box2 overlay-shine">
                                                    <div class="dz-info">
                                                        <h3 class="title"><?=$item['baslik']?></h3>
                                                    </div>
                                                    <div class="dz-media m-b30">
                                                        <img src="<?=$resim?>" alt="">
                                                    </div>
                                                    <div class="dz-bottom">
                                                        <a href="<?=$url?>" class="btn-link"><?=$this->lang->genel('fazla')?> <i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                                

                       

                                            <? endforeach;  ?>

                                        
                                            <? if($dm != 0) { ?>
                                                <h3 class="category_title mt-5"> <?=$this->lang->header('urunler')?> </h3>

                                            <?
                                            foreach ($dm as $item):
                                                $resim = $this->dbResimAl($item["resim"],"urun" ,'400x400', true);
                                                $icon = $this->dbResimAl($item["icon"], "urun", '64x64', true);
                                                $url = $this->getURL($item,"urunkat");
                                            ?>

                                                    
                                                <div class="col-lg-6 col-md-6 mb-30 mb-5">
                                                    <div class="content-box2 overlay-shine">
                                                        <div class="dz-info">
                                                            <h3 class="title"><?=$item['baslik']?></h3>
                                                        </div>
                                                        <div class="dz-media m-b30">
                                                            <img src="<?=$resim?>" alt="">
                                                        </div>
                                                        <div class="dz-bottom">
                                                            <a href="<?=$url?>" class="btn-link"><?=$this->lang->genel('fazla')?> <i class="fas fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>


                                            <? endforeach;  } ?>


                                        </div>


                                </div>
                            </div>
                            
                        <? } else {  ?>



                        <div class="col-lg-8">

                            <div class="rs-project style3  pb-50 md-pt-70 md-pb-70">
                                <div class="container">
                                    <div class="row">


                                        <?
                                        foreach ($dt as $item):
                                            $resim = $this->dbResimAl($item["resim"], $p, '400x400', false);
                                            $icon = $this->dbResimAl($item["icon"], $p, '64x64', false);
                                            $url = $this->getURL($item,"urunkat");    
                                        ?>

                                    <? // var_dump($resim);die;  ?>


                                                <!-- Ürün resmi -->

                                                <div style="display:none" class="col-lg-6 col-md-6 mb-5">
                                                    <a href="<?=$url?>">
                                                        <div class="project-item">
                                                            <div class="project-img">
                                                                <? if($resim != '') { ?>
                                                                <span><img src="<?=$resim?>" alt="images"></span>
                                                                <? } ?>
                                                            </div>
                                                            <div class="project-content">
                                                                <div class="portfolio-inner">                                         
                                                                    <span class="category"><span><?=$marka['baslik']?></span></span>                                         
                                                                    <h3 class="title"><span><?=$item['baslik']?><span></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                    

                                                           
                                                <div class="col-lg-6 col-md-6 mb-30 mb-5">
                                                    <div class="content-box2 overlay-shine">
                                                        <div class="dz-info">
                                                            <h3 class="title"><?=$item['baslik']?></h3>
                                                        </div>
                                                        <div class="dz-media m-b30">
                                                            <? if($resim != '') { ?>
                                                            <img src="<?=$resim?>" alt="">
                                                            <? } ?>
                                                        </div>
                                                        <div class="dz-bottom">
                                                            <a href="<?=$url?>" class="btn-link"><?=$this->lang->genel('fazla')?> <i class="fas fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- #Ürün resmi -->


                                    <? endforeach; } ?>

                                    </div>
                                </div>
                            </div>

                        </div>


                        <? else: ?>

                    </div>



                    <!-- Ürünler -->

                    <?
                    if(is_array($this->dbLangSelect("urun", "aktif = 1 and url = '".$katurl."-".$id."'"))):
                    ?>


                    <section class="content-inner">
                        <div class="rs-services-single pt-40 pb-40 md-pt-70 md-pb-70">
                            <div class="container custom">


                                <div class="row">

                            

                                    <div class="col-lg-8 pr-45 md-pr-15 md-mb-50">



                                        <!-- Slider Resim Ürün -->
                                        
                                            <? if (is_array($resimler_galeri)):?>

                                        <div class="row sticky-top">

                                            <div class="col-3 position-relative">
                                                <div class="swiper-container thumb-slider sync2">
                                                    <div class="swiper-wrapper">
                                                
                                                        <?
                                                        foreach ($resimler_galeri as $item):
                                                            $resim46 = $this->dbResimAl($item["dosya"], "urun", "300x300", true);  /* 609x400 */
                                                        ?>



                                                            <div class="swiper-slide">
                                                                <div class="dz-media">
                                                                    <img src="<?=$resim46?>" alt="">
                                                                </div>
                                                            </div>


                                                        <? endforeach;?>

                                                    </div>

                                                    <div class="thumb-slider-navigation">
                                                        <div class="swiper-button-next-thumb">
                                                        
                                                        </div>
                                                        <div class="swiper-button-prev-thumb">
                                                        
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                       


                                            <div class="col-9">
                                                <div class="swiper-container single-image-slider sync1 lightgallery">
                                                    <div class="swiper-wrapper">


                                                        <?
                                                        foreach ($resimler_galeri as $item):
                                                            $resim46 = $this->dbResimAl($item["dosya"], "urun", "1200x1200", true);  /* 609x400 */
                                                            $resim47 = $this->dbResimAl($item["dosya"], "urun", "0x1200", true);
                                                        ?>



                                                            <div class="swiper-slide">
                                                                <div class="dz-thum-bx">
                                                                    <img src="<?=$resim46?>" alt="">
                                                                    <div class="overlay-bx">
                                                                        <div class="overlay-icon">
                                                                            <span data-exthumbimage="<?=$resim46?>" data-src="<?=$resim46?>" class="view-btn lightimg">
                                                                                <svg width="75" height="74" viewBox="0 0 75 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M44.5334 27.7473V32.3718C44.5334 33.3257 43.7424 34.106 42.7755 34.106H34.572V42.199C34.572 43.1528 33.7809 43.9332 32.8141 43.9332H28.1264C27.1595 43.9332 26.3685 43.1528 26.3685 42.199V34.106H18.1649C17.1981 34.106 16.4071 33.3257 16.4071 32.3718V27.7473C16.4071 26.7935 17.1981 26.0131 18.1649 26.0131H26.3685V17.9201C26.3685 16.9663 27.1595 16.1859 28.1264 16.1859H32.8141C33.7809 16.1859 34.572 16.9663 34.572 17.9201V26.0131H42.7755C43.7424 26.0131 44.5334 26.7935 44.5334 27.7473ZM73.9782 68.8913L69.8325 72.9812C68.4555 74.3396 66.2288 74.3396 64.8664 72.9812L50.2466 58.5728C49.5874 57.9225 49.2212 57.0409 49.2212 56.116V53.7604C44.05 57.749 37.5458 60.1191 30.4702 60.1191C13.6384 60.1191 0 46.6646 0 30.0596C0 13.4545 13.6384 0 30.4702 0C47.3021 0 60.9405 13.4545 60.9405 30.0596C60.9405 37.0397 58.538 43.4563 54.4949 48.5578H56.8827C57.8202 48.5578 58.7138 48.9191 59.373 49.5694L73.9782 63.9777C75.3406 65.3362 75.3406 67.5329 73.9782 68.8913ZM50.3931 30.0596C50.3931 19.1919 41.4864 10.4052 30.4702 10.4052C19.4541 10.4052 10.5474 19.1919 10.5474 30.0596C10.5474 40.9273 19.4541 49.7139 30.4702 49.7139C41.4864 49.7139 50.3931 40.9273 50.3931 30.0596Z" fill="white" fill-opacity="0.66"/>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        <? endforeach;?>

                                                    

                                               
                                                    
                                                    </div>
                                                    <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                </div>
                                            </div>


                                            <? endif;?>

                                            <!-- #Slider  Resim Ürün -->



                                            <!-- Ürün Tab Menu  -->
                                            <div id="rs-single-shop" class="row m-b80 m-sm-b30">            
                                                <div class="col-xl-12">
                                                    <div class="product-description tabs-site-button">
                                                        <ul class="nav nav-tabs ">
                                                            <li><a data-bs-toggle="tab" href="#web-design-1" class="active"> <?=$this->lang->header('aciklama')?>  </a></li>
                                                            <li><a data-bs-toggle="tab" href="#graphic-design-1"><?=$this->lang->header('teklif')?>    </a></li>
                                                        </ul>


                                                        <div class="tab-content">


                                                                <div id="web-design-1" class="tab-pane active">
                                                                    <p class="m-b10"> 
                                                                        <?=$this->detay($veri)?>
                                                                    </p>                                         
                                                                </div>



                                                                <div id="graphic-design-1" class="tab-pane">
                                                                    <?
                                                                    Form::Open(array(
                                                                        "class" => "contact-form teklifform",
                                                                        "id"=>"teklifform",
                                                                        "method" => "post",
                                                                        "name"=>"teklifform",
                                                                        "action" => $this->baseURL("ajax/teklif", "tr", 1),
                                                                        "token" => true,
                                                                        "message" => array(
                                                                            ["no" => 1, "title" => $this->lang->iletisim("formsucces"), "status" => "alert-success"],
                                                                            ["no" => 2, "title" => $this->lang->iletisim("formerror"), "status" => "alert-error"],
                                                                            ["no" => 3, "title" => $this->lang->iletisim("formvalid"), "status" => "alert-warning"],
                                                                            ["no" => 4, "title" => $this->lang->iletisim("doldur"), "status" => "alert-warning"],
                                                                        ),
                                                                        "lang"=>$lang
                                                                    ));
                                                                    ?>
                                                                        <fieldset>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-30 input-group">
                                                                                    <input class="form-control change_black" type="text" name="urun" placeholder="Ürün Adı: <?=$baslik?>" value="<?=$baslik?>" readonly>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                                                                    <input class="form-control" type="text"  name="adi" placeholder=" <?=$this->lang->iletisim('adi')?> " required="">
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                                                                    <input class="form-control" type="email" name="email" placeholder="<?=$this->lang->iletisim('email')?>" required="">
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                                                                    <input class="form-control" type="text"  name="tel" placeholder="<?=$this->lang->iletisim('tel')?>" required="">
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                                                                    <input class="form-control" type="text"  name="konu" placeholder="<?=$this->lang->iletisim('firma_adi')?>" required="">
                                                                                </div>


                                                                                <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                                                                                    <div class="padding_top15 text-center">
                                                                                        <div class="alert" style="display: none"></div>
                                                                                        <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor btn w-100 btn-primary btn-border" type="submit"><?=$this->lang->iletisim("gonder")?><i class="flaticon flaticon-right-arrow"></i></button>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </fieldset>
                                                                    <?
                                                                    Form::Close();
                                                                    ?>


                                                                </div>
                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- #Ürün Tab Menu  -->
                                
                                    
                                
                                        </div>
                                    </div>



                                    <!-- Ürün sag taraf -->
                                    <div class="col-lg-4 m-b40">
                                   
                                      
                                        <div class="dlab-post-title ">
                                            <h3 class="post-title"><?=$baslik?></h3>
                                            <p class="m-b30">  <?=$ozet?>   </p>
                                        </div>
                                        <div class="position-relative">

                                            <? if(is_array($kategori)) { ?>
                                                <h3 class="m-tb10"><?=$this->lang->header('kategori')?> </h3>
                                                <span> <?=$kategori['baslik']?> </span>   
                                            <? } ?>

                                            <? if(is_array($marka)) { ?>
                                                <h3 class="m-tb10"><?=$this->lang->header('marka')?></h3>
                                                <span><?=$marka['baslik']?></span>
                                            <? } ?>

                                        </div>
                                        
                                    </div>
                                     <!-- #Ürün sag taraf -->




                                </div>


                            </div>
                        </div>
                    </section>

                    <!-- #Ürünler -->


                    
                    <!-- Ürün sayfasi diger urunler  -->

                    <section class="content-inner">
                        <div class="container custom">

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="swiper-container related-item-swiper">
                                        <div class="swiper-wrapper">

                                        <? $diger_urun = $this->dbLangSelect("urun", "aktif = 1 and baslik <> '' and kid=".$kid, "resim", ""); ?>


                                            <?
                                            $count=1;
                                            foreach ($diger_urun as $item) {  
                                                $resim = $this->dbResimAl($item["resim"], "urun", "1200x1200", true);  /* 609x400 */
                                                $url = $this->getURL($item,"urunkat");
                                            ?>

                                            <? // var_dump($diger_urun); die;  ?>

                                            
                                            <div class="swiper-slide" role="group" aria-label="<?=$count?> / <?//= count($count)?>" style="width: 269.75px; margin-right: 30px;">
                                                <div class="item-box">
                                                    <div class="item-img">
                                                        <img src="<?=$resim?>" alt="">
                                                        <span class="badge bg-danger"> <?=$this->lang->header('urunler')?> </span>
                                                    </div>
                                                    <div class="item-info text-center">
                                                        <h4 class="item-title"><a href="<?=$url?>"> <?=$item['baslik']?> </a></h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <?
                                              $count = $count + 1;
                                             } 
                                             ?>
                                                
                                        </div>

                                        <div class="swiper-button-next-related"></div>
                                        <div class="swiper-button-prev-related"></div>

                                    </div>
                                </div>   
                            </div>

                        </div>
                    </section>

                    <!-- #ÜRün sayfasi diger ürünler -->




                    <?php else: ?>

                        <div class="alert alert-warning" style="width: 50%;text-align: center;margin: auto;"><?=$this->lang->genel("no_record")?></div>

                    <?php endif; ?>
            
                    
             <? endif;?>

        </div>
    </div>
</div>


</section>
        <!-- ÜRÜN -->



<script>
jQuery(window).on("load", function() {
    if (jQuery(".rs-project").length) {
        setTimeout(function() {
            jQuery(".gridFilter").find("button:first-child").trigger("click");
        }, 200);
    }

});
</script>
