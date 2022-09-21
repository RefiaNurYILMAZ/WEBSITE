<?
/* @var $this FrontClass object */
/* @var $param array */

list($genislik, $yukseklik) = explode(",", $param["boyutlar"]);
$type      =  $param["type"];
$data_id   =  $param["data_id"];
$katurl    =  (isset($param["katurl"])) ? $param["katurl"] : null;
$lang      =  $this->pageLang;

$klasor    =  (isset($param["klasor"])) ? $param["klasor"] : $param["type"];
$tur       =  (isset($param["tur"])) ? $param["tur"] : $param["type"];
$title     =  (isset($param["title"])) ? $param["title"] : "";
$grid_size =  (isset($param["grid_size"])) ? $param["grid_size"] : "col-lg-4";

$showSql   =  (isset($param["showSql"])) ? $param["showSql"] : "";

$pagination   =  (isset($param["pagination"])) ? $param["pagination"] : "";
$kayit        =  (isset($param["kayit"])) ? $param["kayit"] : "";
$pageUrl      =  (isset($param["pageUrl"])) ? $param["pageUrl"] : "";



$kosul     =  (isset($param["kosul"])) ? $param["kosul"] : '';
$hata      =  (isset($param["hata"])) ? $param["hata"] : '';
$limit     =  (isset($param["limit"])) ? "LIMIT ".$param["limit"] : '';


if (!stristr($katurl, strtolower("belge")) && !stristr($katurl, strtolower("certifi")) && !stristr($katurl, strtolower("sertifika"))  && !stristr($katurl, strtolower("document"))) {

$ek   =  ($kosul != "") ? "and $kosul" : '';
$query = "SELECT *, baslik as baslik_tr FROM dosyalar WHERE type='$type' and data_id = {$data_id} and tur = 'resim' and aktif= 1 and sil <> 1 $ek";

    if ($pagination){
        $toplam  = $this->sorgu($query);
        list($gecerli, $sayfaLimit, $toplamSayfa, $sayfa) = $this->sayfalama($toplam, $kayit);
        $resimSor  = $this->sorgu($query." ORDER BY sira ASC, id DESC LIMIT $gecerli, $sayfaLimit");
    }

    else {
        $resimSor = $this->sorgu($query." ORDER BY sira ASC, id DESC $limit");
    }





  if(is_array($resimSor)){
      $toplam = count($resimSor);
      if (!isset($param["row"])) {
          echo "<div class='row team-members' style='margin-bottom: -30px'>";
      }
        if ($title != ""){
            echo "<div class='col-lg-12'>";
            echo "<h4 class='ekGorsel'><span>".$title."</span></h4>";
            echo "</div>";
        }
        $i=0;

?>


<?
    $delay = 300;
    foreach ($resimSor as $veri):
    $resim  = $this->resimGet($veri['dosya']);
    if($resim and file_exists($this->settings->config('folder').$klasor."/".$resim)):
    $g_resim = $this->BaseURL($this->resimal($genislik,$yukseklik,$resim,$this->settings->config('folder').$klasor."/"));
    $b_resim = $this->BaseURL($this->resimal(0,1000,$resim,$this->settings->config('folder').$klasor."/"));
?>



<?
    if ($tur == "kurumsal"){
?>
        <div class="<?=$grid_size?>">
            <div class="team-member position-relative">
                <div class="member-picture-wrap mb-0">
                    <div class="member-picture">
                        <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>">
                        <div class="social-icons">
                            <a href="#">
                                <i class="fa fa-search-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <? if ($veri["baslik_$lang"] != ""):?>
                    <div class="member-desc">
                        <h3 class="name"><?=$this->temizle($veri["baslik_$lang"])?></h3>
                    </div>
                <? endif;?>
                <a class="stretched-link" href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" data-caption="<?=$this->temizle($veri["baslik_$lang"])?>"></a>
            </div>
        </div>
<? } ?>


<?
if ($tur == "haber"){
?>
    <div class="<?=$grid_size?>">
        <div class="team-member position-relative">
            <div class="member-picture-wrap mb-0">
                <div class="member-picture">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>">
                    <div class="social-icons">
                        <a href="#">
                            <i class="fa fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <? if ($veri["baslik_$lang"] != ""):?>
                <div class="member-desc">
                    <h3 class="name"><?=$this->temizle($veri["baslik_$lang"])?></h3>
                </div>
            <? endif;?>
            <a class="stretched-link" href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" data-caption="<?=$this->temizle($veri["baslik_$lang"])?>"></a>
        </div>
    </div>

<? } ?>




<?
if ($tur == "galeri"){
?>

                    <div class="<?=$grid_size?> m-b30">
						<div class="dz-box style-4">
							<div class="dz-media height-sm">
								<img src="<?=$g_resim?>" alt="">
							</div>
							<span data-exthumbimage="<?=$b_resim?>" data-src="<?=$b_resim?>" class="view-btn lightimg" title=""><i class="fas fa-plus"></i></span>
						</div>
					</div>

 
<? } ?>



<?
$i++;
$delay = $delay + 30;
endif;
endforeach;

if ($pagination){
    echo "<div class='col-md-12'>";
    $this->sayfalamaButon(array(
        "toplamSayfa" => $toplamSayfa,
        "sayfa" => $sayfa,
        "pageUrl" => $pageUrl,
    ));
    echo "</div>";
}
      if (!isset($param["row"])) {
          echo "</div>";
      }
}
else {
  if ($hata != ""){
    echo "<div class='col-sm-12'><h5>$hata</h5></div>";
  }
}

}
?> 