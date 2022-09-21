
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
$sayfa = "urunler";
$baslik = $this->lang->header("urunler");
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);

$marka= $this->sorgu("SELECT * FROM marka_kategori");
$kategori= $this->sorgu("SELECT * FROM kategori");

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;



$kategori_id = Request::GETURL("kategori_val", 0);
$marka_id = Request::GETURL("marka_val", 0);

$filter = (($kategori_id || $marka_id) ? true : false);

$kosul = "aktif = 1 and baslik <> '' ";
if($filter){
    if($kategori_id) $kosul.= " and kid = ".$kategori_id;
    if($marka_id) $kosul.= " and kid2 = ".$marka_id;
}
$urunler = $this->dbLangSelect($table, $kosul);

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
                <div class="row">


                <div class="col-lg-12">
                    <aside>
                        <div class="widget mb-40">
                            <form action="<?=$this->baseURL('urunler',$lang,1)?>" method="get">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="widget-title" style="margin-bottom: 20px;">
                                            <h4>Kategoriler</h4>
                                        </div>

                                        <div class="btn-group">

                                            <select id="kategori" name='kategori_val' class="form-select" aria-label="Default select example">
                                                <option selected value="0">Seçiniz ...</option>

                                                <?
                                                    foreach ($kategori as $item):
                                                ?>
                                            
                                                <option <?=($kategori_id == $item["id"]) ? "selected" : ""?> value="<?=$item['id']?>"><?=$item['baslik']?></option>
                                                
                                                <? endforeach;?>                           

                                            </select>

                                        </div>



                                        <div class="btn-group">

                                            <select id="marka" name='marka_val' class="form-select">
                                                <option selected value="0">Seçiniz ...</option>

                                                <?
                                                    foreach ($marka as $item):
                                                ?>

                                                <option <?=($marka_id == $item["id"]) ? "selected" : ""?> value="<?=$item['id']?>"><?=$item['baslik']?></option>
                                                
                                                <? endforeach;?>    

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-2">
                                        <div class="slider-btn" style="margin-top: 38px;">
                                            <button id="filtrele" type="submit" style="line-height: 0;" class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s">Filtrele</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>

                        </div>
                    </aside>
                </div>



        <? if (is_array($urunler)):?>
            <?
            foreach ($urunler as $item):
                $resim = $this->dbResimAl($item["resim"], $table, $this->getimageinfo($table, "", "big"), true);
                $url = $this->getURL($item,"urun");
            ?>



                    <div class="col-lg-4 col-md-6 mb-30">
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
        </div>






