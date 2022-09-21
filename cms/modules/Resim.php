<?php


namespace cms;


class Resim  extends Settings{


    public  $modulName = "Resim";
    private $table = "dosyalar";
    private $tablelang;



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();

        $modul = strtolower($this->modulName);
        $yetkiler = json_decode($this->getUserInfo("yetkiler"));
        $type = strtolower((isset($_GET["type"]) ? $_GET["type"] : null));



    }


    public function index($id)
    {
        return $this->ekle($id);
    }



    public function ekle($id=0)
    {
        $type = (isset($_GET["type"])) ? $_GET["type"] : null;
        $file_type = (isset($_GET["file_type"])) ? $_GET["file_type"] : null;

        $list_title = "Yüklenmiş Dosyalar";

        switch ($type):
            case 'belge':
                $this->SayfaBaslik = "Belgeler Listesi";
                $addTitle = "Belge Yükle";
                $subTitle = "Belge Yükle";
            break;

            default:
                $kat = $this->dbConn->tekSorgu("SELECT * FROM $type WHERE id = $id");
                $baslik = $this->permalink($this->temizle($kat["baslik"]));
                $addTitle = "Resim Ekle";
                $subTitle = "Resim Yükle";
                $this->SayfaBaslik = $this->kisalt($this->temizle($kat["baslik"]),40)." / ".$addTitle;
            break;

        endswitch;

        if (!empty($file_type)){
            switch ($file_type):
                case 'kat_plan':
                    $addTitle = "Kat Planı Listesi";
                    $subTitle = "Kat Planı Yükle";
                    $this->SayfaBaslik = $this->kisalt($this->temizle($kat["baslik"]),40)." / ".$addTitle;
                    break;
                case 'daire_plan':
                    $addTitle = "Daire Planı Listesi";
                    $subTitle = "Daire Planı Yükle";
                    $this->SayfaBaslik = $this->kisalt($this->temizle($kat["baslik"]),40)." / ".$addTitle;
                    break;
                endswitch;
        }



        $upload_folder = '../'.$this->settings->config('folder').$type."/";
        if (!empty($file_type)){
            $upload_folder = '../'.$this->settings->config('folder').$file_type."/";
        }


        $pagelist = new Pagelist($this->settings);

        return $pagelist->Fotolist(array(
            'title'=> $addTitle,
            'id'=>$id,
            'type'=>$type,
            'page'=>'dosyalar',
            "list_title"=>$list_title,
            "file_type"=>$file_type,
            'pfolder'=>$upload_folder,
            'p'=>array(
                array('class'=>'sort text-center sira_no','tabindex'=>0,'dataTitle'=>'sira'),
                array('dataTitle'=>'dosya', 'class'=>'sort'),
                array('dataTitle'=>'baslik', 'class'=>'sort')
            ),
            'tools' =>array(   array('type'=>$type, 'title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/duzenle/'),'color'=>'btn-primary'),
                array('type'=>$type, "disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon dosyaSil')
            ),
            'yukle'=> array("file_type"=>$file_type,'type'=>'button','title'=>$subTitle,'class'=>'btn-primary btn-block btn-lg','modul'=>$type,'folder'=>$upload_folder,'name'=>((isset($baslik)) ? $baslik:null)),

            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/dosyaDurum/')),
            ),
            'pdata' => $this->dosyaAl(array(
                "type"=>$type,
                "file_type"=>$file_type,
                "data_id"=>$id,
                "tur"=>"resim"
            )),

            'baslik'=>array(
                array('title'=>'Sıra No','width'=>'8%'),
                array('title'=>'Resim','width'=>'10%'),
                array('title'=>'Başlık','width'=>'50%'),
                array('title'=>'Aktif','width'=>'5%'),
            )

        ));

    }

    public function sil($id=null)
    {
        $rec2 = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id='$id'");
        $type = $rec2["type"];

        $kid = $rec2['data_id'];
        $date = date("Y-m-d H:i:s");

        if($id) $this->dbConn->update("dosyalar", array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/ekle/'.$kid."&type=".$type));
    }


    public function duzenle($id=null)
    {




        if(isset($id) and $id) $urun = $this->dbConn->tekSorgu('select *, baslik as baslik_tr from dosyalar WHERE id='.$id);
        $type = $urun["type"];
        $file_type  = $urun["file_type"];
        $text = '';
        $modul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$type'");




        $this->SayfaBaslik = ($type == "belge") ? "Belge Düzenle" : 'Resim Düzenle';


        if ($type == "sayfa"){
            $al = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id = $id");
            $dt_id = $al["data_id"];
            $sayfalar = $this->dbConn->tekSorgu("SELECT * FROM sayfa WHERE id = $dt_id");
            if (stristr($sayfalar["baslik"], "belge") || stristr($sayfalar["baslik"], "certifi") || stristr($sayfalar["baslik"], "sertifika")){
                $this->SayfaBaslik = "Belge Düzenle";
                $boyut = "750x1060";
            }else {
                $boyut = $this->modul_image_size($modul["id"], "ek");
            }
        }elseif ($type == "katalog"){
            $al = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id = $id");
            $dt_id = $al["data_id"];
            $boyut = $this->dbConn->tekSorgu("SELECT * FROM katalog WHERE id = $dt_id")["boyut"];
        }
        else {
            $boyut = $this->modul_image_size($modul["id"], "ek");
        }

        $folder = $type;

        if (!empty($file_type)){
            switch ($file_type):
                case 'kat_plan':
                    $boyut = "900x600";
                break;

                case 'daire_plan':
                    $boyut = "900x600";
                break;

            endswitch;

            $folder = $file_type;
        }



        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=>  $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')."&type=".$type),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(8);
        $text.=$form->openBox().$form->openBoxBody();
        $langCount = count($this->settings->lang());


        $dbname = $this->getDbName();
        foreach ($this->settings->lang('lang') as $dil=>$title):

            if ($dil != "tr"){
                $column = "baslik_".$dil;
                $knt = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'dosyalar' AND COLUMN_NAME = '".$column."' AND table_schema = '".$dbname."'");
                if ($knt["tp"] == 0){
                    $this->dbConn->manualSql("ALTER TABLE dosyalar ADD COLUMN ".$column." VARCHAR(255)");
                }
            }

            $inputTitle = ($langCount > 1) ? '<img src="'.$this->ThemeFile().'/assets/flags/'.$dil.'.png" width="25px" style="margin-right:10px;">' : "";
            $text .= $form->input(array('style'=>(($dil == "ar") ? "direction:rtl":""),'value'=>((isset($urun['baslik_'.$dil]) ? $urun['baslik_'.$dil] :'')),'lang'=>$dil,'title'=>$inputTitle.' Başlık','name'=>'baslik','id'=>'baslik'));
        endforeach;

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.="<input type='hidden' name='type' value='".$type."'>";
        $text.="<input type='hidden' name='file_type' value='".$file_type."'>";


        $text.="</div></div></div>";

        $text.= $form->openColumn(4);

        $text .= $form->file(array('url'=>$this->BaseURL('upload')."/".$folder,'folder'=>$folder,'table'=>"dosyalar", 'title'=>'Resim','name'=>'fotoResim','resimBoyut'=>$boyut,'src'=>((isset($urun['dosya'])) ? $urun['dosya'] :'')));
        $text.= "</div>";

        $text .= $form->formClose();
        return $text;
    }

    public  function kaydet($id=null)
    {

        $upload_folder = $this->_POST("type");
        $file_type = $this->_POST("file_type");

        if (!empty($file_type)){
            $upload_folder = $file_type;
        }

        $post = array(
            'baslik'=> $this->_POST('baslik_tr'),
            'dosya' => $this->_RESIM_BASE64('fotoResim', $upload_folder),
            'duzenleme_tarihi'=>date("Y-m-d H:i:s")
        );



        $langCount = count($this->settings->lang());

        foreach ($this->settings->lang('lang') as $dil=>$title):
            if ($dil != "tr"){
                $post["baslik_".$dil] = $this->_POST("baslik",  $dil);
            }
        endforeach;

        // Güncelle
        if(isset($id) and $id):
            $this->dbConn->update('dosyalar',$post,$id);
        endif;

        $fotoid = $this->dbConn->tekSorgu("select * from dosyalar where id='$id'");
        $type = $fotoid["type"];
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/ekle/'.$fotoid['data_id']."&type=".$type.((!empty($file_type)) ? "&file_type=".$file_type : "")));
    }






    public function dosyaDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);

        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);

        $tr_duzenle = $this->dbConn->update("dosyalar",array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;

        exit();
    }




}