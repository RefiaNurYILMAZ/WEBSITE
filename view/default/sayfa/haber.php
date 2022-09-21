<?
/* @var $this FrontClass|Loader object */

$table = "haber";
$sayfa = "haber";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1");
$veri = $this->dbLangSelectRow($table, array("id"=>$id, "lang_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$boyut = $this->getimageinfo($table);

$resim = $this->dbResimAl($veri["resim"], $sayfa, $boyut, false);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);

$kosul = ($lang == "tr") ? "id <> $getID" : "master_id <> ".$veri["master_id"];
$kosul.= " and aktif = 1";
$limit = 40;
$diger = $this->dbLangSelect($table, $kosul, "resim", "LIMIT $limit", "ORDER BY tarih DESC, sira ASC");
$toplam = count($diger);

?>

<? // var_dump($toplam); ?>



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




            <div class=" content-inner rs-inner-blog pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container custom">
                    <div class="row">


                        <div class="col-lg-4 col-md-12 order-last">



                            <div class="widget-area">
     
                                <div class="recent-posts mb-50 widget style-1 recent-posts-entry">

                                    <div class="widget-title">
                                        <h3 class="title"> <?=$this->lang->genel('sonhaber')?></h3>
                                    </div>

                                    <div class="widget-post-bx">

                                        <?
                                            if (is_array($diger)){
                                                foreach ($diger as $item) {
                                                    $haber_resim = $this->dbResimAl($item["resim"], "haber", $this->getimageinfo("haber", "", "thumb"), true);
                                                   // $url = $this->baseURL("haber/".$item["url"], $lang, 1);
                                                    $url = $this->getURL($item,"haber");
                                        ?>




                                                                        
                                        <div class="widget-post clearfix">
                                            <div class="dz-media"> 
                                                <img src="<?=$haber_resim?>" alt="">
                                            </div>
                                            <div class="dz-info">
                                                <div class="dz-meta">
                                                    <ul>
                                                        <li class="post-date"> <?=date("d.m.Y", strtotime($item["tarih"]))?> </li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></h6>
                                            </div>
                                        </div>




                                        <?
                                                }
                                            }
                                        ?>


                                    </div>

                                </div>

                            </div>


                        </div>


                        <div class="col-lg-8 pr-35 md-pr-15 md-mt-50">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dz-card style-1 blog-single">


                                        <div class="dz-media">
                                            <img src="<?=$resim?>" alt="<?=$baslik?>">
                                        </div>

                                        <div class="dz-info">
                                            <div class="dz-meta">
                                                <ul>
                                                    <li class="post-date"><i class="las la-calendar"></i> <?=$this->gun_ay_yil($veri["tarih"])?> </li>
                                                </ul>
                                            </div>

                                            <h2 class="dz-title"><?=$baslik?></h2>
								            
                                          
                                            <?=$this->detay($veri);?>
                                        
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> 
                </div>
            </div>


        </div>
