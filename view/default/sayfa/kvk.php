
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
$sayfa = "kvk";
$baslik = "KİŞİSEL HAKLARIN KORUNMASI";
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);

$sayfa_kategori   = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 4");


$veri = $this->dbLangSelectRow($table,array("kid"=>"4", "master_id"=>"4"), "resim");
$detay = $this->temizle($veri["detay"]);
//$getID = $this->getID($veri);
//$baslik = $this->temizle($veri["baslik"]);
//$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
//$boyut = $this->getimageinfo($table, "", "big");
//$ek_boyut = $this->getimageinfo($table, "", "ek");
//$resim = $this->dbResimAl($veri["resim"],"sayfa", $boyut);
//$sidebar = $this->dbLangSelect("sayfa", "aktif = 1 and baslik <> '' and kid = 1");


?>



<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs img1">
    <div class="container">
        <div class="breadcrumbs-inner">
            <h1 class="page-title">
                KİŞİSEL HAKLARIN KORUNMASI
                <span class="watermark">KİŞİSEL HAKLARIN KORUNMASI</span>
            </h1>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->



<div class="rs-inner-blog pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container custom">
        <div class="row">
            
            <div class="col-lg-12 pr-35 md-pr-15 md-mt-50">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details">            
                            <div class="blog-full">
                                
                                    <?=$detay?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>