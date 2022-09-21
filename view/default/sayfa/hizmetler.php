<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "hizmetlerimiz";
$sayfa = "hizmetler";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> '' and kid = 1");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);


$baslik2 = "H力ZMETLER";

$this->sayfaBaslik = $baslik2." - ".$this->ayarlar("title_".$lang);

//$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);

$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],"hizmetlerimiz", $boyut);
$sidebar = $this->dbLangSelect("hizmetlerimiz", "aktif = 1 and baslik <> '' and kid = 1");


$detay_resim = $this->dbResimAl($veri["detay_resim"],"hizmetlerimiz", "1200x400");
$detay = $this->temizle($veri["detay"]);




$hizmetler  = $this->dbLangSelect("hizmetlerimiz","aktif = 1 and baslik <> ''");



if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>


<style> 
    a{
        color: #fff;
    }

    .rs-project.style1 .project-item .project-content .project-inner .category {
        font-size: 15px;
        line-height: 27px;
        font-weight: 400;
        display: block;
        margin-bottom: 30px;
    }
</style>

        
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs img1">
            <div class="container">
                <div class="breadcrumbs-inner">
                    <h1 class="page-title">
                        Hizmetler
                        <span class="watermark">Hizmetler</span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumbs End -->


        
        
        
        <div class="rs-project style1 pt-100 pb-100 md-pt-70 md-pb-70">
               <div class="container">
                   <div class="row">
            
                      <span  style="margin-bottom: 26px;" class="sub-text small"> HİZMETLER</span>

                   
                   <?                     
                    foreach ($hizmetler as $item) {
                        $resim_hizmet = $this->dbResimAl($item["detay_resim"], "hizmetlerimiz", "500x300", true);
                        $url = $this->getURL($item,"hizmet");  
                    ?>

                       <div class="col-lg-4 col-md-6 mb-3">
                            <a href="<?=$url?>">
                                <div class="project-item" style="border: 1px solid #f2f2f2;padding: 16px;">
                                        
                                <? if($resim_hizmet != '') {  ?>
                                    <div class="project-img">
                                        <img src="<?=$resim_hizmet?>" alt="images">
                                    </div>
                                    
                                    <div class="project-content"> 
                                        <div class="project-inner">
                                            <span class="category"><?=$item['baslik']?></span>
                                            <!-- <h3 class="title"><?//$item['baslik']?></h3> -->
                                            <span class="p-icon" ><i class="custom-icon"></i></span>
                                        </div>
                                    </div>
                                <? } ?>

                                </div>
                           </a>
                       </div>

                    <?  } ?>

                   </div>
               </div>
           </div>