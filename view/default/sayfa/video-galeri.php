<?
/* @var $this FrontClass|Loader object */

$table = "video";
$sayfa = "video-galeri";

$baslik = $this->lang->header($sayfa);
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);

$pageUrl = $this->langLink($table);
$toplam  = $this->dbLangSelect($table, "aktif = 1", "resim");
list($gecerli, $sayfaLimit, $toplamSayfa, $sayfa) = $this->sayfalama($toplam,15);
$veri  = $this->dbLangSelect($table, "aktif = 1", "resim", "LIMIT $gecerli, $sayfaLimit");
?>


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


        <section class="content-inner mb-5">
			<div class="container">
                <div class="row  lightgallery">
                <?
                    if (is_array($veri)){
                        foreach ($veri as $item){
                            $resimAl = $this->dbResimAl($item["resim"], $table, $this->getimageinfo($table, "400,300"), false);

                            if ($resimAl){
                                $resim = $resimAl;
                            }else {
                                $resim = $item["videoresim"];
                            }
                ?>


                            <div class="col-lg-4 col-md-6  mb-5">

                                        <div class="member-picture dz-media video-box">

                                            <img src="<?=$resimAl?>" alt="<?=$this->temizle($item["baslik"])?>">

                                            <div class="social-icons video-btn">
                                                <a href="<?=$item['adres']?>" class="popup-youtube play-btn6">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>

                                        </div>
                            
                                

                                <? if($item["baslik"] != '')  { ?>
                                <div class="content-box2 video">
                                    <div class="dz-bottom">
                                        <h3 class="name"><?=$this->temizle($item["baslik"])?></h3>
                                    </div>
                                    <a href="<?=$item["adres"]?>" data-src="<?=$item["adres"]?>" class="m-auto popup-image stretched-link"  data-fancybox="video" title="<?=$item["baslik"]?>" data-caption="<?=$item["baslik"]?>"></a>
                                </div>
                                <? } ?>

                            </div>

                            

                            



                <?
                        }
                    }else {
                        echo "<div class='col-md-12'><div class='alert alert-warning text-center'><h6>".$this->lang->genel("yapim")."</h6></div> </div>";
                    }
                ?>




                        <div class="col-md-12">
                            <?php
                            $this->sayfalamaButon(array(
                                "toplamSayfa" => $toplamSayfa,
                                "sayfa" => $sayfa,
                                "pageUrl" => $pageUrl,
                            ));
                            ?>
                        </div>



                </div>
            </div>
        </section>