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
$sayfa = "search";
$q = $this->kucuk_yap($this->koru(Request::GETURL('q', null)));
if(empty($q)) header('Location:'.$this->baseURL('index'));

$veri = $this->dbLangSelect('urun', '(aktif = 1 and baslik <> "") and LOWER(baslik) LIKE "%'.$q.'%" ', 'resim');

?>



<div class="page-content bg-white">
		
        <!-- Banner  -->
        <div class="dz-bnr-inr dz-bnr-inr-sm overlay-black-middle text-center" style="background-image: url(<?=$assetURL?>img/bnr1.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1><?=$this->lang->iletisim("arama")?> </h1>
                </div>
            </div>
        </div>
        <!-- Banner End -->



        <!-- ÜRÜN -->

        <section class="content-inner">

            <div class="rs-project style6 pt-50 pb-50 md-pt-70 md-pb-70">
                <div class="container">
                    <?php if(is_array($veri) && count($veri) > 0): ?>
                        <div class="alert alert-success mb-5">
                            <p class="mb-0"><?=str_replace('%count%', '<b class="badge bg-green rounded-pill">'.count($veri).'</b>', $this->temizle($this->lang->genel('toplam_sonuc')))?></p>
                        </div>
                        <hr>
                    <?php endif; ?>

                    <div class="row">



                <?
                if(is_array($veri)):
                foreach ($veri as $item):
                    $resim = $this->dbResimAl($item["resim"],"urun" ,'400x400', true);
                    $url = $this->getURL($item,"urunkat");
                ?>

                        
                    <div class="col-lg-4 col-md-6 mb-30 mb-5">
                        <div class="content-box2 overlay-shine">
                            <div class="dz-info">
                                <h3 class="title"><?=$item['baslik']?></h3>
                            </div>
                            <div class="dz-media m-b30">
                                <img src="<?=$resim?>" alt="">
                            </div>
                            <div class="dz-bottom">
                                <a href="<?=$url?>" class="btn-link"><?=$this->lang->genel('fazla')?> <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>


                <? endforeach;  ?>

                <?php else: ?>
                    <div class="alert alert-warning" style="width: 50%;text-align: center;margin: auto;"> <?=$this->lang->genel('no_record')?>  <?=$this->lang->iletisim("arama")?> </div>
                <?php endif; ?>

                </div>
                </div>
              
            </div>
        </section>

   
</div>



        <!-- ÜRÜN -->



<script>
jQuery(window).on("load", function() {
    if (jQuery(".rs-project").length) {
        setTimeout(function() {
            jQuery(".gridFilter").find("button:first-child").trigger("click");
        }, 200);
    }

});
</script>
