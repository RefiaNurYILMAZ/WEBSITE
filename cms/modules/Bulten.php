<?php


namespace cms;


class Bulten  extends Settings{


    public  $modulName = 'bulten';
    private $table;
    private $tablelang;



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("email"),
        ));

        $this->SayfaBaslik = 'Bülten Listesi';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $html = $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            'disableSortable'=>true,
            "place"=>"email adresi",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(
                array('title'=>'Email Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success"),
                array('title'=>'E-posta Listesi','href'=>'','class'=>'btn btn-warning mr-10','data'=>array('target'=>'#bultenmodal','toggle'=>'modal'),'icon'=>'fa fa-list')
            ),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'email', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),
            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Email Adresi','width'=>'20%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));

        $modal = new Widget($this->settings);
        $html .=  $modal->bulten($this->dbConn->sorgu('select * from bulten WHERE '.$this->silColumn.' <> 1 and aktif = 1 order by id desc'),'bultenmodal');
        return $html;



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Email '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        $data = $this->dbConn->tekSorgu("SELECT * FROM $this->modulName");
        $text.=$form->openBox().$form->openBoxBody();
        $text  .= $form->input(array("required"=>true,'value'=>((isset($data['email']) ? $this->temizle($data['email']) :'')),'title'=>'Email','name'=>'email'));
        $text .= $form->checkbox(array('value'=>((isset($data['aktif'])) ? $this->temizle($data['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();
        $text .= $form->formClose();

        return $text;
    }

    public function kaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'email'=> $this->kirlet($this->_POST('email')),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                );
            endif;

        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
            }

            $this->dbConn->update($this->table,$post['tr'],$id);

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
            }

            $post["tr"]["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();


        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid_tr')) ? "/".$this->_POST('kid_tr'):'')));
    }



    public function durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);

        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);

        $tr_duzenle = $this->dbConn->update($this->table,array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;

        exit();
    }





}