<?php
header('Content-Type: text/html; charset=utf-8');
include( __DIR__.'/vendor/autoload.php');
include( __DIR__.'/include/Smap.php');
include( __DIR__.'/include/Functions.php');
include( __DIR__.'/include/Database.php');
include( __DIR__.'/include/Mail.php');
include( __DIR__.'/include/FrontClass.php');
include( __DIR__.'/include/Lang.php');
include( __DIR__.'/include/Form.php');
include( __DIR__.'/include/Captcha/Captcha.php');

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

if( !function_exists('random_bytes') )
{
    function random_bytes($length = 6)
    {
        $characters = '0123456789';
        $characters_length = strlen($characters);
        $output = '';
        for ($i = 0; $i < $length; $i++)
            $output .= $characters[rand(0, $characters_length - 1)];

        return $output;
    }
}

use Snowsoft\Captcha\Captcha;

/**
 * Class Loader
 * @var string $title
 */
class Loader extends FrontClass
{
    public $settings;
    public $themeURL;
    public $katalogURL;
    public $lang;
    public $theme = 'default';
    public $fullUrl;
    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->settings = $settings;
        $this->theme = $this->settings->config('siteTemasi').'/';
        $this->themeURL = $this->settings->config('url').'view/'.$this->theme."assets/";
        $this->katalogURL = $this->settings->config('url').'view/'.$this->theme."e-katalog/";
        $this->fullUrl = $this->settings->config("url").$_SERVER["REQUEST_URI"];

    }



    public function sifrele($sifre){
        $password =  $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return base64_encode(openssl_encrypt($sifre, $method, $password, OPENSSL_RAW_DATA, $iv));
    }

    public function sifreCoz($sifreliVeri){
        $password =  $this->settings->config('sifre_anahtar');
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return openssl_decrypt(base64_decode($sifreliVeri), $method, $password, OPENSSL_RAW_DATA, $iv);
    }

    public function uzantiAl($dosya)
    {
        $par = explode(".",$dosya);
        $ct = count($par);
        return $uzanti = $par[$ct-1];
    }




    public function uzantiKontrol($uzanti)
    {
        $desteklenen = array("jpg","jpeg","png","doc","docx","doc","xls","xlsx","pdf");
        if (!in_array($uzanti, $desteklenen))
        {
            return false;
        }
        else {
            return true;
        }
    }


    public function resimUzantiKontrol($uzanti)
    {
        $desteklenen = array("jpg","jpeg","png");
        if (!in_array($uzanti, $desteklenen))
        {
            return false;
        }
        else {
            return true;
        }
    }

    public function boyutKontrol($dosyaBoyut)
    {
        $maks_boyut = 10;

        if($dosyaBoyut > (1024*1024*$maks_boyut)){
            return false;
        }
        else {
            return true;
        }
    }

    public function pageLoader($data=array())
    {


        $LangGET = new \Lang($data['lang']);
        $LangLink = new \Lang((($data['lang']=="tr") ? 'tr':'en'));

        $this->lang  = $LangGET;

        $data = array_merge(array('LangGET'=>$LangGET,'LangLink'=>$LangLink),$data);

        $text = "";
        $disable_header_footer = array("e-katalog","basvuru");
        if (!in_array($data["page"], $disable_header_footer)){
            $text .= $this->_include('bolum/ust',$data,$this->theme);
        }



        $key = array_search($data["page"], $LangLink->link());
        $t = new Lang("tr");
        $active_page =  $t->link($key);
        $data["page"] = $active_page;

     
        switch ($data['page']):
            default:
                $text .=  $this->_include('sayfa/'.$data["page"],$data,$this->theme);
                break;

            case 'hata':
                $text .= $this->_include('sayfa/hata',$data,$this->theme);
                break;

        endswitch;


        if (!in_array($data["page"], $disable_header_footer)){
            $text .= $this->_include('bolum/alt',$data,$this->theme);
        }

        return  $text;



    }

    // ajax/*
    public function ajaxLoader($page)
    {


        switch ($page):


            case 'getcaptchaimage':
                $captcha = new \Captcha();
                $captcha_code = $captcha->getCaptchaCode(6);
                $captcha->setSession('captcha_code', $captcha_code);
                $imageData = $captcha->createCaptchaImage($captcha_code);
                $captcha->renderCaptchaImage($imageData);
            break;

            case 'uyelikForm':

                $data = array();
                $error = [];

                $required = array("adi", "mesaj", "tel", "engellilik");
                foreach (Request::postAll() as $key=>$value){
                    if ($key != "recaptcha_return"):
                        $data[$key] = $value;
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }

                $post = array(
                    'adi'=>Request::POST('adi'),
                    'tc'=>Request::POST('tc'),
                    'engellilik_orani'=>Request::POST('engellilik'),
                    'telefon'=>Request::POST('tel'),
                    'mesaj'=>Request::POST('mesaj'),
                    'tarih'=>date('d-m-Y H:i'),
                    'goruldu'=>0,
                    'ip'=>$_SERVER['SERVER_ADDR']
                );
                $govde = $this->_include('ajax/uyelikForm',$post);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('basvuru_form'), $this->ayarlar('basvuru_form'), "Üyelik Ön Başvuru Formu", $govde, $this->ayarlar("unvan_tr"));
                        $this->insert('talep',$post);
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }


            break;


            case 'isForm':

                $data = array();
                $error = [];

                $required = array("adi", "meslek", "tel", "engellilik", "tahsil", "cinsiyet", "yas", "adres");
                foreach (Request::postAll() as $key=>$value){
                    if ($key != "recaptcha_return"):
                        $data[$key] = $value;
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }


                $post = array(
                    'adi_soyadi'=>Request::POST('adi'),
                    'tc_kimlik'=>Request::POST('tc'),
                    'cinsiyet'=>Request::POST('cinsiyet'),
                    'adresi'=>Request::POST('adres'),
                    'cep_telefonu'=>Request::POST('tel'),
                    'engellilik'=>"%".Request::POST('engellilik'),
                    'basvuru_tarihi'=>date('d-m-Y H:i'),
                    'meslek'=>Request::POST('meslek'),
                    'tahsil'=>Request::POST('tahsil'),
                    'yas'=>Request::POST('yas'),
                    'sil'=>0,
                );

                $govde = $this->_include('ajax/isForm',$post);

                if (count($error) < 1){
                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                        echo $this->_SEND($this->ayarlar('basvuru_form'), $this->ayarlar('basvuru_form'), "Üyelik Ön Başvuru Formu", $govde, $this->ayarlar("unvan_tr"));
                        $this->insert("kariyer", $post);
                    }else {
                        echo 3;
                    }
                }else {
                    echo 4;
                }


            break;


            case 'iletisimForm':

                $error = [];

                $required = array("adi", "mesaj", "tel", "konu", "email");
                foreach (Request::postAll() as $key=>$value){
                    if ($key != "recaptcha_return"):
                        if (in_array($key, $required)){
                            if ($value == ""){
                                $error[$key] = "Boş Bırakılamaz";
                            }
                        }
                    endif;
                }

                $govde = $this->_include('ajax/iletisim',
                    array(
                        'adi'=>Request::POST('adi'),
                        'mesaj'=>Request::POST('mesaj'),
                        'konu'=>Request::POST('konu'),
                        'tel'=>Request::POST('tel'),
                        'email'=>Request::POST('email'),
                    ));


                if (count($error) < 1){
                        echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"İletişim Formu",$govde, $this->ayarlar("unvan_tr"));
                }else {
                    echo 4;
                }


                break;

            case 'ilceler':
                header('Content-Type: text/html; charset=utf-8');
                $il = $this->koru(Request::POST('il'));

                if (isset($il) && (int)$il > 0) {
                    $veri = $this->sorgu("SELECT * FROM town WHERE CityID=$il");
                    echo "<option value='0'>İlçe Seçiniz.</option>";

                    foreach ($veri as $ilce) {
                        echo "<option value='".$ilce['TownID']."'>".$ilce["TownName"]."</option>";
                    }
                }

            break;




            /* teklif */

            case 'teklif':

                
                $error = [];

                $required = array("adi", "mesaj", "tel", "konu", "email");

                if(Request::postAll()){
                    foreach (Request::postAll() as $key=>$value){
                        if ($key != "recaptcha_return"):
                            if (in_array($key, $required)){
                                if ($value == ""){
                                    $error[$key] = "Boş Bırakılamaz";
                                }
                            }
                        endif;
                    }
                }else{
                    $error['all'] = "Tüm alanları doldurunuz";
                }



                    $govde = $this->_include('ajax/teklif',
                    array(
                        'urun'=>Request::POST('urun'),
                        'adi'=>Request::POST('adi'),
                        'tel'=>Request::POST('tel'),
                        'konu'=>Request::POST('konu'),
                        'email'=>Request::POST('email'),
                    ));

                    if (count($error) < 1){
                        $captcha = new \Captcha();
                        if($captcha->validateCaptcha(Request::POST("captcha_value"))) {
                            echo $this->_SEND($this->ayarlar('email'),$this->ayarlar('email'),"Teklif Formu",$govde, $this->ayarlar("unvan_tr"));
                        }else {
                            echo 3;
                        }
                    }else {
                        echo 4;
                    }
                break;

            /* # teklif */

            

            case 'isBasvuruForm':

                    $d_tarihi = new DateTime(date("Y-m-d", strtotime($this->kirlet(Request::POST('dogum_yeri_ve_tarihi')))));
                    $now = new DateTime(date("Y-m-d"));

                    $interval= $d_tarihi->diff($now);
                    $yas = $interval->y;


                    if ($yas < 22){
                        echo 7;
                        exit();
                    }


                    if (Request::POST('askerlik') === "Tecilli"){
                        $tecil_tarihi = new DateTime(date("Y-d-m", strtotime($this->kirlet(Request::POST('tecil_tarih')))));
                        $fark= $tecil_tarihi->diff($now);
                        $tecil_suresi = $fark->y;
                        if ($tecil_suresi < 2){
                            echo 8;
                            exit();
                        }
                    }


                    $istenen_bolumler = str_replace(",", ", ", $this->kirlet(Request::POST('bolum_text')));

                    $mesaj = "";
                    $dosya = "";

                    @$uploads_dir = $this->settings->config('folder')."kariyer/";

                    @$klasor = $_SERVER['DOCUMENT_ROOT'].$uploads_dir;

                    @exec("chmod -R 0777 $klasor");

                    $date = date("d-m-Y");

                    $captcha = Request::POST("captcha");







                    if ($_FILES["foto"]["name"] != ""){
                        $tmp_name = $_FILES["foto"]["tmp_name"];
                        $name = $_FILES["foto"]["name"];
                        $fsize = $_FILES["foto"]["size"];
                        $uzanti = $this->uzantiAl($name);


                        if ($name != ""){
                            if ($this->uzantiKontrol($uzanti)){
                                if ($this->boyutKontrol($fsize)){
                                    $rand = rand(000000,999999);
                                    $new = $this->permalink($this->kirlet(Request::POST('adi_soyadi')))."-".$date."-".$rand.".".$uzanti;
                                    $yukle = move_uploaded_file($tmp_name, "$uploads_dir$new");
                                    $this->kucult($uploads_dir,$new,500,0);
                                    if ($yukle){
                                        $dosya = $this->baseURL($uploads_dir.$new);
                                    }
                                }
                                else {
                                    $mesaj.= "4";
                                }
                            }

                            else {
                                $mesaj.= "5";
                            }

                        }
                    }



                    if ($_FILES["cv"]["name"] != ""){
                        $tmp_name = $_FILES["cv"]["tmp_name"];
                        $name = $_FILES["cv"]["name"];
                        $fsize = $_FILES["cv"]["size"];
                        $uzanti = $this->uzantiAl($name);
                        $files_ext = array("doc", "docx", "xls", "xlsx","pdf");


                        if ($name != ""){
                            if ($this->uzantiKontrol($uzanti)){
                                if ($this->boyutKontrol($fsize)){
                                    $rand = rand(000000,999999);
                                    $new = $this->permalink($this->kirlet(Request::POST('adi_soyadi')))."-".$date."-".$rand.".".$uzanti;
                                    $yukle = move_uploaded_file($tmp_name, "$uploads_dir$new");
                                    if (!in_array($uzanti, $files_ext)){
                                        $this->kucult($uploads_dir,$new,500,0);
                                    }
                                    if ($yukle){
                                        $cv = $this->baseURL($uploads_dir.$new);
                                    }
                                }
                                else {
                                    $mesaj.= "44";
                                }
                            }
                            else {
                                $mesaj.= "55";
                            }
                        }
                    }else {
                        $cv = null;
                    }




                    $ik_il = $this->kirlet(Request::POST('ik_il'));
                    $ik_ilce = $this->kirlet(Request::POST('ik_ilce'));
                    $il = $this->tekSorgu("SELECT * FROM city WHERE CityID = ".$ik_il)["CityName"];
                    $ilce = $this->tekSorgu("SELECT * FROM town WHERE TownID = ".$ik_ilce)["TownName"];
                    $calismak_istenen_yer = $this->kirlet(Request::POST('calismak_istenen_yer'));


                    $post = array(
                        'tc_kimlik'=>$this->kirlet(Request::POST('tc_kimlik')),
                        'adi_soyadi'=>$this->kirlet(Request::POST('adi_soyadi')),
                        'cinsiyet'=>$this->kirlet(Request::POST('cinsiyet')),
                        'dogum_yeri_ve_tarihi'=>$this->kirlet(Request::POST('dogum_yeri_ve_tarihi')),
                        'ik_il'=>$il,
                        'ik_ilce'=>$ilce,
                        'adresi'=>$this->kirlet(Request::POST('adresi')),
                        'aile_calisan'=>$this->kirlet(Request::POST('aile_calisan')),
                        'cep_telefonu'=>$this->kirlet(Request::POST('cep_telefonu')),
                        'meslek'=>$this->kirlet(Request::POST('meslek')),
                        'ehliyet'=>$this->kirlet(Request::POST('ehliyet')),
                        'askerlik'=>$this->kirlet(Request::POST('askerlik')),
                        'tecil_tarih'=>$this->kirlet(Request::POST('tecil_tarih')),
                        'rahatsizlik'=>$this->kirlet(Request::POST('rahatsizlik')),
                        'medeni_hal'=>$this->kirlet(Request::POST('medeni_hal')),
                        'cocuk_sayisi'=>$this->kirlet(Request::POST('cocuk_sayisi')),
                        'sabika'=>$this->kirlet(Request::POST('sabika')),
                        'icra_takibi'=>$this->kirlet(Request::POST('icra_takibi')),
                        'istenen_bolum'=>$istenen_bolumler,
                        'tahsil'=>$this->kirlet(Request::POST('tahsil')),
                        'calismak_istenen_yer'=>$calismak_istenen_yer,
                        'kurslar'=>$this->kirlet(Request::POST('kurslar')),
                        'referans'=>$this->kirlet(Request::POST('referans')),
                        'firma_adi_1'=>$this->kirlet(Request::POST('firma_adi_1')),
                        'firma_telefon_1'=>$this->kirlet(Request::POST('firma_telefon_1')),
                        'firma_gorev_1'=>$this->kirlet(Request::POST('firma_gorev_1')),
                        'calisma_suresi_1'=>$this->kirlet(Request::POST('calisma_suresi_1')),
                        'ayrilik_nedeni_1'=>$this->kirlet(Request::POST('ayrilik_nedeni_1')),
                        'firma_adi_2'=>$this->kirlet(Request::POST('firma_adi_2')),
                        'firma_telefon_2'=>$this->kirlet(Request::POST('firma_telefon_2')),
                        'firma_gorev_2'=>$this->kirlet(Request::POST('firma_gorev_2')),
                        'calisma_suresi_2'=>$this->kirlet(Request::POST('calisma_suresi_2')),
                        'ayrilik_nedeni_2'=>$this->kirlet(Request::POST('ayrilik_nedeni_2')),
                        'firma_adi_3'=>$this->kirlet(Request::POST('firma_adi_3')),
                        'firma_telefon_3'=>$this->kirlet(Request::POST('firma_telefon_3')),
                        'firma_gorev_3'=>$this->kirlet(Request::POST('firma_gorev_3')),
                        'calisma_suresi_3'=>$this->kirlet(Request::POST('calisma_suresi_3')),
                        'ayrilik_nedeni_3'=>$this->kirlet(Request::POST('ayrilik_nedeni_3')),
                        'boy'=>$this->kirlet(Request::POST('boy')),
                        'kilo'=>$this->kirlet(Request::POST('kilo')),
                        'engellilik'=>$this->kirlet(Request::POST('engellilik')),
                        'basvuru_tarihi'=>date("d-m-Y H:i"),
                        'resim'=>$dosya,
                        "cv"=>$cv,
                    );




                    $captcha = new \Captcha();
                    if($captcha->validateCaptcha(Request::POST("captcha_value"))){

                       $ekle = $this->insert("kariyer", $post);
                       $govde1 = $this->_include('ajax/isBasvuruForm',$post);

                        if ($mesaj == ""){
                            echo $this->_SEND($this->ayarlar('kariyer_form'),$this->ayarlar('kariyer_form'),'İş Başvuru Formu',$govde1);
                        }
                        else {
                            echo $mesaj;
                        }
                    }

                    else {
                        echo 3;
                    }



                break;


            case 'basvuru':
                $govde1 = $this->_include('ajax/basvuru',
                    array(
                        'tc_kimlik'=>$this->kirlet(Request::POST('tc_kimlik')),
                        'adi_soyadi'=>$this->kirlet(Request::POST('adi_soyadi')),
                        'email'=>Request::POST('email'),
                        'dogum_yeri_ve_tarihi'=>$this->kirlet(Request::POST('dogum_yeri_ve_tarihi')),
                        'cinsiyeti_medeni_hali_cocuk_sayisi'=>$this->kirlet(Request::POST('cinsiyeti_medeni_hali_cocuk_sayisi')),
                        'ehliyet'=>$this->kirlet(Request::POST('ehliyet')),
                        'askerlik_durumu'=>$this->kirlet(Request::POST('askerlik_durumu')),
                        'cep_telefonu'=>$this->kirlet(Request::POST('cep_telefonu')),
                        'adresi'=>$this->kirlet(Request::POST('adresi')),
                        'yabanci_dil'=>$this->kirlet(Request::POST('yabanci_dil')),
                        'meslegi'=>$this->kirlet(Request::POST('meslegi')),
                        'ne_zaman_baslayabilecegi'=>$this->kirlet(Request::POST('ne_zaman_baslayabilecegi')),
                        'istenilen_gorev'=>$this->kirlet(Request::POST('istenilen_gorev')),
                        'istenilen_ucret'=>$this->kirlet(Request::POST('istenilen_ucret')),
                        'sigara'=>$this->kirlet(Request::POST('sigara')),
                        'hukumluluk'=>$this->kirlet(Request::POST('hukumluluk')),
                        'engel'=>$this->kirlet(Request::POST('engel')),
                        'seyahat'=>$this->kirlet(Request::POST('seyahat')),
                        'mezuniyet'=>$this->kirlet(Request::POST('universite_bolum')),
                        'not'=>$this->kirlet(Request::POST('not')),
                        'bilgisayar'=>$this->kirlet(Request::POST('bilgisayar')),
                        'eski_isyeri'=>$this->kirlet(Request::POST('eski_isyeri')),
                        'tarih'=>date("d-m-Y H:i"),
                    ));




                $captcha = new \Captcha();
                if($captcha->validateCaptcha(Request::POST("captcha_value"))){
                    echo $this->_SEND($this->ayarlar('kariyer_form'),$this->ayarlar('kariyer_form'),'İş Başvuru Formu',$govde1, $this->ayarlar("unvan_tr"));
                }else {
                    echo 3;
                }

                break;


            case 'form':
                echo   $this->_include('ajax/form');
            break;

            case 'newsletterForm':
                if(Request::POST('email')):
                    $email = Request::POST('email');
                    $mail = $this->sorgu("select email from bulten where email='$email' and sil <> 1");
                    if(is_array($mail)>0): echo 2;
                    else:
                        $this->insert('bulten',array(
                            'email' => $email,
                            'tarih' =>date('d/m/Y H:i'),
                            'ip'=>$_SERVER['SERVER_ADDR']
                        ));
                        echo 1;
                    endif;
                else:
                    echo 3;
                endif;
                break;











        endswitch;



    }


}