<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "sayfa";
$sayfa = "kurumsal";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> '' and kid = 1");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],"sayfa", $boyut);
$sidebar = $this->dbLangSelect("sayfa", "aktif = 1 and baslik <> '' and kid = 1");


$rakamlar = $this->dbLangSelect("rakam", "aktif = 1 and baslik <> ''", "resim", "LIMIT 4");

if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

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





            <!-- Icerik -->

            <section class="content-inner">
                <div class="container">
                    <div class="row about-style12">
                        <div class="col-lg-5 m-b30 align-self-center">
                            <div class="about-content">
                                <div class="section-head style-1">
                                    <h5 class="sub-title text-primary"><?=$this->lang->genel('bizkimiz')?>  </h5>
                                </div>
                              
                                    <?=$this->detay($veri)?>
                               
                            </div>
                        </div>
                        <div class="col-lg-7 m-b30">

                            <? if ($resim){?>
                                <div class="dz-media">	

                                
                                        <img src="<?=$resim?>" alt="">
                                    


                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </section>
            

            <!-- #Icerik -->
    



            

       	<!-- Rakamlar -->

        <?php if ($rakamlar): ?>    



            <section class="content-inner bg-gray">
                <div class="container">
                    <div class="row">


                    <?
                    foreach ($rakamlar as $item) {
                    ?>

                        <div class="col-lg-3 m-b30 aos-item aos-init aos-animate" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                            <div class="check-box box-hover active">
                                <h4 class="title"><?=$item['baslik']?></h4>
                            </div>
                        </div>

                    <? } ?>


                    </div>
                </div>
            </section>



        <?php endif; ?>
        <!-- #Rakamlar -->






        
        </div>

