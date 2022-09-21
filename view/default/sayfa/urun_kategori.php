
<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "kategori";
$sayfa = "urun_kategori";
$baslik = $this->lang->header("urunler");
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);
$urunler = $this->dbLangSelect($table, "aktif = 1 and baslik <> ''");


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





        

        <!-- ÜRÜN -->


        <div class="rs-project style6 pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container">
                <div class="row">


            <? if (is_array($urunler)):?>
            <?
            foreach ($urunler as $item):
                $resim = $this->dbResimAl($item["resim"], $table, "358x320", true);
                $url = $this->getURL($item,"urun");
            ?>



                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="project-item">
                            <div class="project-img">
                                <a href="<?=$url?>">
                                    <img src="<?=$resim?>" style="height: 320px;" alt="images">
                                    <span class="p-icon"><i class="custom-icon"></i></span>
                                </a>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></h3>
                            </div>
                        </div>
                    </div>

                                    
            <? endforeach;?>
            <? else: ?>
                <div class="col-12"><div class="alert alert-warning"><h5 class="my-0"><?=$this->lang->genel("no_urun")?></h5></div></div>
            <? endif;?>



                </div>
            </div>
        </div>

        <!-- ÜRÜN -->

