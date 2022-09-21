<?
if ($type == "open"){
$rnd = rand(1,4);
?>
<main>

    <?
    if (isset($resim) && !empty($resim)){
        if (strstr($resim, "http") !== false){
            $file = $resim;
        }else {
            $file = $this->themeURL.$resim;
        }
    }else {
        $file = $this->themeURL."img/background/subheader1.jpg";
    }
    ?>

    <section class="breadcrumb-section bg-img-c jarallax" style="background-image: url(<?=$file?>);">
        <div class="container">
            <div class="breadcrumb-text">
                <h1 class="page-title mb-0"><?=$baslik?></h1>
            </div>
        </div>
        <div class="breadcrumb-shapes">
            <div class="one"></div>
            <div class="two"></div>
        </div>
    </section>




    <section id="<?=(isset($id) ? $id : null)?>" class="page-section section-full <?=(isset($page) && $page != "") ? $page : ""?> <?=(isset($contentClass) && $contentClass != "") ? $contentClass : ""?>" style="
    <?=((isset($contentImage)) ? "background-image:url('".$this->themeURL."/".$contentImage."')" : "")?>
            ">
        <div class="<?=(!isset($container)) ? "container" : "" ?>">
            <div class="<?=(!isset($row)) ? "row" : "" ?>">

                <? } ?>

                <?
                if ($type == "close"){?>
            </div>
        </div>
    </section>

</main>
<? } ?>






     

