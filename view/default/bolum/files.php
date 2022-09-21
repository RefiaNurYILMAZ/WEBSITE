<?
/* @var $this FrontClass object */
/* @var $param array */

$type      =  $param["type"];
$data_id   =  $param["data_id"];


$query = "SELECT *, baslik as baslik_tr FROM dosyalar WHERE type='$type' and data_id = {$data_id} and tur = 'dosya' and sil <> 1 ORDER BY sira ASC";
$data = $this->sorgu($query);
$type_data = $this->dbLangSelectRow($type,array("id"=>$data_id, "master_id"=>$data_id));
?>

<? if(is_array($data) and count($data) > 0): ?>

    <div class="sidebar-inner mt-50">
        <div class="custom-sidebar axil-single-widget widget-style-2 widget widget_post shadow-sm  p-0">
            <div class="widget__title__box px-4 py-4">
                <h5 class="text-primary mb-0">Ekli Dökümanlar</h5>
            </div>
            <hr style="border-bottom:1px solid #efefef;">

                <div class="download-files px-4 pb-2">
                    <?
                    foreach ($data as $item):
                        $par = explode(".", $item["dosya"]);
                        $uzanti = $par[count($par) - 1];
                        $filesize = filesize($_SERVER['DOCUMENT_ROOT']."upload/".$type."/".$item["dosya"]);
                        $title = (!empty($item["baslik_".$lang])) ? $this->temizle($item["baslik_".$lang]) : $this->temizle($type_data["baslik"]);
                    ?>

                        <div class="download-item mb-15 position-relative">
                            <a href="<?=$this->baseURL("download/index.php?document=".$item["dosya"]."&dir=".$type."&title=".$title)?>">
                                <div class="media align-items-center">
                                    <div class="media-left">
                                        <div class="file-icon">
                                            <img src="<?=$this->themeURL?>images/icons/files/<?=$uzanti?>.png" class="icon" alt="<?=$title?>">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mb-0"><?=$title?></h5>
                                        <div class="media-last">
                                            [<?=$this->formatSizeUnits($filesize)?>]
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>




                    <? endforeach; ?>

                </div>
        </div>
    </div>

<? endif; ?>