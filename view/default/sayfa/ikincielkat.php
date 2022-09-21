
<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "ikinciel";
$sayfa = "ikincielkat";
$veri = $this->dbLangSelect('ikinciel_kategori', 'aktif = 1 and baslik <> "" and url = "'.$katurl.'-'.$id.'"', 'resim,icon')[0];


//var_dump($veri); die;

$p = 'ikinciel_kategori';
if(!is_array($veri)){
    $veri = $this->dbLangSelect('ikinciel', 'aktif = 1 and baslik <> ""and url = "'.$katurl.'-'.$id.'"', 'resim,icon')[0];
    $p = 'ikinciel';
    if(!is_array($veri)){
        $dt = $this->dbLangSelect('ikinciel', 'aktif = 1 and baslik <> "" and kid = '.$id, 'resim,icon');
    }

}else {
    $dt = $this->dbLangSelect('ikinciel_kategori', 'aktif = 1 and baslik <> "" and ustu = '.$veri[$mid.'id'], 'resim,icon');
    if(!is_array($dt)){ 
        $dt = $this->dbLangSelect('ikinciel', 'aktif = 1 and baslik <> ""  and kid = '.$veri[$mid.'id'], 'resim,icon');
        $p = "ikinciel";
    }
    if(is_array($dt)){
        $dm = $this->dbLangSelect('ikinciel', 'aktif = 1 and baslik <> "" and kid = '.$veri[$mid.'id'], 'resim,icon');
    }

    //var_dump($dm); die;

}
if($p == 'ikinciel_kategori'){
    $ust_kat = $this->dbLangSelectRow('ikinciel_kategori', ['id'=>$veri['ustu'], 'master_id'=>$veri['ustu']]);
}

//var_dump($p);

if($p == 'ikinciel'){
    $ust_kat = $this->dbLangSelectRow('ikinciel', ['kid'=>$veri['id'], 'master_id'=>$veri['id']]);
    $katt = $this->dbLangSelectRow('ikinciel_kategori', ['id'=>$veri['id'], 'master_id'=>$veri['id']]);
    /* ek */

    //var_dump( $katt); die;

$veri2 = $this->dbLangSelectRow('ikinciel',array("id"=>$id, "master_id"=>$id), "resim,detay_resim");


$getID2 = $this->getID($veri2);
$baslik = $this->temizle($veri2["baslik"]);


$resimler_galeri = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'ikinciel' and tur = 'resim' and aktif = 1  and data_id = $id and sil <> 1 ORDER BY sira ASC");

$katalog = $this->dbLangSelectRow("katalog",array("id"=>$id, "master_id"=>$id), "resim,detay_resim");


/* katalog */
$katalog_dosya = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'ikincielekatalog' and tur = 'dosya' and aktif = 1 and sil <> 1 ORDER BY sira ASC");

$katalog_dosya2 = $this->dbLangSelectRow("dosyalar",array("tur" => "dosya" , "data_id"=>"1"), "resim,detay_resim");


$katalog_calis = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'ikinciel' and tur = 'dosya' and aktif = 1  and data_id = $id and sil <> 1 ORDER BY sira ASC");


//var_dump($katalog_dosya); die;

$kid = $this->temizle($veri2["kid"]);
$kid2 = $this->temizle($veri2["kid2"]);
$detay = $this->temizle($veri2["detay"]);
$ozet = $this->temizle($veri2["ozet"]);
$kategori = $this->dbLangSelectRow("ikinciel_kategori",array("id"=>$kid, "master_id"=>$kid), "resim,detay_resim");
$marka = $this->dbLangSelectRow("marka_kategori",array("id"=>$kid2, "master_id"=>$kid2), "resim,detay_resim");


$marka_resim = $this->dbResimAl($marka["resim"], "marka_kategori", '375x238', true);



/* #ek */
}


$getID = $this->getID($veri);

$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);



$resimler_galeri = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type ='ikinciel' and tur = 'resim' and aktif = 1  and data_id = $id and sil <> 1 ORDER BY sira ASC");


//$resimler = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = '".$p."' and tur = 'resim' and aktif = 1 and data_id = $getID and sil <> 1 ORDER BY sira ASC");


if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;
?>



<? // var_dump($ust_kat);  ?>

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



        <!-- ÜRÜN -->

<div class="rs-project style6 pt-50 pb-50 md-pt-70 md-pb-70">
    <div class="container">
    <? if (isset($dt) && is_array($dt)):?>

        <div class="row">
<? // var_dump($dt); ?>

        <span class="sub-text small"> <?=$baslik?></span> 

        <?  if($p == "ikinciel_kategori") { ?>

            <h3 class="category_title"> Alt Kategoriler</h3>

         

            <?   
            foreach ($dt as $item):
                $resim = $this->dbResimAl($item["resim"], $p, '375x238', true);
                $icon = $this->dbResimAl($item["icon"], $p, '64x64', true);
                $url = $this->getURL($item,"ikincielkat");


                $urun = $this->dbLangSelectRow('ikinciel', ['kid'=>$item['id']]);     
                if(is_array($urun)){
            ?>

              
<?// var_dump($p); ?>

                <div class="col-lg-6 col-md-6 mb-30">
                    <div class="project-item">
                        <div class="project-img">
                            <a href="<?=$url?>">
                                <img src="<?=$resim?>" alt="images">
                                <span class="p-icon"><i class="custom-icon"></i></span>
                            </a>
                        </div>
                        <div class="project-content">
                            <h3 class="title"><a href="<?=$url?>"><?=$item['baslik']?></a></h3>
                        </div>
                    </div>
                </div>



            <? } endforeach;   ?>




         
        
            <? if($dm != 0) { ?>
                <h3 class="category_title"> Ürünler</h3>

            <?
            foreach ($dm as $item):
                $resim = $this->dbResimAl($item["resim"],"ikinciel" ,'375x238', true);
                $icon = $this->dbResimAl($item["icon"], "ikinciel", '64x64', true);
                $url = $this->getURL($item,"ikincielkat");
            ?>
<? // var_dump($dm);  ?>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="project-item">
                        <div class="project-img">
                            <a href="<?=$url?>">
                                <img src="<?=$resim?>" alt="images">
                                <span class="p-icon"><i class="custom-icon"></i></span>
                            </a>
                        </div>
                        <div class="project-content">
                            <h3 class="title"  ><a href="<?=$url?>"><?=$item['baslik']?></a></h3>
                        </div>
                    </div>
                </div>

            <? endforeach;  } ?>


        <? } else { ?>


    <div class="rs-project style3 pt-50 pb-50 md-pt-70 md-pb-70">
      <!--  <div class="container"> -->
            <div class="row">


            <div class="col-lg-8">
                <div class="row">
                    <?
                                foreach ($dt as $item):
                                    $resim = $this->dbResimAl($item["resim"], $p, '342x192', true);
                                    $icon = $this->dbResimAl($item["icon"], $p, '64x64', true);
                                    $url = $this->getURL($item,"ikincielkat");    
                    ?>

            <? // var_dump($dt); die;  ?>


                    



                                    <div class="col-lg-6 col-md-6 mb-30">
                                        <a href="<?=$url?>">
                                        <div class="project-item">
                                            <div class="project-img">
                                            <span><img src="<?=$resim?>" alt="images"></span>
                                            </div>
                                            <div class="project-content">
                                                <div class="portfolio-inner">                                         
                                                        <span class="category"><span><?=$marka['baslik']?></span></span>                                         
                                                    <h3 class="title" style="font-size: 16px;"><span><?=$item['baslik']?><span></h3>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    



                    <? endforeach;  ?>
            </div>
        </div>



        <div class="col-lg-4">
            <aside class="sidebar-area  pt-lg-0">
                <div class="widget widget_categories">

                    <ul class="services-list">
                      
                        <?=$this->multipleSubmenu_ikinciel(0, $this->lang->link("ikincielkat"), ((isset($katt)) ? $katt["url"] : 'null'));?>
                        <? //var_dump($katt);  ?>

                    </ul>
                </div>
            </aside>
        </div>
               


            </div>
       <!-- </div>  -->
    </div>
    <?php } ?>


     <? else: ?>

    </div>

                <div class="rs-services-single pt-40 pb-40 md-pt-70 md-pb-70">

                   
            
                    <div class="container custom">
                        
                        
                    
                
                        <div class="row  mobile_bosluk_geri">

                            <div>
                            <!--  geri dön  -->
                            <a class="readon go_to_back" href="javascript:history.back()" style="color:black" title="">Geri Dön</a>
                            <!-- #geri dön --> 
                            </div>

                            <span class="sub-text small"> <?=$baslik?></span>


                            <div class="col-lg-7 pr-45 md-pr-15 md-mb-50">



                                <!-- Slider -->

                                <!-- Slider Section Start -->
                                
                                <? if (is_array($resimler_galeri)):?>

                                <div class="rs-slider style4  pb-10">

                                    <div class="rs-carousel owl-carousel" data-loop="false" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="true" data-nav="false" data-nav-speed="false" data-center-mode="false"
                                        data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false"
                                        data-md-device="1" data-md-device-nav="false" data-md-device-dots="true">


                                        <?
                                        foreach ($resimler_galeri as $item):
                                            $resim46 = $this->dbResimAl($item["dosya"], "ikinciel", "609x400", true);
                                            $resim47 = $this->dbResimAl($item["dosya"], "ikinciel", "0x1200", true);
                                        ?>

                                        <div class="slider-img">
                                            <img src="<?=$resim46?>"  alt="Slider"> <!-- style="height: 400px;" -->
                                        </div>

                                        <? endforeach;?>

                                    </div>

                                </div>

                                <? endif;?>
                                <!-- Slider Section End -->


                                <!-- #Slider -->


                        
                                <div class="row" style="display:none">


                                    <!-- yeni -->
                                    


                                    <!-- #yeni -->


                                    <!-- kategori -->
                                    <!--
                                    <div class="col-lg-6">
                                    <? if(is_array($kategori)) { ?>
                                        <h6 style="margin-top: 10px;">Kategori</h6>
                                    <? } ?>
                                        <div class="btn-part mb-30">
                                            <a class="readon price big" href="javascript::0"><?=$kategori['baslik']?></a>
                                        </div>
                                    

                                    -->                                        <!-- #kategori -->
                                
                                    <!-- marka -->

                                    <!--
                                    <div class="col-lg-6">
                                    <? if(is_array($marka)) { ?>
                                        <h6 style="margin-top: 10px;">Marka</h6>

                                        <div class="btn-part mb-30">
                                            <a class="readon price big" href="javascript::0"><?=$marka['baslik']?></a>
                                        </div>
                                    <? } ?>
                                    </div>
                                    -->
                                    <!-- #marka -->
                                    </div>





                                <? //var_dump($katalog_dosya2); die;?>
                                <? //  if(is_array($katalog_calis)) { ?>
<?

//foreach ($katalog_calis as $item):
?>

<? // var_dump($item['dosya']);  ?>

<?// if(is_array($katalog_calis)){  ?> 
<!--
                                <div class="module-contact module-contact-2 mt-20">
                                    <a class="btn btn--primary " target="_blank" style="background-color: #504f4f;color: white;font-size: 15px;font-weight: bold;padding: 11px 22px 11px 22px;" href="http://localhost/gunser/upload/ikinciel/<?=$item['dosya']?>">E-Katalog</a>
                                </div>
-->
<? // }  endforeach; ?>

                                <? // } ?>






                            </div>


                            <div class="col-lg-5">

                         
                         
                 
                            <div class="blog-meta">
                                <ul class="btm-cate" style="justify-content: space-between;">
                                <? if(is_array($kategori)) { ?>
                                    <li>
                                        <div class="blog-date">
                                            <i class="fa fa-tag"></i><span  style="font-weight:bold">Kategori:</span> <?=$kategori['baslik']?>                                                       
                                        </div>
                                    </li>
                                <? } ?>

                                <? if(is_array($marka)) { ?>
                                    <li>
                                        <div class="author">
                                           <!-- <i class="fa fa-star"></i><span style="font-weight:bold">Marka:</span> <?//=$marka['baslik']?>  -->
                                           <i class="fa fa-star"></i><span style="font-weight:bold">Marka:</span> <img class="mobile_marka_resim" src="<?=$marka_resim?> " alt="images">  
                                        </div>
                                    </li> 
                                <? } ?>
                                </ul>
                            </div>
                            
                         
                           <ul class="listing-style mt-10">
                                <?=$ozet?> 
                            </ul>



                            <h5>Açıklama</h5>


                            <?=$this->detay($veri)?>

                            <!--
                            
                                <aside class="sidebar-area  pt-lg-0">
                                    <div class="widget widget_categories">

                                        <ul class="services-list">
                                            <? //var_dump($veri2['kid']); die;  ?>
                                            <?//=$this->multipleSubmenu_ikinciel(0, $this->lang->link("ikincielkat"), ((isset($katt)) ? $katt["url"] : 'null'));?>

                                        </ul>
                                    </div>
                            
                                </aside>
                            
                            -->

                             

                            </div>




                        </div>
                    </div>
                </div>
                    
     <? endif;?>

    </div>
</div>
</div>

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
