<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

if (stristr($katurl, strtolower("belge")) || stristr($katurl, strtolower("certifi")) || stristr($katurl, strtolower("sertifika"))  || stristr($katurl, strtolower("document"))) {
    echo "<div class='row  team-members ' style='margin-bottom: -30px'>";
    $kosul = "";
    $belge_kat = Request::GETURL("cat", "");
    if (!empty($belge_kat)) {
        $kosul .= " and kid = " . $belge_kat;
    }
    $belgeler = $this->dbLangSelect("belge", "aktif = 1 $kosul", "resim");
    if (is_array($belgeler)) {

        $boyutlar = $this->getmodulinfo("belge");
        foreach ($belgeler as $veri) {
            $g_resim = $this->dbResimAl($veri["resim"], "belge", $boyutlar["thumb"]);
            $b_resim = $this->dbResimAl($veri["resim"], "belge", $boyutlar["big"]);
        ?>
                <div class="col-lg-4 col-md-6">

                        <div class="team-member position-relative">
                            <div class="member-picture-wrap">
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


<?
        }
    }

    echo "</div>";
}
?>
