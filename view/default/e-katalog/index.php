<?
/* @var $this FrontClass|Loader object */
header('Content-Type: text/html; charset=utf-8');
$data = $this->dbLangSelectRow("katalog", array("id"=>$id, "master_id"=>$id));


$data2= $this->dbLangSelectRow("ikincielekatalog", array("id"=>$id, "master_id"=>$id));  
?>
<!DOCTYPE html>
<html>
<head lang="tr">
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?=$this->ayarlar("title_".$lang)?> - <?=$this->temizle($data["baslik"])?></title>

	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">

  <link href="<?=$this->katalogURL?>css/dflip.css?v=5" rel="stylesheet" type="text/css">
  <link href="<?=$this->katalogURL?>css/themify-icons.css" rel="stylesheet" type="text/css">


  <style>
    #df_book_full {
      height: 100vh;
    }
    @media all and ( max-width: 1000px ) {
      #df_book_full {
        height: calc(100vh - 60px);
      }
    }
    html, body {
      height: 100%;
		margin:0;
    }

    .ti-menu-alt{
        display: none;
    }

    .df-ui-btnci {
        display:none;
    }

	body {font-family:Tahoma, Geneva, sans-serif; color:#044481;}
	#df_book_full {height:100%; min-height:100%;}

	@media only screen and (max-width: 640px) {
		#logo div {width:50%; text-align:right; top:5px; font-size:10px; line-height:14px;}
		.df-ui-controls {height:auto;}
	}
	  #viewer {display:none;}
	  @media only screen and (max-width: 1024px) {
		  #viewer {display:block;}
	  }
  </style>
  
</head>
<body>


<div class="_df_book" id="df_book_full"></div>
<div id="viewer"></div>
<script>
    var assetURL = "<?=$this->katalogURL?>";
</script>
<script src="<?=$this->katalogURL?>js/jquery.min.js" type="text/javascript"></script>
<script>
<?
    for ($i=1; $i<=18; $i++){
        echo "var t".$i." = '".$this->lang->katalog("t".$i)."';\n";
    }
?>

</script>
<script src="<?=$this->katalogURL?>js/dflip_tr.js" type="text/javascript"></script>

<script>


<?
    $katalog = $this->teksorgu("SELECT * FROM dosyalar WHERE type='katalog' and tur = 'dosya' and data_id = $id ORDER BY sira, id ASC");

 //    $katalog = $this->teksorgu("SELECT * FROM dosyalar WHERE type='katalog' and tur = 'dosya' and data_id = $id ORDER BY sira, id ASC");
?>


var winWidth = $(window).width();

if (winWidth <= 1024){
    var option_df_book_full = {
        source: "<?=$this->baseURL("upload")?>/katalog/<?=$katalog["dosya"]?>?" + Math.random(),
        hard: "cover",
        webgl: false,
        pageMode: DFLIP.PAGE_MODE.SINGLE
        //singlePageMode: DFLIP.SINGLE_PAGE_MODE.ZOOM

    };
}else {
    var option_df_book_full = {
        source: "<?=$this->baseURL("upload")?>/katalog/<?=$katalog["dosya"]?>?" + Math.random(),
        hard: "cover",
        webgl: false,
        pageMode: DFLIP.PAGE_MODE.DOUBLE
        //singlePageMode: DFLIP.SINGLE_PAGE_MODE.ZOOM
    };
}


</script>
</body>
</html>