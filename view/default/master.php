<?php
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $content string
 */
?>
<? $this->disable_cache = false?>
<!-- HTML, HEAD, META -->
<?=$this->getHeader();?>


<!-- GOOGLE ANALYTICS -->
<?=$this->getAnalytics();?>


<meta name="Copyright" content="Copyright 2020. <?=$this->ayarlar("firma_".$lang)?>. Tüm Hakları Saklıdır.">


<!-- Google Fonts -->
<link rel="preconnect" href="https@fonts.googleapis.com/default.htm">
<link rel="preconnect" href="https@fonts.gstatic.com/default.htm" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	

<link rel="shortcut icon" href="<?=$assetURL?>img/favicon.png">
<script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "<?=$this->baseURL()?>",
            "logo": "<?=$assetURL?>img/logo.png"
        }
    </script>
    


<script>
    let requiredMessage = "<?=$this->lang->form("doldur")?>";
    let successMessage = "<?=$this->lang->form("basarili")?>";
    let warningMessage = "<?=$this->lang->form("uyari")?>";
    let errorMessage = "<?=$this->lang->form("hata")?>";
    let infoMessage = "<?=$this->lang->form("bilgi")?>";
    let pageLang = "<?=$lang?>";
    let close_text = "<?=$this->lang->genel("close")?>";
</script>



<?php
    $this->inc_file("css", array(


  
        "vendor/aos/aos.css",

        "vendor/magnific-popup/magnific-popup.min.css",
        "vendor/rangeslider/rangeslider.css",


        "vendor/lightgallery/css/lightgallery.min.css",

        "vendor/magnific-popup/magnific-popup.min.css",
        "vendor/swiper/swiper-bundle.min.css",
        "vendor/animate/animate.css",
        "css/style.css",
        "vendor/rangeslider/rangeslider.css",
        "css/skin/skin-1.css",
        "css/custom.css",

    ));


    $this->inc_file("script", array(
        "js/jquery.min.js",
    ));

?>


<style>
    .fancybox-slide--html .fancybox-close-small {
        padding: 10px;
        right: 0;
        top: 0;
        background: #e30613;
        color: #fff;
        border-radius: 100%;
        opacity: 1;
        position: absolute;
    }
</style>
</head>



<body  id="bg" class="default-home lang_<?=$lang?> <?=($page == "index") ? "index" : "other"?>">
<header class="site-header mo-left header style-3">




        <?=$content?>






<?php
$this->inc_file("script", array(

        "vendor/bootstrap/js/bootstrap.bundle.min.js",
         "vendor/rangeslider/rangeslider.js",
         "vendor/magnific-popup/magnific-popup.js",
        "vendor/counter/waypoints-min.js",
        "vendor/counter/counterup.min.js",
        "vendor/swiper/swiper-bundle.min.js",
        "vendor/aos/aos.js",
         ["vendor/particles/particles.js", "index"],
         ["vendor/particles/particles.app.js", "index"],
    
    
        "vendor/masonry/isotope.pkgd.min.js",
        "vendor/imagesloaded/imagesloaded.js",
        "vendor/masonry/masonry-4.2.2.js",



        "vendor/bootstrap/js/bootstrap.bundle.min.js",
        "vendor/magnific-popup/magnific-popup.js",
        "vendor/lightgallery/js/lightgallery-all.min.js",
        "vendor/swiper/swiper-bundle.min.js",

        "vendor/rangeslider/rangeslider.js",
        "vendor/lightgallery/js/lightgallery-all.min.js",
        "vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.js",
         "js/dz.carousel.js",
    
//"js/dz.ajax.js",
"js/form.js",

        "js/custom.js",




));
?>


<script>
    jQuery(document).ready(function($){

        if ($(".captcha_image").length){
            $(".captcha_image").on("click", function () {
                $(this).attr("src", BaseURL+"ajax/getcaptchaimage.html?rnd="+Math.random());
            });
        }

        if ($("form#request_qoute_form").length){
            $("form#request_qoute_form").ajaxForm({
                submitClass:".btn-primary",
                callback:function(obj,data){
                    if (data != 3){
                        $('.captcha_image').trigger("click");
                    }
                }
            });
        }

        if ($("form#basvuruForm").length) {
            $("#basvuruForm").ajaxForm({
                submitClass: "#formGonder",
                callback: function (obj, data) {
                    if (data != 3) {
                        $('.captcha_image').trigger("click");
                    }
                }
            });
        }


        // $('.search-link').on('click', function(e){
        //     e.preventDefault();
        //     $('.search-form').trigger('submit');
        // });

        /* teklif */ 

        if ($("form.teklifform").length){
            $(".teklifform").ajaxForm({
                submitClass:".btn-primary",
                callback:function(obj,data){
                    if (data != 3){
                        $('.captcha_image').trigger("click");
                    }
                }
            });
        }

        /* #teklif */

       



        <?php
        $popup = $this->tekSorgu("SELECT * FROM popup WHERE aktif = 1 and tarih >= NOW() and sil <> 1 ORDER BY sira ASC");
        if (is_array($popup)):
        if (!isset($_SESSION["modal"]) && $_SESSION["modal"] != $popup["id"]):
        ?>
        let fancyTpl = "";
        <? if ($popup["link"] != ""):?> fancyTpl+="<a href='<?=$popup["link"]?>'>"; <? endif;?>
        fancyTpl+="<img src='<?=$this->dbResimAl($popup["resim"], "popup", "900x600")?>' alt='<?=$this->temizle($popup["baslik"])?>'>";
        fancyTpl+="<h6 class='mt-20 text-primary mb-6 font-20'><?=$popup["baslik"]?></h6>";
        fancyTpl+="<p><?=$popup["ozet"]?></p>";
        <? if ($popup["link"] != ""):?> fancyTpl+="</a>"; <? endif;?>
        $.fancybox.open('<div class="message p-15 bg-white">'+fancyTpl+'</div>');
        <?php $_SESSION["modal"] = $popup["id"]; endif; endif; ?>

    });
</script>


</body>
</html>



<script>	
  /*$(document).ready(function(){*/

 /*   $('#marka').on('change', function() {
		var marka_val =  $(this).val();
        if(marka_val > 0){
            location.href = "<?//=$this->baseURL("urunler.html?marka_val=")?>"+city_val;
        }
	});
*/

/* });*/	
</script>