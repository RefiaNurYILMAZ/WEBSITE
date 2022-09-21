<?

use function GuzzleHttp\Psr7\str;

/**
 * Class FrontClass
 */
class FrontClass extends Mail
{
    /**
     * @var
     */
    public $settings;
    /**
     * @var
     */
    public $pageid;
    /**
     * @var
     */
    public $data;
    /**
     * @var
     */
    public $kid;
    /**
     * @var null
     */
    public $sayfaBaslik;
    /**
     * @var
     */
    public $ogBaslik;
    /**
     * @var
     */
    public $ogResim;
    /**
     * @var
     */
    public $ogUrl;
    /**
     * @var
     */
    public $ogWidth;
    /**
     * @var
     */
    public $ogDescription;
    /**
     * @var
     */
    public $ogHeight;
    /**
     * @var
     */
    public $ogAlt;
    /**
     * @var
     */
    public $metaKeywords;
    /**
     * @var
     */
    public $pageLang;
    /**
     * @var
     */
    public $pageName;
    /**
     * @var
     */
    public $protocol;

    public $disable_cache = false;

    public $htmlAttr;


    /**
     * FrontClass constructor.
     * @param $settings
     */
    public function __construct($settings)
    {

        parent::__construct($settings);
        $this->settings = $settings;
        $this->sayfaBaslik = $this->ayarlar("title_tr");
    }


    /**
     * @param $data
     * @return null
     */
    public function ayarlar($data)
    {
        if ($data):
            $d = $this->tekSorgu("select * from ayarlar where name='$data' ");
            return ($d['value']) ? $d['value'] : null;
        endif;

    }


    /**
     * @return null
     */
    public function sayfaBaslik()
    {
        return $this->sayfaBaslik;
    }

    /**
     * @param $page
     */
    public function setPageName($page)
    {
        $this->pageName = $page;
    }

    /**
     * @param null $http_accept
     * @param string $deflang
     * @return string
     */
    public function get_user_lang($http_accept=null, $deflang='tr'){
        $http_accept = is_null($http_accept) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : $http_accept;
        $x = explode(',',$http_accept);
        $lang = array();
        foreach ($x as $val)
        {
            if(preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i",$val,$matches))
            {
                $lang[$matches[1]] = (float)$matches[2];
            } else {
                $lang[$val] = 1.0;
            }
        }
        $qval = 0.0;
        foreach ($lang as $key => $value) {
            if ($value > $qval) {
                $qval = (float)$value;
                $deflang = $key;
            }
        }
        $dlang = preg_match("/(.*)-(.*)/i",$deflang,$mlang) ? $mlang[1] : $deflang;
        return strtolower($dlang);
    }

    /**
     * @param $lang
     * @return string
     */
    public function langText($lang){
        switch ($lang) {
            case "tr":
                return "Türkçe";
                break;

            case "en":
                return "English";
                break;

            case "ar":
                return "العربية";
                break;

            default:
                return "Türkçe";
                break;
        }
    }


    /**
     * @param $gelen
     * @return mixed
     */
    public function kucuk_yap($gelen){

        $gelen=str_replace('Ç', 'ç', $gelen);
        $gelen=str_replace('Ğ', 'ğ', $gelen);
        $gelen=str_replace('I', 'ı', $gelen);
        $gelen=str_replace('İ', 'i', $gelen);
        $gelen=str_replace('Ö', 'ö', $gelen);
        $gelen=str_replace('Ş', 'ş', $gelen);
        $gelen=str_replace('Ü', 'ü', $gelen);
        $gelen=mb_strtolower($gelen, 'utf8');

        return $gelen;
    }

    /**
     * @param $gelen
     * @return string
     */
    public function ucwords_tr($gelen){

        $sonuc='';
        $kelimeler=explode(" ", $gelen);

        foreach ($kelimeler as $kelime_duz){

            $kelime_uzunluk=strlen($kelime_duz);
            $ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');

            if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
                $ilk_karakter='Ç';
            }elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
                $ilk_karakter='Ğ';
            }elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
                $ilk_karakter='I';
            }elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
                $ilk_karakter='İ';
            }elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
                $ilk_karakter='Ö';
            }elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
                $ilk_karakter='Ş';
            }elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
                $ilk_karakter='Ü';
            }else{
                $ilk_karakter=strtoupper($ilk_karakter);
            }

            $digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
            $sonuc.=$ilk_karakter.$this->kucuk_yap($digerleri).' ';

        }

        $son=trim(str_replace('  ', ' ', $sonuc));
        return $son;

    }


    /**
     * @param int $islem
     * @param $klasor
     * @param $dosya
     * @param $logo
     * @return bool
     */
    public function watermark($islem = 0, $klasor, $dosya, $logo){
        $par = explode(".", $dosya);
        $uzanti = $par[count($par) - 1];

        if ($islem == 0){
            switch ($uzanti) {
                case "jpg":
                case "jpeg":
                    $mevcut_resim = imagecreatefromjpeg($klasor.$dosya);
                    break;

                case "png":
                    $mevcut_resim = imagecreatefrompng($klasor.$dosya);
                    break;

                default:
                    $mevcut_resim = imagecreatefromjpeg($klasor.$dosya);
                    break;
            }

            $eklenen_resim = imagecreatefrompng($logo);

            list($genislik, $yukseklik) = getimagesize($logo);

            $sag = (imagesx($mevcut_resim) - $genislik) / 2;
            $sol = (imagesy($mevcut_resim) - $yukseklik) / 2;


            imagealphablending($mevcut_resim, true);
            imagealphablending($eklenen_resim, true);

            imagecopy($mevcut_resim, $eklenen_resim, $sag, $sol, 0, 0, $genislik, $yukseklik);


            switch ($uzanti) {
                case "jpg":
                case "jpeg":
                    imagejpeg($mevcut_resim, $klasor.$dosya, 100);
                    break;

                case "png":
                    imagepng($mevcut_resim, $klasor.$dosya, 100);
                    break;

                default:
                    imagejpeg($mevcut_resim, $klasor.$dosya, 100);
                    break;
            }

            imagedestroy($mevcut_resim);
            return true;
        }
        else {
            return false;
        }

    }


    /**
     * @param $table
     * @param string $kosul
     * @param string $resimler
     * @param string $limit
     * @param string $order
     * @param bool $showSql
     * @return bool|PDOStatement
     */
    public function dbLangSelect($table, $kosul = "", $resimler = "", $limit = "", $order = "", $showSql = false, $group = null){

        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        if ($lang != "tr"){

            $ek = ($kosul != "") ? " and ".$kosul : '';
            $rtext = "";

            if ($order == ""){
                $order = "ORDER BY sira ASC, master_id DESC";
            }

            if ($resimler != ""){
                $par = explode(",", $resimler);
                if(count($par) > 0){
                    for($i=0; $i<count($par); $i++){
                        $rtext.=", (SELECT $par[$i] FROM $table WHERE $table.id = ".$table."_lang.master_id) as $par[$i]";
                    }
                }
            }
            $query = "SELECT *, (SELECT sira FROM $table WHERE $table.id = ".$table."_lang.master_id) as sira $rtext FROM ".$table."_lang WHERE dil = '$lang' $ek and sil <> 1 $group $order   $limit";


            if ($showSql){
                echo $query;
            }else {
                $sorgu = $this->sorgu($query);
            }



        }

        else {
            if ($order == ""){
                $order = "ORDER BY sira ASC, id DESC";
            }

            $ek = ($kosul != "") ? "WHERE ".$kosul : ' WHERE 1=1 ';

            $query = "SELECT * FROM $table $ek and sil <> 1 $group $order  $limit";

            if ($showSql){
                echo $query;
            }else {
                $sorgu = $this->sorgu($query);
            }





        }



        if (is_array($sorgu)){
            return $sorgu;
        }

        else {
            return false;
        }


    }


    /**
     * @param $table
     * @param array $kosul
     * @param string $resimler
     * @return bool|mixed
     */
    public function dbLangSelectRow($table, $kosul = array(), $resimler = ""){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";

        $anahtar = array_keys($kosul);
        $stun = $anahtar[0];
        $deger = $kosul[$stun];



        if ($lang != "tr"){

            $rtext = "";

            if ($resimler != ""){
                $par = explode(",", $resimler);
                if(count($par) > 0){
                    for($i=0; $i<count($par); $i++){
                        $rtext.=", (SELECT $par[$i] FROM $table WHERE $table.id = ".$table."_lang.master_id) as $par[$i]";
                    }
                }
            }

            if (count($anahtar) > 1){
                $stun = $anahtar[1];
            }
            else {
                $stun = $anahtar[0];
            }

            $deger = $kosul[$stun];


            $sorgu = $this->teksorgu("SELECT *, (SELECT sira FROM $table WHERE $table.id = ".$table."_lang.master_id) as sira $rtext FROM ".$table."_lang WHERE dil = '$lang' and $stun = '".$deger."' and sil <> 1");


        }

        else {
            $sorgu = $this->teksorgu("SELECT * FROM $table WHERE $stun = '".$deger."' and sil <> 1");
        }



        if (is_array($sorgu)){
            return $sorgu;
        }

        else {
            return false;
        }

    }


    /**
     * @param $resim
     * @param $klasor
     * @param string $boyut
     * @param bool $noImage
     * @param bool $center
     * @param string $noImageName
     * @return string
     */
    public function dbResimAl($resim, $klasor, $boyut = "600,400", $noImage = false, $center = true, $noImageName = "no-image.png"){


        $res  = $this->resimGet($resim);

        $boyut = str_replace("x", ",", $boyut);

        list($genislik, $yukseklik) = explode(",", $boyut);

        if($res and file_exists($this->settings->config('folder').$klasor."/".$res)){
            $resimAl = $this->BaseURL($this->resimal($genislik,$yukseklik,$res,$this->settings->config('folder').$klasor."/", $center));
        }
        else {

            if ($noImage){
                $resimAl = $this->BaseURL($this->resimal($genislik,$yukseklik,$noImageName,$this->settings->config('folder')));
            }
            else {
                $resimAl = "";
            }
        }
        return $resimAl;

    }


    /**
     * @param $id
     * @param $table
     * @param $sayfa
     * @param string $kosul
     */
    public function langZorunluSayfa($id, $table, $sayfa, $kosul = ""){

        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";

        if ($id == 0){
            if ($lang != "tr"){
                $kos =  ($kosul != "") ? " and $kosul" : '';
                $qq = $this->teksorgu("SELECT *, (SELECT sira FROM $table WHERE $table.id = ".$table."_lang.master_id) as sira FROM ".$table."_lang WHERE dil = '".$lang."' $kos and sil <> 1 ORDER BY sira ASC");
            }

            else {
                $kos =  ($kosul != "") ? "WHERE $kosul" : ' WHERE 1 = 1 ';
                $qq = $this->teksorgu("SELECT * FROM $table $kos and sil <> 1 ORDER BY sira ASC");
            }

            if ($lang != "tr"){
                $yonlendir = $this->lang->link($sayfa);
            }
            else {
                $yonlendir = $sayfa;
            }

            if (is_array($qq)){
                $urlq = $this->baseURL($yonlendir."/".$qq["url"], $lang, 1);
                $this->RedirectURL($urlq);
            }




        }

    }

    /**
     * @param $veri
     * @param string $column
     */
    public function detay($veri, $column = "detay"){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        $detay = $this->temizle($veri[$column], true);
        if ($lang != "tr"){
            $detay = str_replace("../", "../../", $detay);
        }
        echo $detay;
    }


    /**
     * @param array $param
     */
    public function dosyalar($param = array()){
        echo $this->_include('bolum/dosya',["param"=>$param],$this->theme);
    }

    public function files($param = array()){
        echo $this->_include('bolum/files',["param"=>$param],$this->theme);
    }


    /**
     * @param array $param
     */
    public function sidebar($param = array()){
        echo $this->_include('bolum/sidebar',["param"=>$param],$this->theme);
    }


    /**
     * @param array $param
     */
    public function sayfalamaButon($param = array()){
        echo $this->_include('bolum/sayfalama',["param"=>$param],$this->theme);
    }


    /**
     * @param $veri
     * @param int $sayfaLimit
     * @return array
     */
    public function sayfalama($veri, $sayfaLimit = 20){

        $page = $this->pageName;
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        if (is_array($veri)) {
            $toplamVeri = count($veri);
        }


        if ($page == $this->lang->link("referanslar") || $page == $this->lang->link("kategori")){
            $sayfa = Request::GETURL("page", 1);
        }else {
            $sayfa = (isset($_GET["sayfa"])) ? $this->kirlet(intval($_GET['sayfa'])) : 1;
        }

        if (!is_numeric($sayfa)){
            $sayfa = 1;
        }

        $gecerli = 0;
        $toplamSayfa = ceil($toplamVeri / $sayfaLimit);

        if ($sayfa > $toplamSayfa)
        {
            $sayfa = 1;
        }

        if ($sayfa > 0){
            $gecerli = ($sayfa - 1) * $sayfaLimit;
        }

        $showlist = "";

        if ($toplamSayfa < 2){
            $showlist = "0 - ".$toplamVeri;
        }

        else {
            if ($sayfa == $toplamSayfa){
                $showlist = ($sayfa - 1) * $sayfaLimit." - ".$toplamVeri;
            }
            else {
                $showlist = ($sayfa - 1) * $sayfaLimit." - ".($sayfa * $sayfaLimit);
            }
        }

        return array($gecerli, $sayfaLimit, $toplamSayfa, $sayfa, $showlist);

    }

    /**
     * @param $no
     * @return mixed
     */
    public function telefonFormat($no){
        $bul = array("",",", " ",  ")", "(", "-", "p", "b", "x", "q");
        $dgsd = array("", "", "",  "", "", "", "", "", "", "");
        $par = explode("<br>", $no);

        if (is_array($par)){
            $no = $par[0];
        }

        return str_replace($bul, $dgsd, $no);
    }


    /**
     * @return mixed
     */
    public function getSiteKey(){
        $content = $this->settings->security("reCAPTCHA");
        return $content["sitekey"];
    }

    public function getSecretKey(){
        $content = $this->settings->security("reCAPTCHA");
        return $content["secret"];
    }


    /**
     * @param $fiyat
     * @return string
     */
    public function fiyatAl($fiyat){
        return number_format($fiyat, 2, ',', '.');
    }

    /**
     * @param $item
     * @return mixed
     */
    public function getID($item)
    {
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        return (($lang == 'tr') ? $item['id'] : $item['master_id']);
    }


    /**
     * @param array $param
     */
    public function langHeaderMenu($param = array()){
        $page     = $this->pageName;
        $lang     = $this->pageLang;
        if ($lang == "") $lang = "tr";


        foreach ($param as $item) {
            $sayfa    = (isset($item["sayfa"])) ? $item["sayfa"] : "";
            $icon    = (isset($item["icon"])) ? $item["icon"] : "";
            $table    = (isset($item["table"])) ? $item["table"] : "";
            $ek    = (isset($item["ek"])) ? $item["ek"] : "";
            $sub    = (isset($item["sub"])) ? $item["sub"] : "";
            $data    = (isset($item["data"])) ? $item["data"] : "";
            $ekstraActive    = (isset($item["active"])) ? $item["active"] : "";
            $alt_sayfa = (isset($item["alt_sayfa"])) ? $item["alt_sayfa"] : "";
            $disable_url = (isset($item["disable_url"])) ? $item["disable_url"] : "";
            $dropdown_class = (isset($item["dropdown_class"])) ? $item["dropdown_class"] : "";
            $alt      = (isset($item["alt"])) ? $item["alt"] : "";
            $menu_icon      = (isset($item["menu_icon"])) ? $item["menu_icon"] : "";
            $active   = "active";
            $altClass = "sub-menu-down";
            $subUlClass = "sub-menu";
            $subLiClass = "";
            $parent_a_class = "";

            if (!empty($dropdown_class)){
                $subUlClass = $dropdown_class;
            }


            $arrayActive = explode(",", $ekstraActive);

            foreach ($arrayActive as $deger) {
                $i=0;
                $arrayActive[$i] == $this->lang->link($deger);
                $i++;
            }


            $disableArr = array();
            $new = array();

            if (is_array($sub)){
                foreach ($sub as $item) {
                    $i=0;
                    array_push($new, $this->lang->link($item));
                    $i++;
                }
            }


            if (is_array($sub)){
                $burl = $this->BaseURL($this->lang->link($sub[0]), $lang, 1);
                $urlUst = $burl;
            }
            else {
                $urlUst = $this->BaseURL($this->lang->link($sayfa), $lang, 1);
            }

            if ($disable_url){
                $urlUst = "javascript:void(0)";
            }


            if (!is_array($alt) && !is_array($ek) && !is_array($sub)){
                $parent_a_class = "";
            }

            $mid = ($lang != "tr") ? "master_" : "";

            if (is_array($alt) && count($alt) < 2){
                $parent_a_class = "";
            }


            echo "<li class='".((is_array($alt) || is_array($sub) || is_array($data)) ? $altClass." " : "").(($page == $this->lang->link($sayfa)) ? " ".$active : "").((isset($alt_sayfa[0]) && $page == $this->lang->link($alt_sayfa[0]) ? " ".$active : "")).((in_array($page, $arrayActive)) ? " ".$active : "").((in_array($page, $new)) ? $active : "")."'>
            <a title='".$this->lang->header($sayfa)."' class='".$parent_a_class." ".(($page == $this->lang->link($sayfa)) ? " ".$active : "").((isset($alt_sayfa[0]) && $page == $this->lang->link($alt_sayfa[0]) ? " ".$active : "")).((in_array($page, $arrayActive)) ? " ".$active : "").((in_array($page, $new)) ? $active : "")."' href='".$urlUst."'>".((isset($menu_icon)) ? "<i class='".$menu_icon."'></i>" : "").$this->lang->header($sayfa)." ".((!empty($icon)) ? '<i class="fa '.$icon.'"></i> ' : '')."</a>";
            if (is_array($alt) && count($alt) > 0){
                echo "<ul class='".$subUlClass."'>";

                /*
                foreach ($alt as $veri) {
                    $urlAlt = $this->BaseURL($this->lang->link($alt_sayfa[0])."/".$veri["url"], $lang, 1);
                    echo "<li class='".$subLiClass."'>";
                    echo "<a class='hover-flip-item-wrapper' title='".$this->temizle($veri[$alt_sayfa[1]])."' href='".$urlAlt."'>";
                    echo '<span class="hover-flip-item"> <span data-text="'.$this->temizle($veri[$alt_sayfa[1]]).'">'.$this->temizle($veri[$alt_sayfa[1]]).'</span></span>';
                    echo "</a>";
                    echo "</li>";
                }
                */

                  /*  yeni menu    $veri[$mid.'id']  */
                if ($sayfa == 'urunler'){
                    foreach ($alt as $veri) {
                        $urkat = $this->getURL($veri, "urunkat");
                        $alt = $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and ustu = '.$veri[$mid.'id']);
                        echo "<li class='deneme'><a href='".$urkat."'>".$this->temizle($veri['baslik'])."</a>";  //javascript:void(0)  href='javascript:void(0)'
                        
                       // var_dump($alt); 
                        $urun_varmi = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and kid = '.$veri[$mid.'id']);


                        if(is_array($alt)){

                            
                            echo "<ul class='".$subUlClass."'>";
                            foreach ($alt as $a){
                                $urun = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and kid = '.$a[$mid.'id']);
                                $ur = $this->getURL($a, "urunkat");
                                echo "<li><a href='".$ur."'>".$this->temizle($a["baslik"])."</a>";
                                
                                /*if(is_array($urun)){
                                    echo "<ul class='".$subUlClass."'>";
                                    foreach ($urun as $u){
                                        $ur = $this->getURL($a, "urun_kat");
                                        echo "<li><a href='".$ur."'>".$this->temizle($u["baslik"])."</a></li>";
                                    }
                                    echo "</ul>";
                                }*/
                                echo '</li>';
                            }

                                  /*  //////////////  */
                              /*  if(is_array($urun_varmi)){
                           
                                    foreach ($urun_varmi as $a){
                                        $urun = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and kid = '.$a[$mid.'id']);
                                        $ur = $this->getURL($a, "urun_kat");
                                        echo "<li><a  href='".$ur."'>".$this->temizle($a["baslik"])."</a>";
                                        if(is_array($urun)){
                                            echo "<ul class='".$subUlClass."'>";
                                            foreach ($urun as $u){
                                                $ur = $this->getURL($a, "urun_kat");
                                                echo "<li><a href='".$ur."'>".$this->temizle($u["baslik"])."</a></li>";
                                            }
                                            echo "</ul>";
                                        }
                                        echo '</li>';
                                    }
                             
                                } */
                           /*  ////////////////////  */


                            echo "</ul>";


                        }
                 

                  

                        echo "</li>";
                    }
                }else {

                    foreach ($alt as $veri) {
                        $urlAlt = $this->BaseURL($this->lang->link($alt_sayfa[0])."/".$veri["url"], $lang, 1);
                        echo "<li class='".$subLiClass."'>";
                        echo "<a class='hover-flip-item-wrapper' title='".$this->temizle($veri[$alt_sayfa[1]])."' href='".$urlAlt."'>";
                        echo '<span class="hover-flip-item"> <span data-text="'.$this->temizle($veri[$alt_sayfa[1]]).'">'.$this->temizle($veri[$alt_sayfa[1]]).'</span></span>';
                        echo "</a>";
                        echo "</li>";
                    }
    
                }

                    /*  #yeni menu */

                if (isset($item["policies"]) && is_array($item["policies"])){
                    $policies = $item["policies"];
                    echo "<li class='".$altClass."'><a href='javascript:void(0)'>".$this->lang->header("politikalarimiz")."</a>";
                    echo "<ul class='".$subUlClass."'>";
                    foreach ($policies as $policy){
                        $ur = $this->getURL($policy, "politikalar");
                        echo "<li><a href='".$ur."'>".$this->temizle($policy["baslik"])."</a></li>";
                    }
                    echo "</ul>";
                    echo "</li>";
                }


                if (is_array($ek)){
                    foreach ($ek as $item) {
                        $urlAlt = $this->BaseURL($this->lang->link($item), $lang, 1);
                        echo "<li class='".$subLiClass."'>";
                        echo "<a title='".$this->lang->header($item)."' href='$urlAlt'>";
                        echo $this->lang->header($item);
                        echo "</a>";
                        echo "</li>";
                    }
                }

                echo "</ul>";
            }


            if (is_array($sub)){
                echo "<ul class='".$subUlClass."'>";
                foreach ($sub as $item) {

                    $urlAlt = $this->BaseURL($this->lang->link($item), $lang, 1);
                    echo "<li class='".$subLiClass."'>";
                    echo "<a class='hover-flip-item-wrapper' title='".$this->lang->header($item)."' href='$urlAlt'>";
                    echo '<span class="hover-flip-item"> <span data-text="'.$this->lang->header($item).'">'.$this->lang->header($item).'</span></span>';
                    echo "</a>";
                    echo "</li>";

                }
                echo "</ul>";

            }

            echo "</li>";
        }
    }




    /**
     * @param null $url
     * @param string $lang
     * @param int $uzanti
     * @return string
     */
    public function BaseURL($url = null, $lang = 'tr', $uzanti = 0)
    {
        return $this->settings->config('url') . (($lang != "tr") ? $lang . '/' : null) . (($url) ? $url : null);
    }


    public function langURL($data){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        return $this->BaseURL($this->lang->link($data), $lang, 1);
    }


    /**
     * @param $resim
     * @return mixed|null|string
     */
    public function resimGet($resim)
    {
        if (self::isJSON($resim)):
            $files = json_decode($resim, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return (isset($files['image']) and is_array($files)) ? (($files['crop'] == "true") ? "crop_" . $files['image'] : $files['image']) : null;
        else:
            return $resim;
        endif;
    }

    public function isLocale()
    {
        $domain = explode('.',$_SERVER["SERVER_NAME"]);
        $domain = $domain[count($domain)-1];

        if($_SERVER["SERVER_NAME"] == "localhost" or $domain=="det" or $domain == 'vm' or $domain > 0){
            return true;
        }else {
            return false;
        }
    }


    /**
     * @param $data
     * @return mixed
     */
    public function jsonGet($data)
    {

        if (self::isJSON($data)):
            $datas = json_decode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return $datas;
        else:
            return $data;
        endif;


    }


    /**
     * @param $file
     * @param array $data
     * @param null $theme
     * @return false|string
     */
    public function _include($file, $data = array(), $theme = null)
    {
        $sub = (file_exists('view')) ? 'view/' : null;
        $lang = $this->pageLang;




        if ($file  and file_exists($sub . $theme . $file . '.php')):
            $data = array_merge(array("lang"=>$lang), $data);
            if ($data) extract($data);
            ob_start();
            include($sub . $theme . $file . '.php');
            return ob_get_clean();
        else:
            $x = 0;
            if (isset($data['LangLink']))


                /*                foreach ($data['LangLink']->header() as $key => $value):
                                    if ($data['page'] == $this->permalink($value)):
                                        if ($key and file_exists($sub . $theme . 'sayfa/' . $key . '.php')):
                                            return $this->_include($theme . 'sayfa/' . $key, $data);
                                            $x++;
                                            else:
                                                return $this->_include($theme . 'sayfa/hata', $data);
                                        endif;
                                    endif;
                                endforeach;*/


                if($x==0){
                    $data = array_merge(array("lang"=>$lang), $data);
                    if ($data) extract($data);
                    ob_start();
                    include($sub . $theme . 'sayfa/hata.php');
                    return ob_get_clean();
                }

        endif;
    }


    /**
     * @return string
     */
    public function getMap(){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        return '<script charset="UTF-8" type="text/javascript" src="'.$this->protocol.'://maps.googleapis.com/maps/api/js?key='.$this->ayarlar("map_api").'&language='.$lang.'&libraries=places"></script>'."\n";
    }

    /**
     * @return string
     */


    public function getHeader(){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        $text = "<!DOCTYPE HTML>
    <html lang=\"$lang\" ".$this->htmlAttr." >
    <head>
    <title>".$this->sayfaBaslik."</title>
    <base url=\"".$this->BaseURL()."\">
    <meta http-equiv=\"content-Type\" content=\"text/html; charset=utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
    <meta name=\"description\" content=\"".$this->ayarlar("description_$lang")."\" />
    <meta name=\"keywords\" content=\"".((isset($this->metaKeywords) && $this->metaKeywords != "") ? $this->metaKeywords : $this->ayarlar("keywords_$lang"))."\" />
    ";

        if ($this->disable_cache){
            $text.= "\n\t<meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\">
    <meta http-equiv=\"Pragma\" content=\"no-cache\">
    <meta http-equiv=\"Expires\" content=\"0\">";
        }


        $csrf_token = sha1(session_id());
        $_SESSION["csrf_token"] = $csrf_token;
        $text.="\n\t".'<meta name="csrf-token" content="'.$csrf_token.'">';

        if ($this->ogBaslik != ""){
            $text.="\n\t".'<meta property="og:title" content="'.$this->ogBaslik.'">';
        }

        if ($this->ogUrl != ""){
            $text.="\n\t".'<meta property="og:url" content="'.$this->ogUrl.'">';
        }

        if ($this->ogDescription != ""){
            $text.="\n\t".'<meta property="og:description" content="'.$this->ogDescription.'">';
        }

        if ($this->ogResim != ""){
            $text.="\n\t".'<meta property="og:image" content="'.$this->ogResim.'">';
        }

        if ($this->ogWidth != ""){
            $text.="\n\t".'<meta property="og:image:width" content="'.$this->ogWidth.'">';
        }

        if ($this->ogHeight != ""){
            $text.="\n\t".'<meta property="og:image:height" content="'.$this->ogHeight.'">';
        }

        $text.="\n\n\t".'<meta name="twitter:card" content="summary">';

        if ($this->ogBaslik != ""){
            $text."\n\t".'<meta name="twitter:site" content="'.$this->ayarlar("title_tr").'">';
            $text.="\n\t".'<meta name="twitter:title" content="'.$this->ogBaslik.'">';
        }

        if ($this->ogUrl != ""){
            @$text.="\n\t".'<meta name="twitter:url" content="'.$this->ogUrl.'">';
        }

        if ($this->ogResim != ""){
            $text.="\n\t".'<meta name="twitter:image" content="'.$this->ogResim.'" />';
        }

       
        return $text;
    }

    /**
     * @return string
     */



    public function getAnalytics(){
        if ($this->ayarlar("sayac") != "") {
            $text = '<script async src="https://www.googletagmanager.com/gtag/js?id='.$this->ayarlar("sayac").'"></script>';
            $text .= "<script>";
            $text.="
            window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '".$this->ayarlar("sayac")."');
            ";
            $text.="</script>\n";
            return $text;
        }
    }


    /**
     * @param $type
     * @param array $array
     */

    public function inc_file($type, $array = array()){

        $page  = $this->pageName;
        $lang  = $this->pageLang;


        if (is_array($array)){
            foreach ($array as $key) {
                if (is_array($key)){

                    $server = strpos($key["0"], "http");
                    $url = ($server !== false) ? "" : $this->themeURL;
                    $par = explode(",",$key[1]);
                    $i=0;

                    foreach ($par as $p) {
                        $par[$i] = $this->lang->link($par[$i]);
                        $i++;
                    }

                    if (in_array($page, $par)){

                        $version = "";
                        if (file_exists(str_replace("index.php", "",$_SERVER['SCRIPT_FILENAME']).'view/'.$this->theme."assets/".$key)){
                            $mtime = filemtime(str_replace("index.php", "",$_SERVER['SCRIPT_FILENAME'] ).'view/'.$this->theme."assets/".$key);
                            $version = "?v=".$mtime;
                        }

                        if ($type == "script"){
                            echo "\t".'<script charset="UTF-8" type="text/javascript" src="'.$url.$key[0].$version.'"></script>'."\n";
                        }

                        if ($type == "css"){
                            echo "\t".'<link href="'.$url.$key[0].$version.'" rel="stylesheet" type="text/css" media="all">'."\n";
                        }

                    }

                }


                else {

                    $server = strpos($key, "http");
                    $url = ($server !== false) ? "" : $this->themeURL;
                    $version = "";
                    if (file_exists(str_replace("index.php", "",$_SERVER['SCRIPT_FILENAME']).'view/'.$this->theme."assets/".$key)){
                        $mtime = filemtime(str_replace("index.php", "",$_SERVER['SCRIPT_FILENAME'] ).'view/'.$this->theme."assets/".$key);
                        $version = "?v=".$mtime;
                    }

                    if ($type == "script"){
                        echo "\t".'<script charset="UTF-8" type="text/javascript" src="'.$url.$key.$version.'"></script>'."\n";
                    }

                    if ($type == "css"){
                        echo "\t".'<link href="'.$url.$key.$version.'" rel="stylesheet" type="text/css" media="all">'."\n";
                    }

                }
            }
        }

    }


    /**
     * @param $url
     */
    public function MoveNewURL($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
    }

    /**
     * @param $url
     */
    public function RedirectURL($url)
    {
        header('location:' . $url);
    }

    /**
     * @param $resimler
     * @return mixed
     */
    public function aktifbul($resimler)
    {
        if (is_array($resimler))
            foreach ($resimler as $item):
                if ($item['aktif']) {
                    return $item;
                    break;
                }
            endforeach;
    }

    /**
     *
     */

    /**
     * @param $ay
     * @param int $tur
     * @return mixed
     */
    public function aylar($ay, $tur = 3)
    {
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";

        switch ($tur):
            case 1 :
                $aylartr = array('Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara');
                $aylaren = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                break;
            case 2 :
                $aylartr = array('OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKİ', 'KAS', 'ARA');
                $aylaren = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
                break;
            case 3 :
                $aylartr = array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık');
                $aylaren = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                break;
            case 4 :
                $aylartr = array('OCAK', 'ŞUBAT', 'MART', 'NİSAN', 'MAYIS', 'HAZİRAN', 'TEMMUZ', 'AĞUSTOS', 'EYLÜL', 'EKİM', 'KASIM', 'ARALIK');
                $aylaren = array("JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
                break;
        endswitch;

        if ($lang == "tr"){
            if (is_numeric($ay)) return $aylartr[$ay - 1];
        }

        if ($lang == "en"){
            if (is_numeric($ay)) return $aylaren[$ay - 1];
        }



    }

    /**
     * @param $ay
     * @return mixed
     */
    public function gunler($ay)
    {
        $aylar = array('PAZAR', 'PAZARTESİ', 'SALI', 'ÇARŞAMBA', 'PERŞEMBE', 'CUMA', 'CUMARTESİ');

        if (is_numeric($ay)) return $aylar[$ay];

    }

    /**
     * @param $tel
     * @return mixed
     */
    public function cleanChars($tel)
    {
        $find = array("(", ")", "*", ";", "?", "'", "<", ">", "\"");
        $str = str_replace($find, "", $tel);
        return $str;
    }

    /**
     * @param $string
     * @return bool
     */
    public static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }





    /**
     * @param $sifre
     * @return string
     */
    public function sifrele($sifre){
        $password = 'vmdygfb9876';
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return base64_encode(openssl_encrypt($sifre, $method, $password, OPENSSL_RAW_DATA, $iv));
    }

    /**
     * @param $sifreliVeri
     * @return string
     */
    public function sifreCoz($sifreliVeri){
        $password = 'vmdygfb9876';
        $method = 'aes-256-cbc';
        $password = substr(hash('sha256', $password, true), 0, 32);

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return openssl_decrypt(base64_decode($sifreliVeri), $method, $password, OPENSSL_RAW_DATA, $iv);
    }


    /**
     * @param $data
     */
    public function varDump($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }


    /**
     * @return bool
     */
    public function isLoginUser(){
        return (isset($_SESSION["loginUser"]) && $_SESSION["loginUser"] != "") ? true : false;
    }


    /**
     * @return bool|string
     */
    public function getLoginUserId(){
        if ($this->isLoginUser()){
            return $this->sifreCoz($_SESSION["loginUser"]);
        }
        return false;
    }


    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserName($user_id){
        $veri = $this->tekSorgu("SELECT * FROM uyeler WHERE id = $user_id");
        return ($veri["unvan"] != "") ? $veri["unvan"] : $veri["adi"];
    }


    /**
     * @param $user_id
     * @param $param
     * @return mixed
     */
    public function getUserInfo($user_id, $param){
        $veri = $this->tekSorgu("SELECT * FROM uyeler WHERE id = $user_id");
        return $veri[$param];
    }

    /**
     * @param $kurs_id
     * @return bool
     */
    public function satisGuncelle($kurs_id){

        $kurs = $this->tekSorgu("SELECT * FROM kurslar WHERE id = $kurs_id");
        $kursiyer = $this->sorgu("
            SELECT
            kursiyerler.id as kursiyer_id,
            siparis.type
            FROM
            kursiyerler
            INNER JOIN siparis ON kursiyerler.siparis_id = siparis.id
            WHERE  siparis.kurs_id = ".$kurs_id." and siparis.type = 'success' and siparis.iptal <> 1 and kursiyerler.sil <> 1
        ");

        if (!empty($kursiyer)){

            $toplam = count($kursiyer);

            if ($kurs["kontenjan"] > $kurs["satis"] ){
                return $this->update("kurslar", array("satis"=>$toplam), $kurs_id);
            }
            else {
                return false;
            }
        }
        else {
            return $this->update("kurslar", array("satis"=>0), $kurs_id);
        }
    }


    /**
     * @param $baslangic_tarihi
     * @param $gun
     * @return false|string
     */
    public function siparisBaslangic($baslangic_tarihi, $gun){
        $date = strtotime("-".$gun." days", strtotime($baslangic_tarihi));
        return  date("Y-m-d H:i:s", $date);
    }


    /**
     * @param $user_id
     * @return string
     */
    public function getUserType($user_id){
        $veri = $this->tekSorgu("SELECT * FROM uyeler WHERE id = $user_id");
        return ($veri["tur"] == "2") ? "kurumsal" : "bireysel";
    }


    /**
     * @param $user_id
     * @return int|mixed
     */
    public function getCountBasket($user_id){
        $sepet = $this->tekSorgu("SELECT Count(id) as toplam FROM sepet WHERE user_id = $user_id");
        return (is_array($sepet)) ? $sepet["toplam"] : 0;
    }

    /**
     * @param $user_id
     */
    public function getCartProducts($user_id){
        $sepetim = $this->sorgu("
        SELECT
            sepet.id,
            sepet.user_id,
            sepet.urun_id,
            sepet.miktar,
            urunler.kid,
            urunler.baslik,
            urunler.fiyat
        FROM
          sepet
        INNER JOIN urunler ON urunler.id = sepet.urun_id
        WHERE
          sepet.user_id = $user_id
");

        if(is_array($sepetim)){
            $text = "";
            foreach ($sepetim as $item){
                $kat = $this->dbLangSelectRow("kategoriler", array("id"=>$item["kid"], "master_id"=>$item["kid"]), "resim");
                $resim = $this->dbResimAl($kat["resim"], "kategori", "80,54", true);
                $fiyat = "$".$this->fiyatAl($item["fiyat"]);
                $text .= <<<EOT
             <div class="media" id="basket_{$item['id']}">
                <div class="media-left media-top">
                     <img class="media-object" src="{$resim}">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{$kat['baslik']}</h4>
                    <p>Ürün Kodu : <b>{$item['baslik']}</b></p>
                    <p style=" margin-bottom: 0px !important;"> {$item['miktar']} x $fiyat</p>
                    <span class="badge removeBasket" data-id="{$item['id']}"><i class="fa fa-close"></i> </span>
                </div>
            </div>
        
EOT;
            }
            echo $text;
        }

        else {
            echo '<div class="well well-sm" style="margin-bottom: 0px">Sepetinizde Ürün Bulunamaktadır.</div>';
        }

    }


    /**
     * @param $basket_id
     */
    public function removeBasket($basket_id){
        $this->sil("DELETE from sepet WHERE id = $basket_id");
    }


    /**
     * @param $userid
     * @return float|int
     */
    public function basketTotalPrice($userid){
        (int)$genel_toplam = 0;

        $sepetim = $this->sorgu("
            SELECT
                sepet.id,
                sepet.user_id,
                sepet.urun_id,
                sepet.miktar,
                urunler.kid,
                urunler.baslik,
                urunler.fiyat
            FROM
              sepet
            INNER JOIN urunler ON urunler.id = sepet.urun_id
            WHERE
              sepet.user_id = $userid
        ");

        foreach ($sepetim as $sepet) {
            $urun_tutar = $sepet["fiyat"] * $sepet["miktar"];
            $genel_toplam += $urun_tutar;
        }
        return $genel_toplam;
    }


    /**
     * @return array|bool
     */
    public function siparisOlustur(){

        $userid = $this->getLoginUserId();

        if (!$userid){
            return false;
            //İŞLEMİ BİTİR
        }
        else {
            //İŞLEME BAŞLA

            $sepetim = $this->sorgu("
                SELECT
                    sepet.id,
                    sepet.user_id,
                    sepet.urun_id,
                    sepet.miktar,
                    urunler.kid,
                    urunler.baslik,
                    urunler.fiyat
                FROM
                  sepet
                INNER JOIN urunler ON urunler.id = sepet.urun_id
                WHERE
                  sepet.user_id = $userid
            ");

            $table="<table class='table table-bordered table-cart' cellspacing='0'>";
            $table.="<thead><tr bgcolor='#5e6a75'>";
            $table.="<th width='60%'>ÜRÜN ADI</th>";
            $table.="<th width='20%'>BİRİM FİYAT ($)</th>";
            $table.="<th width='10%'>MİKTAR</th>";
            $table.="<th width='10%'>TOPLAM</th>";
            $table.="</tr></thead>";

            $table.="<tbody>";

            if (is_array($sepetim)){
                (int)$total = 0;

                foreach ($sepetim as $item){
                    $kat = $this->dbLangSelectRow("kategoriler", array("id"=>$item["kid"], "master_id"=>$item["kid"]));
                    $toplam = $item["fiyat"] * $item["miktar"];
                    $ozellikler = $this->sorgu("
                            SELECT
                                paketler.id,
                                paketler.baslik,
                                paketler.kid,
                                urun_ozellikleri.detay_tr,
                                urun_ozellikleri.urun_id
                            FROM
                              paketler
                            INNER JOIN urun_ozellikleri ON paketler.id = urun_ozellikleri.ozellik_id
                            WHERE 
                              paketler.kid = ".$item["kid"]." and urun_id = ".$item["urun_id"]."
                            ORDER BY sira ASC");

                    if (is_array($ozellikler)){
                        $text = "";
                        foreach ($ozellikler as $ozellik){
                            $text.= "<b>".$this->ucwords_tr($ozellik["baslik"])."</b>: ".$ozellik["detay_tr"].", ";
                        }
                        $text = substr($text, 0, -2);
                    }



                    $table.="<tr>";
                    $table.="<td>".$this->temizle($kat["baslik"])."<br><b>Ürün Kodu:</b> ".$item["baslik"]." <span style='font-size:12px;'>(".$text.")</span></td>";
                    $table.="<td>$ ".$this->fiyatAl($item["fiyat"])."</td>";
                    $table.="<td>".$item["miktar"]."</td>";
                    $table.="<td>$ ".$this->fiyatAl($toplam)."</td>";
                    $table.="</tr>";
                    $total += $toplam;
                }

            }

            $table.="</tbody>";
            $table.="</table>";

            /*$table.='<table class="table table-bordered" style="font-size: 17px; margin-bottom: 0px">';
            $table.='<tbody><tr>';
            $table.='<td>Mesajı: <b></b>'.."</td>";
            $table.='<td class="text-right" style="background-color: #f5f5f5;">Toplam:</td>';
            $table.='<td class="text-right"><b class="basketTotalPrice">$ '.$this->fiyatAl($total).'</b></td>';
            $table.='</tr></tbody></table>';*/

            return array($table, $total);
        }
    }

    /**
     * @param $sayi
     * @return string
     */
    public function siparisNo($sayi){

        $toplamUzunluk = $this->settings->config('siparisNoUzunluk');

        $uzunluk = strlen($sayi);

        $ek = "S-";

        if ($toplamUzunluk > $uzunluk){
            $fark = $toplamUzunluk - $uzunluk;
            if ($fark > 0) {

                for ($i = 1; $i <= $fark; $i++) {
                    $ek .= "0";
                }

            }
        }

        return $ek.$sayi;
    }


    /**
     * @param $table
     * @param string $ustu
     * @return int|mixed
     */
    public function Order($table, $ustu = ""){
        $sql = ($ustu != "") ? "WHERE ustu = $ustu" : "";
        $data =  $this->teksorgu("select sira from $table $sql ORDER BY sira DESC");
        return (is_array($data)) ? $data["sira"] + 1 : 1;
    }

    /**
     * @param $errCode
     * @return array
     */
    public function getPosMessage($errCode){
        $veri =  $this->tekSorgu("SELECT * FROM banka_mesajlari WHERE error_code = '".$errCode."'");
        return array($veri["mesaj"],$veri["detay"]);
    }

    /**
     * @return mixed
     */
    public function enYakinKurs(){
        return $this->tekSorgu("SELECT 
                kurslar.*,
                k.*
                FROM 
                kurslar
                JOIN (SELECT (kontenjan - satis) AS bos, id as kid FROM kurslar) AS k ON k.kid = kurslar.id
                WHERE k.bos>0 and
                kurslar.aktif = 1 and kurslar.sil <> 1 and (kurslar.bitis >= NOW() and kurslar.baslangic >= NOW())
                ORDER BY kurslar.baslangic ASC
                LIMIT 1");
    }

    /**
     * @param $item
     * @param $sayfa
     * @return string
     *
     */
    public function getURL($item, $sayfa){
        $lang = $this->pageLang;
        if ($lang == "") $lang = "tr";
        return $this->baseURL($this->lang->link($sayfa)."/".$item["url"], $lang, 1);
    }


    /**
     * @param $tarih
     * @return false|string
     */
    public function getTarih($tarih)
    {
        return date("d.m.Y", strtotime($tarih));
    }


    /**
     * @param $tarih
     * @return string
     */
    public function gun_ay_yil($tarih){
        //return date("d", strtotime($tarih))." ".$this->aylar(date("m", strtotime($tarih)), 2)." ".date("Y", strtotime($tarih));
        return date("d", strtotime($tarih))." ".$this->aylar(date("m", strtotime($tarih)), 3)." ".date("Y", strtotime($tarih));
    }


    /**
     * @param $modul
     * @param null $custom
     * @param string $type
     * @return mixed
     */
    public function getimageinfo($modul, $custom = null, $type = "big"){
        $boyutAl = $this->getmodulinfo($modul);
        $boyut = str_replace("x", ",", $boyutAl[$type]);

        if (!empty($custom)){
            $boyut = str_replace("x", ",",$custom);
        }

        return $boyut;
    }

    /**
     * @param $title string
     * @return string
     */
    public function slideTitle($title)
    {
        $bul = array("\\");
        $dgs = array("<br>");
        return str_replace($bul, $dgs, $title);
    }



    public function modul_image_size($modul)
    {

    }

    /**
     * @param $modul
     * @return array
     */
    public function  getmodulinfo($modul){
        $dataModul = $this->tekSorgu("SELECT * FROM moduller WHERE modul = '$modul'");
        $boyutlar = $this->tekSorgu("SELECT modul_id, id as b_id, big, thumb, ek FROM boyutlar WHERE modul_id = {$dataModul["id"]}");
        $appendData = array_merge($dataModul, $boyutlar);
        return $appendData;
    }

    /**
     * @return array|bool|PDOStatement
     */
    public function slayt(){
        $lang = $this->pageLang;
        $file = "resim";
        $modul = "slayt";
        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {

            $sql = $this->dbLangSelect($modul, "aktif = 1", "resim");


            if (is_array($sql)){
                if (!empty($file)) $boyut = $this->getimageinfo($modul);

                foreach ($sql as $key=>$obj){
                    $res = $this->dbResimAl($obj[$file], $modul, $boyut, false);
                    if ($lang != "tr"){
                        if (!$res){
                            $master_id = $obj["master_id"];
                            $en = $this->tekSorgu("SELECT * FROM ".$modul."_lang WHERE master_id = $master_id and dil = 'en'");
                            $res = $this->dbResimAl($en[$file], $modul, $boyut, false);
                        }
                    }
                    $sql[$key][$file] = $res;
                }
                return $sql;
            }

            else {
                return false;
            }

        }

    }



    /**
     * @param $data_id
     * @param string $column
     * @return mixed
     */
    public function kisaca(){
        $lang = $this->pageLang;
        return $this->temizle($this->ayarlar("kisaca_".$lang));
    }

    /**
     * @return array|bool|PDOStatement
     */
    public function hizmetler(){
        $file = "resim";
        $modul = "hizmet";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", "resim", "LIMIT 4");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul);
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]     =  $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"]  =  $this->temizle($obj["baslik"]);
                    $sql[$key]["ozet"]    =  $this->temizle($obj["ozet"]);
                    $sql[$key]["url"]     =  $this->getURL($obj,$modul);
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }

    /**
     * @return array|bool|PDOStatement
     *
     */
    public function rakamlar(){
        $file = "resim";
        $modul = "rakam";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", "", "LIMIT 4");

            if (is_array($sql)){
                //$boyut = $this->getimageinfo($modul);
                foreach ($sql as $key=>$obj){
                    //$sql[$key][$file]     =  $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"]  =  str_replace("\\", "<br>", $this->temizle($obj["baslik"]));
                    $sql[$key]["rakam"]   =  $this->temizle($obj["rakam"]);
                }
                return $sql;
            }

            else {
                return false;
            }

        }

    }


    /**
     * @return array|bool|PDOStatement
     *
     */
    public function pratik(){
        $file = "resim";
        $modul = "bilgi";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1 and baslik <> ''", "resim");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "110x110");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["ozet"]   = $this->temizle($obj["ozet"]);
                    $sql[$key]["url"]    = $this->getURL($obj,$modul);
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }




    /**
     * @param null $limit
     * @return array|bool|PDOStatement
     */
    public function haberler($limit = null){
        $file = "resim";
        $modul = "haber";

        $lim = (!empty($limit)) ? "LIMIT ".$limit : "";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1 and baslik <> ''", "resim", $lim, "ORDER BY tarih DESC");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "", "thumb");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["ozet"]   = $this->temizle($obj["ozet"]);
                    $sql[$key]["url"]    = $this->getURL($obj,$modul);
                    $sql[$key]["tarih"]  = $this->gun_ay_yil($obj["tarih"]);
                    $sql[$key]["gun"]    = date("d", strtotime($obj["tarih"]));
                    $sql[$key]["ay"]    = $this->aylar(date("m", strtotime($obj["tarih"])), 3);
                    $sql[$key]["yil"]    = date("Y", strtotime($obj["tarih"]));
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }

    /***
     * @param null $limit
     * @return array|bool|PDOStatement
     *
     */
    public function blog($limit = null){
        $file = "resim";
        $modul = "blog";

        $lim = (!empty($limit)) ? "LIMIT ".$limit : "";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1 and baslik <> ''", "resim", $lim, "ORDER BY tarih DESC");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "", "thumb");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["ozet"]   = $this->temizle($obj["ozet"]);
                    $sql[$key]["url"]    = $this->getURL($obj,$modul);
                    $sql[$key]["tarih"]  = $this->gun_ay_yil($obj["tarih"]);
                    $sql[$key]["gun"]    = date("d", strtotime($obj["tarih"]));
                    $sql[$key]["ay"]    = $this->aylar(date("m", strtotime($obj["tarih"])), 3);
                    $sql[$key]["yil"]    = date("Y", strtotime($obj["tarih"]));
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }

    /**
     * @return array|bool|PDOStatement
     *
     */
    public function kampanyalar(){
        $file = "resim";
        $modul = "bilgi";


        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", "resim", "", "ORDER BY tarih DESC");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "", "big");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["url"]    = $this->getURL($obj,"kampanya");
                }
                return $sql;
            }

            else {
                return false;
            }

        }

    }


    /**
     * @return array|bool|PDOStatement
     *
     */
    public function referanslar(){
        $file = "resim";
        $modul = "hizmet";


        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", "resim", "", "ORDER BY tarih DESC");

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "", "big");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true, "", "no-ref.jpg");
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }

    /**
     * @return array|bool|PDOStatement
     */
    public function index_galeri(){
        $lang = $this->pageLang;
        $modul = "galeri";

        $modulinfo = $this->getmodulinfo($modul);

        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }

        else {
            $sql = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'galeri' and sil <> 1 and aktif = 1 ORDER BY sira ASC LIMIT 20");

            if (is_array($sql)){
                $boyut = $this->getimageinfo("galeri", "", "ek");
                foreach ($sql as $key=>$obj){
                    $sql[$key]["dosya"]  = $this->dbResimAl($obj["dosya"], $modul, $boyut, true);
                    $sql[$key]["thumb"]  = $this->dbResimAl($obj["dosya"], $modul, "0,400", true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik_".$lang]);
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }

    /**
     * @return array|bool|PDOStatement
     */
    public function projeler(){
        $file = "resim";
        $modul = "proje";


        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {

            $return = array();

            $data = $this->dbLangSelect($modul, "aktif = 1", "resim", "LIMIT 20");
            $boyut = $this->getimageinfo($modul, "", "thumb");
            $t=0;

            if (is_array($data)){
                foreach ($data as $key=>$obj){
                    $return[$t][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, false);
                    $return[$t]["b_resim"]  =  $this->dbResimAl($obj[$file], $modul, "0,1200", false);
                    $return[$t]["baslik"]   =  $this->temizle($obj["baslik"]);
                    $return[$t]["url"]      =  $this->getURL($obj, "uygulama");
                    $return[$t]["ozet"]     =  $this->temizle($obj["ozet"]);
                    $return[$t]["tarih"]    =  $this->temizle($obj["tarih"]);
                    $t++;
                }
            }


            if (is_array($return)){
                return $return;
            }

            else {
                return false;
            }
        }

    }

    /**
     * @return array|bool|PDOStatement
     *
     */
    public function urunler(){
        $file = "resim";
        $modul = "urun";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", $file);

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul);
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["ozet"]   = $this->temizle($obj["ozet"]);
                    $sql[$key]["url"]    = $this->getURL($obj,$modul);
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }


    public function reyonlar(){
        $file = "icon";
        $modul = "reyon";

        $modulinfo = $this->getmodulinfo($modul);
        if (!$modulinfo || $modulinfo["anasayfa"] != 1){
            return false;
        }
        else {
            $sql = $this->dbLangSelect($modul, "aktif = 1", $file);

            if (is_array($sql)){
                $boyut = $this->getimageinfo($modul, "", "thumb");
                foreach ($sql as $key=>$obj){
                    $sql[$key][$file]  = $this->dbResimAl($obj[$file], $modul, $boyut, true);
                    $sql[$key]["baslik"] = $this->temizle($obj["baslik"]);
                    $sql[$key]["url"]    = $this->getURL($obj,$modul);
                }
                return $sql;
            }

            else {
                return false;
            }
        }

    }



    /**
     * @return string
     */
    public function linkTelefon(){
        return "tel:".$this->telefonFormat($this->ayarlar("telefon_merkez"));
    }

    /**
     * @return string
     */
    public function linkEmail(){
        return "mailto:".$this->ayarlar("email_merkez");
    }

    public function getSocialList(){
        $text = "";
        $list = $this->settings->sosyal()["list"];

        if (is_array($list)){
            foreach ($list as $key=>$item){
                if (!empty($this->ayarlar($key))){
                    $text .= '<li>
                                <a  class="" href="' . $this->ayarlar($key) . '" target="_blank">
                                    <i class="'.$this->settings->sosyal()["frontIcons"][$key].'"></i>
                                </a>
                            </li>
                        ';
                }
            }

            return $text;
        }

    }


    public function langLink($url){
        $lang = $this->pageLang;
        return $this->baseURL($this->lang->link($url), $lang, 1);
    }


    public function getFooterCopy()
    {
        $lang = $this->pageLang;
        $bul = "%firm%";
        $dgs = '<a href="'.$this->baseURL("index", $lang, 1).'">'.$this->ayarlar("firma_$lang").'</a>';
        return str_replace($bul, $dgs, $this->lang->footer("copy"));
    }


    public function createSliderWidth($type="revolution"){
        list($wid, $heg) = explode("x", $this->getmodulinfo("slayt")["big"]);
        $heg2 = floor($heg - (($wid * 7) / 100));
        $heg3 = floor($heg - (($wid * 11) / 100));

        if ($type == "revolution") {
            echo "var slideWidth = [$wid,1200,768];\n\t\t";
            echo "var slideHeight = [$heg,$heg2,$heg3];";
        }
        if ($type == "carousel"){
            $heg4 = floor($heg - (($wid * 15) / 100));
            $heg5 = floor($heg - (($wid * 20) / 100));
            $heg6 = floor($heg - (($wid * 26) / 100));

            echo ".slideHeight{ height:".$heg."px !important"."}\n\t\t";
            echo "@media(max-width:1400px){.slideHeight{height:".$heg2."px !important; }}\n\t\t";
            echo "@media(max-width:1200px){.slideHeight{height:".$heg3."px !important; }}\n\t\t";
            echo "@media(max-width:991px){.slideHeight{height:".$heg4."px !important; }}\n\t\t";
            echo "@media(max-width:768px){.slideHeight{height:".$heg5."px !important; }}\n\t\t";
            echo "@media(max-width:576px){.slideHeight{height:".$heg6."px !important; }}\n";
        }

    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function unzip($filename, $extract_folder = "./"){
        $zip = new ZipArchive;
        $res = $zip->open($filename);
        if ($res === TRUE) {
            $zip->extractTo($extract_folder);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $domain
     * @return mixed|string
     *
     */
    public function cleanDomain($domain)
    {
        $bul = array("www.", "_", "http:", "http", "https", "https:", "/");
        $dgs = array("","");
        $text = strtolower(str_replace($bul, $dgs, $domain));
        $par = explode(".", $text);
        if (is_array($par)){
            $text = $par[0];
            $exp = explode(".", $text);
            if (is_array($exp)){
                $text = $exp[0];
            }
        }
        return $text;
    }



    /**
     * @param $tag
     * @return string
     *
     */
    public function cleanTag($tag)
    {
        $find = array(" ", "\"", "'", "\\", "?", "{", "}", "[", "]", "%", "#");
        $replace = array("+", "", "", "", "", "", "", "", "", "", "");
        return str_replace($find, $replace, $tag);
    }

    /**
     * @param $tag
     * @return string
     *
     */
    public function decodeTag($tag)
    {
        $find = array("+");
        $replace = array(" ");
        return str_replace($find, $replace, $tag);
    }

    public function getIp(){
        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
    }


    public function jsontoarray($json_data)
    {
        if (!empty($json_data)){
            return  json_decode($json_data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function RecaptchaValidate($recaptcha_post)
    {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $this->getSecretKey();

        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_post);
        $recaptcha = json_decode($recaptcha);
        if ($recaptcha->score >= 0.5) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @return string
     */
    public function navigationTo()
    {
        return "https://www.google.com.tr/maps/dir//".$this->ayarlar("koordinat_merkez")."/@40.990906,29.027866,17z/data=!3m1!4b1";
    }

    public function proje_durum($durum)
    {
        return ($durum == 1) ? "Devam Eden Proje" : "Tamamlanan Proje";
    }




    
    /* multiple menu */

    function has_children($rows,$id){
        foreach ($rows as $row) {
            if ($row['ustu'] == $id) {
                return true;
            }
        }
        return false;
    }

    function multipleSubmenu($ustu = 0, $langUrl, $active, $active_2 = null) {
        $lang = $this->pageLang;
        $rows = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> ''");
        $result = '';


        /* yeni */

        $mid = ($lang != "tr") ? "master_" : "";
        foreach ($rows as $row) {


            if ($row['ustu'] == $ustu) {
                if ($this->has_children($rows, $row[$mid.'id'])) {
                    $result .= '<li><a href="#" class="dropdown '.(($row['url'] == $active) ? " active " : "").((!empty($active_2) && $row['url'] == $active_2) ? ' active ' : '').'">'.$row["baslik"].'
                        <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                <ul class="submenu">';
                    $result .= $this->multipleSubmenu($row[$mid.'id'], $langUrl, $active, $active_2);
                    $result .= "</ul></li>";
                  //  var_dump($row); die;
                }else{
                    $url = $this->baseURL($langUrl."/".$row["url"], $lang, 1);
                  /* var_dump($row); */
                  /*  var_dump($active_2); */

                     
                        $result .= '<li><a class="'.(($row['url'] == $active) ? "active" : "").((!empty($active_2) && $row['id'] == $active_2) ? ' active ' : '').'" href="'.$url.'">'.$row["baslik"].'</a></li>';
                   
             
                
                }
            }






        }
        return $result;
    }

    /* # multiple menu */



    /* multiple menu */

  /*
    function has_children($rows,$id){
        foreach ($rows as $row) {
            if ($row['ustu'] == $id) {
                return true;
            }
        }
        return false;
    }

    function multipleSubmenu($ustu = 0, $langUrl, $active, $active_2 = null) {
        $lang = $this->pageLang;
        $rows = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> ''");
        $result = '';
        $mid = ($lang != "tr") ? "master_" : "";
        foreach ($rows as $row) {
            if ($row['ustu'] == $ustu) {
                if ($this->has_children($rows, $row[$mid.'id'])) {
                    $result .= '<li><a href="#" class="dropdown '.(($row['url'] == $active) ? " active " : "").((!empty($active_2) && $row['url'] == $active_2) ? ' active ' : '').'">'.$row["baslik"].'
                        <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                <ul class="submenu">';
                    $result .= $this->multipleSubmenu($row[$mid.'id'], $langUrl, $active, $active_2);
                    $result .= "</ul></li>";
                }else{
                    $url = $this->baseURL($langUrl."/".$row["url"], $lang, 1);
                    $result .= '<li><a class="'.(($row['url'] == $active) ? "active" : "").((!empty($active_2) && $row['url'] == $active_2) ? ' active ' : '').'" href="'.$url.'">'.$row["baslik"].'</a></li>';
                }
            }
        }
        return $result;
    }
    */





        
    /* multiple menu */

    function has_children_ikinciel($rows,$id){
        foreach ($rows as $row) {
            if ($row['ustu'] == $id) {
                return true;
            }
        }
        return false;
    }

    function multipleSubmenu_ikinciel($ustu = 0, $langUrl, $active, $active_2 = null) {
        $lang = $this->pageLang;
        $rows = $this->dbLangSelect("ikinciel_kategori", "aktif = 1 and baslik <> ''");
        /* bossa gelmesin */
        $rows_urun = $this->dbLangSelect("ikinciel", "aktif = 1 and baslik <> ''");
        /* #bossa gelmesin */

        $result = '';


        /* yeni */

        $mid = ($lang != "tr") ? "master_" : "";
        foreach ($rows as $row) {


            if ($row['ustu'] == $ustu) {
                if ($this->has_children_ikinciel($rows, $row[$mid.'id'])) {
                    $result .= '<li><a href="#" class="dropdown '.(($row['url'] == $active) ? " active " : "").((!empty($active_2) && $row['url'] == $active_2) ? ' active ' : '').'">'.$row["baslik"].'
                        <span style="float: right;" class="caret fa fa-angle-down"></span></a>
                <ul class="submenu">';
                    $result .= $this->multipleSubmenu_ikinciel($row[$mid.'id'], $langUrl, $active, $active_2);
                    $result .= "</ul></li>";
                  //  var_dump($row); die;
                }else{
                    $url = $this->baseURL($langUrl."/".$row["url"], $lang, 1);
                  /* var_dump($row); */
                  /*  var_dump($active_2); */

                 
                        $urun = $this->dbLangSelectRow('ikinciel', ['kid'=>$row['id']]);   
                       // $result .= '<li><a class="'.(($row['url'] == $active) ? "active" : "").((!empty($active_2) && $row['id'] == $active_2) ? ' active ' : '').'" href="'.$url.'">'.$row["baslik"].'</a></li>';
                    if(is_array($urun)){
                        $result .= '<li><a class="'.(($row['url'] == $active) ? "active" : "").((!empty($active_2) && $row['id'] == $active_2) ? ' active ' : '').'" href="'.$url.'">'.$row["baslik"].'</a></li>';
                    } 
                
                
                }
            }






        }
        return $result;
    }

    /* # multiple menu */




    

}


