<?

$toplamSayfa    =  (isset($param["toplamSayfa"])) ? $param["toplamSayfa"] : 0;
$pageUrl    =  (isset($param["pageUrl"])) ? $param["pageUrl"] : "";
$sayfa    =  (isset($param["sayfa"])) ? $param["sayfa"] : "";
$urlType    =  (isset($param["urlType"])) ? $param["urlType"] : "";
$lang    =  (isset($param["lang"])) ? $param["lang"] : "tr";
?>

<?
if ($toplamSayfa > 1){
    ?>






        <ul class="pagination justify-content-center mb-0 mt-30">


            <?
            if( $sayfa > 1 )
            {
                $onceki = $pageUrl."/".($sayfa - 1);
                if ($urlType != ""){
                    $onceki = $pageUrl."?page=".($sayfa - 1);
                }

                echo '<li class="page-item"><a class="theme_btn2 mr-2" href="'.$onceki.'"><i class="far fa-chevron-left"></i></a></li>';
            }
            ?>


            <?
            for( $i = $sayfa - 4; $i < $sayfa + 5; $i++ )
            {
                if( $i > 0 && $i <= $toplamSayfa )
                {
                    $url = $pageUrl."/".$i;

                    if ($urlType != ""){
                        $url = $pageUrl."?page=".$i;
                    }
                    ?>
                    <li class="page-item <?=($i == $sayfa) ? 'active' : ''?>"><a class="page-link"  href="<?=$url?>"><?=$i?></a></li>

                    <?
                }
            }
            ?>


            <?
            if( $sayfa != $toplamSayfa )
            {

                $sonraki = $pageUrl."/".($sayfa + 1);
                if ($urlType != ""){
                    $sonraki = $pageUrl."?page=".($sayfa + 1);
                }

                echo '<li class="page-item"><a class="theme_btn2"  href="'.$sonraki.'"><i class="far fa-chevron-right"></i></a></li>';

            }
            ?>

        </ul>




<? } ?>