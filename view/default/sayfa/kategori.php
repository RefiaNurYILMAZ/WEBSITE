
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
$sayfa = "kategori";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim");
$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$kategoriler = $this->dbLangSelect($table, "aktif = 1 and baslik <> ''");
$urunler = $this->dbLangSelect("urun", "aktif = 1 and baslik <> '' and kid = ".$id);

if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

?>

<div class="cat-overlay"></div>
<?
echo $this->_include('bolum/sayfa',[
    "baslik" => $baslik,
    "contentClass"=>"category pt-0 pb-80",
    "page" => $sayfa,
    "contentImage"=>"img/bg/pattern_2.png",
    "middle_line"=>true,
    //'breadcrumbs' => array(array("title"=>$this->lang->header($sayfa), "href"=>$this->baseURL($this->lang->link("kurumsal"), $lang, 1)), array("title"=>$baslik)),
    'type' => "open",
    'container'=>false,
    'row'=>false
], $this->theme);
?>

<div class="container">


    <div class="row">

        <div class="col-12">
            <div class="cat-filter">
                <a href="#">MENÜ KATEGORİLERİ <span class="fa fa-angle-down"></span> <i class="icon icon-arrow-down"></i> </a>
                <ul class="cat-menus">
                    <? if (is_array($kategoriler)):?>
                    <?
                        foreach ($kategoriler as $item):
                            $url = $this->getURL($item,"kategori");
                    ?>
                        <li class="<?=(($id == $item["id"]) ? "active" : "")?>"><a href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></li>
                        <? endforeach;?>
                    <? endif; ?>
                </ul>
            </div>

            <div class="d-flex justify-content-center mb-30 ">
                <div class="line-icon d-flex xl flex-grow-1 align-items-center"><i class="fas fa-star-of-life"></i> </div>
            </div>

        </div>


        <? if (is_array($urunler)):?>
            <?
            foreach ($urunler as $item):
                $resim = $this->dbResimAl($item["resim"], "urun", $this->getimageinfo("urun", "", "big"), true);
                $t_resim = $this->dbResimAl($item["resim"], "urun", $this->getimageinfo("urun", "", "thumb"), true);
                $url = $this->getURL($item,"urun");
                $resimler = $this->sorgu("SELECT * FROM dosyalar WHERE tur = 'resim' and type = 'urun' and aktif = 1 and sil <> 1 and data_id = ".$item["id"]." ORDER BY sira ASC");
            ?>
                <div class="col-lg-4">
                    <div class="product-item mb-40">
                        <div class="images">
                            <img src="<?=$t_resim?>" alt="<?=$this->temizle($item["baslik"])?>">
                        </div>
                        <h1 class="title mb-0"><?=$this->temizle($item["baslik"])?></h1>
                        <a href="<?=$url?>" data-caption="<h4><?=$this->temizle($item["baslik"])?></h4><?=$this->detay($item)?>" title="<?=$this->temizle($item["baslik"])?>" data-src="<?=$resim?>" class="stretched-link quick_view" data-fancybox="quick-view-<?=$item["id"]?>" data-qw-form="qw-form-<?=$item["id"]?>" ></a>
                        <? if (is_array($resimler)):?>
                        <span class="hidden">
                            <?
                                foreach ($resimler as $res):
                                    $r = $this->dbResimAl($res["dosya"], "urun", $this->getimageinfo("urun","", "ek"), true);
                            ?>
                            <a class="quick_view" data-fancybox="quick-view-<?=$item["id"]?>" href="<?=$r?>"></a>
                            <? endforeach; ?>
                        </span>
                        <? endif; ?>
                    </div>
                    <div id="qw-form-<?=$item["id"]?>" class="hidden">
                        <h3 class="section-title font-40 "><?=$this->temizle($item["baslik"])?></h3>
                        <?=$this->detay($item)?>
                    </div>
                </div>
            <? endforeach;?>
        <? else: ?>
            <div class="alert alert-warning"><h5 class="my-0">Bu kategoride menü bulunamadı</h5></div>
        <? endif;?>


    </div>
</div>




<?
echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>



