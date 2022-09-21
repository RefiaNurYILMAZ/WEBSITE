<?
/* @var $this FrontClass|Loader object */



    $table = "haber";
    $sayfa = "haberler";

    $baslik = $this->lang->header("haberler");
    $this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);

$pageUrl = $this->BaseURL($this->lang->link("haberler"),$lang, 1);
$toplam  = $this->dbLangSelect($table, "aktif = 1", "resim");
list($gecerli, $sayfaLimit, $toplamSayfa, $sayfa) = $this->sayfalama($toplam, 15);
$veri  = $this->dbLangSelect($table, "aktif = 1", "resim", "LIMIT $gecerli, $sayfaLimit", "ORDER BY tarih DESC, sira ASC");
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






		<section class="content-inner">
			<div class="container">


				<div class="clearfix">
                    <ul id="masonry" class="row blog-masonry">


                            <?
                            if (is_array($veri)){
                                foreach ($veri as $item){
                                    $haber_resim = $this->dbResimAl($item["resim"], "haber","400x250", true);/*$this->getimageinfo("haber", "", "thumb") */
                                    $url = $this->baseURL($this->lang->link("haber")."/".$item["url"], $lang, 1);

                                    $gun_ay = $this->aylar(date("m", strtotime($item["tarih"])), 2)."<br><span>".date("d", strtotime($item["tarih"]))."</span>";
                                    $gun    = date("d", strtotime($item["tarih"]));
                                    $ay   = $this->aylar(date("m", strtotime($item["tarih"])), 2);
                            ?>



                                <li class="card-container grid-item col-xl-4 col-md-6">
                                        <div class="dz-card style-1 shadow m-b30">
                                            <div class="dz-media">
                                                <a href="<?=$url?>"><img src="<?=$haber_resim?>" alt="<?=$this->temizle($item["baslik"])?>"></a>
                                            </div>
                                            <div class="dz-info">
                                                <div class="dz-meta">
                                                    <ul>
                                                        <li class="post-date"><?=$item['tarih']?></li>
                                                    </ul>
                                                </div>
                                                <h4 class="dz-title"><a href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></h4>
                                            </div>
                                        </div>
                                    </li>




                            <?  } ?>

                    </ul>
				</div>


                <? } else {
                    echo "<div class='col-md-12'><div class='alert alert-warning' style='font-size: 110%; text-align: center'>".$this->lang->genel("yapim")."</div></div> ";
                } ?>


                <div class="clearfix"></div>


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
        </section>

</div>
        
