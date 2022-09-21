<?
/* @var $this FrontClass|Loader object */

    $table = "galeri";
    $sayfa = "foto-galeri";

    $this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1");
    $veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
    $baslik = $this->temizle($veri["baslik"]);
    $this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
    $sidebar = $this->dbLangSelect($table, "aktif = 1");

?>

<style>
    .widget_archive ul li, .wp-block-categories-list li, .wp-block-archives-list li, .wp-block-latest-posts li, .widget_categories ul li {
        text-align: right;
        display: table;
    }
</style>


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






        <div class="col-lg-4">
     
        </div>



        <section class="content-inner">
			<div class="container">



                <div class="row">




                    <div class="col-lg-4">
                        <?
                        if (is_array($sidebar)) {
                            $this->sidebar(array(
                                "sql" => $sidebar,
                                'table' => $table,
                                "id" => $id,
                                "page" => "foto-galeri",
                                "lang" => $lang,
                                'baslik'=>$this->lang->header("foto-galeri")
                            ));
                        }
                        ?>
                    </div>


                    <div class="col-lg-8">
                        <div class=" lightgallery blog-content  order-1 order-lg-2 <?=$page?> add-ul-style ">    <!-- col-lg-8 row -->

                        <? if ($veri["detay"] != ""):?>
                            <div class="detail-text mb-5">
                                <?=$this->detay($veri)?>
                            </div>
                        <? endif;?>


                        <?
                        if (is_array($sidebar)) {
                            $this->dosyalar(array(
                                "type" => "galeri",
                                "tur" => "galeri",
                                "boyutlar" => "400,450",
                                'data_id' => $id,
                                'grid_size' => "col-md-4 col-sm-6",
                                'pagination' => true,
                                "pageUrl" => $this->baseURL($sayfa."/" . $veri["url"], $lang, 1),
                                "kayit" => 21,
                                "hata" => $this->lang->genel("no_goruntu")
                            ));
                        }else {
                            echo "<h5>".$this->lang->genel("yapim")."</h5>";
                        }
                        ?>

                        </div>
                    </div>


                    
                </div>





            </div>
        </section>






<?
    echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>