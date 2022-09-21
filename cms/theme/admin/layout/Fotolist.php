<?
/***
 *
 * @var $param array
 */
?>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 style="margin-bottom: 0px;"><strong><?=((isset($param["list_title"])) ? $param["list_title"] : "Ekli Resimler")?></strong></h4>
            </div>

            <div class="box-content">
                <table class="table table-striped table-bordered table-hover sorted_table sorted_addons" id="sortable" <?=((isset($param['page'])) ? 'data-id="'.$param['page'].'"':null)?>>
                    <thead>
                    <tr>
                        <th class="resimBlok" width="2%" align="center"> Sırala</th>
                        <!--     <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" data-column-index="0" aria-sort="ascending" aria-label=" Rendering engine : activate to sort column descending" style="width: 277px;"> Rendering engine </th> -->
                        <?php
                        if(isset($param['baslik']) and is_array($param['baslik']))
                            foreach($param['baslik'] as $baslik):
                                echo'
                                         <th style="'.((isset($baslik['width']) ? 'width:'.$baslik['width'].';':'')).'"> '.$baslik['title'].' </th>
 ';                                   endforeach;

                        ?>
                        <th style="width: 15%">Araçlar</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?

                    if(isset($param['p']) and is_array($param['p'])):
                        if(isset($param['pdata']) and is_array($param['pdata'])):
                            foreach($param['pdata'] as $pdata):

                                echo'   <tr data-sil="'.$pdata[$this->silColumn].'"'.((isset($pdata['id'])) ? 'data-id="'.$pdata['id'].'"':null).' class="'.(($pdata[$this->silColumn]) == 1 ? "bg-pale-danger" : "").(($pdata[$this->silColumn]) != 1 ? "durum_".$pdata[$this->aktifColumn] : "").'">';
                                if (isset($param["pfolder"])){

                                    echo "<td align='center' valign='middle' style='padding:0px;'><i class='ti-split-v move'></i> </td>";

                                    foreach($param['p'] as $p){
                                        $resim  = $this->resimGet($pdata[$p["dataTitle"]]);
                                        if(is_array($p)){
                                            echo'<td class="'.((isset($p['class'])) ? $p['class'] : '').'" tabindex="'.((isset($p['tabindex'])) ? $p['tabindex'] : '').'">';
                                            if ($p["dataTitle"] == "dosya"){

                                                if (file_exists($param["pfolder"].$resim)){
                                                    $baseURL = $this->baseURL();
                                                    $siteURL = (($_SERVER["SERVER_PORT"] == 80) ? "http://" : "https://").$_SERVER["SERVER_NAME"]."/";
                                                    if ($baseURL != $siteURL){
                                                        $resAl = $this->resimal(0,40,$resim,"../".$this->settings->config('folder').$param["pfolder"]."/");
                                                    }else {
                                                        $resAl = @$this->BaseURL($this->resimal(0,40,$resim,$param["pfolder"]));
                                                    }

                                                    //$resAl = $this->BaseURL($this->resimal(0,50,$resim,"../".$this->settings->config('folder').$param["pfolder"]."/"));
                                                    ?>
                                                    <a href="<?=$param["pfolder"].$resim?>" class="popImage" rel="example_group">
                                                        <img class="img-rounded img-thumbnail" src="<?=$resAl?>"></a>
                                                    <?
                                                }

                                            }
                                            else {
                                                echo ((isset($p['dataTitle']) and $pdata[$p['dataTitle']]) ? $pdata[$p['dataTitle']] : $pdata['dosya']);
                                            }
                                            echo "</td>";
                                        }
                                    }
                                }
                                else {
                                    foreach($param['p'] as $p) if(is_array($p))echo'<td class="'.((isset($p['class'])) ? $p['class'] : '').'" tabindex="'.((isset($p['tabindex'])) ? $p['tabindex'] : '').'">
                                        '.((isset($p['dataTitle']) and $pdata[$p['dataTitle']]) ? $pdata[$p['dataTitle']] : $pdata['dosya']).'</td>';
                                    else echo'<td> '.$p.' </td>';

                                }


                                if(isset($param['buton']) and is_array($param['buton'])):
                                    foreach($param['buton'] as $but):

                                        if(isset($but['type']))
                                            switch($but['type']):
                                                case 'radio':
                                                    echo '<td style="width: 5%" align="center">';

                                                    if ($pdata[$this->silColumn] != 1) {
                                                        echo '<button type="button" class="btn btn-lg btn-toggle ' . ((isset($pdata[$but['dataname']]) and $pdata[$but['dataname']] == 1) ? 'active' : '') . '" onclick="$.panel.durum(this,\'' . ((isset($pdata['id']) ? $pdata['id'] : 0)) . '\',\'' . ((isset($but['url'])) ? $but['url'] : null) . '\')" data-toggle="button" aria-pressed="true"><span class="handle"></span></button>';
                                                    }
                                                    else {
                                                        echo '<span class="label label-danger">Silinmiş</span>';
                                                    }

                                                    echo "</td>";
                                                    break;
                                                case 'checkbox':
                                                    echo  '<td>check</td>';
                                                    break;
                                                case 'button':
                                                    echo  '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).'&folder='.((isset($but['folder']) ? base64_encode($but['folder']) :'')).'&modul='.((isset($but['modul']) ? $but['modul'] :'')).'&gelenid='.((isset($pdata['id']))? $pdata['id']:null).'" class="dosya fancybox.iframe '.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                    ;
                                                    break;
                                                case 'button2':
                                                    echo   '<td><a href="'.((isset($but['url']) ? $but['url'] :'')).$pdata['id'].'" class="'.((isset($but['class']) ? $but['class'] :'')).'" >'.((isset($but['title']) ? $but['title'] :'')).'</a> </td>';
                                                    break;
                                            endswitch;
                                    endforeach;



                                endif;

                                echo'   <td>';




                                foreach($param['tools'] as $tool):
                                    echo' <a data-toggle="tooltip" data-type="'.$param["type"].'" data-id="'.$pdata["id"].'" data-placement="top" title="'.((isset($tool['title'])) ? $tool['title']: '').'" href="'.((isset($tool['url'])) ? $tool['url'].((isset($tool["disable_id"])) ? "" : $pdata['id']).((isset($tool["type"]) && !empty($tool["type"])) ? "&type=".$tool["type"] : "") : 'javascript:;').'" class="btn btn-sm '.((isset($tool["disable_delete"])) ? ($pdata[$this->silColumn]) ? "disabled " : " " : " ").((isset($tool['color'])) ? $tool['color']: '').'">
                        <i class="'.((isset($tool['icon'])) ? $tool['icon']: '').'"></i></a>';

                                endforeach;



                                echo'</td> </tr>';
                            endforeach;


                        else:
                            echo "<tr class='bg-pale-yellow'><td style='border:none;' colspan='100%'>Kayıtlı Veri Bulunamadı. Sağ taraftan dosya yükleyebilirsiniz.</td></tr>";

                        endif;

                    endif;
                    ?>
                    </tbody>  </table>
            </div>
        </div>

    </div>


    <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <button type="button"
                        class="btn <?=((isset($param['yukle']['class']) ? $param['yukle']['class'] :''))?> "
                        id="pickfiles"
                        data-id="<?=((isset($param['id'])) ? $param['id']:0)?>"
                        data-url="<?=((isset($param['yukle']['folder']) ? base64_encode($param['yukle']['folder']) :''))?>"
                        data-type="<?=((isset($param['yukle']['modul']) ? $param['yukle']['modul'] :''))?>"
                        data-filetype="<?=((isset($param['yukle']['file_type']) ? $param['yukle']['file_type'] :''))?>"
                        data-name="<?=((isset($param['yukle']['name']) ? $param['yukle']['name'] :''))?>"
                        data-resimtur="<?=((isset($param['yukle']['resim_tur']) ? $param['yukle']['resim_tur'] :''))?>"
                ><i class="fa fa-image"></i> <?=((isset($param['yukle']['title']) ? $param['yukle']['title'] :''))?></button>
            </div>
            <div class="box-body table-upload-area">


            <div style="max-height: 320px; overflow: auto">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-pale-gray">
                            <th style="font-weight: 700">Dosya Adı</th>
                            <th style="font-weight: 700">Boyut</th>
                            <th style="font-weight: 700">Durum</th>
                        </tr>
                    </thead>
                    <tbody id="upload_area">


                    </tbody>

                </table>
            </div>
                <div id="dosyayukle">

                    <div id="yukleme"></div>

                    <a id="uploadfiles" href="javascript:;" class="hidden">[ Yükle ]</a>

                </div>

                <div id="filelist"></div>
                <div id="console" class="alert-error" style="padding:10px; display:none"></div>


            </div>
        </div>
    </div>
</div>

