<?php
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $param Array
 *
 */

$data  =  $param["data"];
$lang  =  $param["lang"];
$sql   =  $param["sql"];
$page  =  $param["page"];
$table = $param["table"];
$id    =  $param["id"];
$mid = ($lang != "tr") ? "master_" : "";
$alt = $param["alt"];
$baslik = $param["baslik"];
$katurl = $param["katurl"];
$column = $param["column"];
?>

<aside class="side-bar sticky-top right">
    <!-- Services List Widget -->

    <div class="widget style-1 widget_categories">
                                  
        <? if (!empty($baslik)){?>

            <div class="widget-title">
                <h4 class="title"><?=$baslik?></h4>
            </div>
        
        <? } ?>

        <ul>
            <?
            if (is_array($sql)){
                foreach ($sql as $item) {
                    $url = $this->BaseURL($this->lang->link($page)."/".$item["url"], $lang, 1);
                    if (@$item["link"] != "") $url = $item["link"];
                    ?>
                    <li class="cat-item <?=($item[$mid."id"] == $id) ? "active" : ""?>" ><a href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></li>
            <?
                }
            }
            ?>
        </ul>
    </div>

</aside>










