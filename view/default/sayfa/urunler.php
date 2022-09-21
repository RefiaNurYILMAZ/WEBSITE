
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
$sayfa = "urunler";
$baslik = $this->lang->header("urunler");
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);
$urunler = $this->dbLangSelect($table, "aktif = 1 and baslik <> ''");


$urun_kategori   = $this->dbLangSelect("kategori","aktif = 1 and baslik <> '' and ustu = 0");


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

    

<div class="rs-project style3 pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        
         <span  style="margin-bottom: 26px;" class="sub-text small"> <?=$baslik?></span>
           
           
        <div class="row">

     
        

        <div style="order:2" class="col-lg-8">
            <div class="row">

                <? if (is_array($urun_kategori)):?>
                    <?
                    foreach ($urun_kategori as $item):
                        $resim = $this->dbResimAl($item["resim"], $table,"375x238", true);
                        $url = $this->getURL($item,"urunkat");
                    ?>

                            <div class="col-lg-6 col-md-6 mb-30">
                                <a href="<?=$url?>">
                                    <div class="project-item">

                                        <div class="project-img">

                                            <span> <img src="<?=$resim?>" alt="<?=$this->temizle($item["baslik"])?>"></span>

                                        </div>

                                        <div class="project-content">
                                            <div class="portfolio-inner">
                                                <!--   <span class="category"><a href="project-single.html">Investment</a></span>  -->
                                                <span class="title" style="color:white"><?=$this->temizle($item["baslik"])?></span>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        
                    <? endforeach;?>
                <? endif;?>

            </div>
        </div>


        <div style="order:1" class="col-lg-4">

            <aside class="sidebar-area  pt-lg-0 pb-10">
                <div class="widget widget_categories">
                    <ul class="services-list">

                        <?
                        foreach ($urun_kategori as $item):
                            $resim = $this->dbResimAl($item["resim"], $table,"375x238", true);
                            $url = $this->getURL($item,"urunkat");
                        ?>

                            <li><a class="<?= $item['id'] == $getID ? 'active' : ' '  ?>" href="<?=$url?>" class=""><?=$item['baslik']?></a></li>

                            <? endforeach;?>

                    </ul>
                </div>
            </aside>

        </div>





        </div>
    </div>
</div>






