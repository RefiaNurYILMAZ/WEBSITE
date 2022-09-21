<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */
?>

<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "ikinciel_kategori";
$sayfa = "ikinciel";


$baslik = "İKİNCİ EL ÜRÜN";
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);
$urunler = $this->dbLangSelect($table, "aktif = 1 and baslik <> ''");

$urun_kategori   = $this->dbLangSelect("ikinciel","aktif = 1 and baslik <> '' and sil = 0");

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;
?>

<? // var_dump($urun_kategori);  ?>
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
                
                 <span class="sub-text small" style="margin-bottom: 35px;"> <?=$baslik?></span>


                <div class="row">


              

                <div style="order:2" class="col-lg-8">
                    <div class="row">


                            <? if (is_array($urun_kategori)):?>
                                            
                                <?
                                foreach ($urun_kategori as $item):

                                    $resim = $this->dbResimAl($item["resim"], "ikinciel","342x192", true);
                                    $url = $this->getURL($item,"ikincielkat");

                                    $alt = $this->dbLangSelect("ikinciel_kategori", "aktif = 1 and baslik <> '' and ustu= ".$item["id"]);

                                    if($alt == 0){
                                    $urun = $this->dbLangSelectRow('ikinciel', ['kid'=>$item['id']]);   
                                    }
                                        
                                ?>

                                        <div class="col-lg-6 col-md-6 mb-30">
                                            <a href="<?=$url?>">
                                                <div class="project-item">

                                                    <div class="project-img">

                                                        <span> <img src="<?=$resim?>" alt="<?=$this->temizle($item["baslik"])?>"></span>

                                                    </div>

                                                    <div class="project-content">
                                                        <div class="portfolio-inner">
                                                            <span class="title" style="color:white;font-size: 17px;"><?=$this->temizle($item["baslik"])?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>



                                    
                                <?  endforeach; ?>


                            <? endif;?>

                    </div>
                </div>




                <div style="order:1" class="col-lg-4">
                    <aside class="sidebar-area  pt-lg-0 pb-20">
                        <div class="widget widget_categories">

                            <ul class="services-list">
                                <? //var_dump($veri2['kid']); die;  ?>
                                <?=$this->multipleSubmenu_ikinciel(0, $this->lang->link("ikincielkat"), ((isset($katt)) ? $katt["url"] : 'null'));?>

                            </ul>
                        </div>
                    </aside>      
                </div>
            


                </div>
            </div>
        </div>






