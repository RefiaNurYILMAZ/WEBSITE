<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */
?>
<?php
$kurumsal  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 1");
$kariyer  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 2");
$policies  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 3");
$uretim  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 4");
$urunler  = $this->dbLangSelect("urun","aktif = 1 and baslik <> ''");
$q = $this->kucuk_yap($this->koru(Request::GETURL('q', null)));






/* kategori */

//$kategori = $this->dbLangSelect("urun", "aktif = 1 and baslik <> '' ", "resim", "");


$kategori = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> '' and ustu=0 and sil=0", "resim", "");




$kategori_alt = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> ''  and ustu != 0 ", "resim", "");

?>

<? //var_dump($kategori); die;  ?>


<div id="loading-area" class="loading-page-3">
	<div class="loading-inner">
		<div class="loader"><div class="circle"></div></div>
		<div class="loader"><div class="circle"></div></div>
	</div>
</div>
<div class="page-wraper"> 


		<!-- Üst menu -->

		<div class="top-bar">
			<div class="container-fluid">
				<div class="d-flex justify-content-center align-items-center">
					<div class="dz-topbar-center">
						<p class="help-text"><strong><?=$this->lang->header('telefon')?> :</strong> <?=$this->ayarlar("telefon_merkez")?> </p>
					</div>
				</div>
			</div>
		</div>


		<!-- #Üst Menu -->
		
	
		
		<!-- Main Header -->
		<div class="sticky-header main-bar-wraper navbar-expand-lg">
			<div class="main-bar clearfix ">
				<div class="container-fluid clearfix">


					<!-- Logo -->
					<div class="logo-header mostion logo-white">
						<a href="<?=$this->langLink("index")?>"><img src="<?=$assetURL?>img/ozteknik_logo_ve_katalog_deneme-01.svg" alt=""></a>
					</div>
					<!-- #Logo -->



					<!-- Nav Toggle Button -->
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>

					<div class="extra-nav">
						<div class="extra-cell">
							<div class="search-inhead">
								<div class="dz-quik-search On">
									<form action="<?=$this->baseURL('search')?>" class="search-form">
										<input value="<?=((!empty($q)) ? $q : '')?>" name="q"  required  minlength="3" type="text" class="form-control" placeholder="<?=$this->lang->iletisim('arama')?>">
										<span id="quik-search-remove"><i class="ti-close"></i></span>
										<button class="search-link" id="quik-search-btn" type="submit">
											<i class="fas fa-search"></i>
										</button>
									</form>
								</div>
							
							</div>
							<a href="javascript:void(0);" class="btn btn-secondary d-xl-inline-block d-none btn-border btn-border-secondary m-r10 m-b10"><?=$this->lang->header('e-katalog')?></a>
						</div>
					</div>
					<!-- Extra Nav -->

					
					<div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
						<div class="logo-header logo-dark">
							<a href="<?=$this->langLink("index")?>"><img src="<?=$assetURL?>img/ozteknik_logo_ve_katalog_deneme-01.svg" alt=""></a>
						</div>




						<ul class="nav navbar-nav navbar navbar-left">	
	

							<?php
							$this->langHeaderMenu(array(
								[ "sayfa" => "index", ],

								[
									"sayfa" => "kurumsal",
									"alt" => $kurumsal,
									'table'=>"sayfa",
									"alt_sayfa" => array("kurumsal", "baslik"),
								],


								[
									"sayfa" => "urunler",
									"alt" => $kategori,
									'table'=>"sayfa",
									"alt_sayfa" => array("urunkat", "baslik"),
									"disable_url"=>true,
									/*'icon'=>'fa fa-chevron-down',*/ 	
								],



								[ "sayfa" => "foto-galeri" ],


								[ "sayfa" => "video-galeri" ],


								[ "sayfa" => "iletisim" ]
							));
							?>



							<!-- dil -->

							<li class="dil">

								<? if ($key != $lang):?>

									<a href="<?=$this->baseURL("index", ($lang == "en") ? "tr" : "en", 1)?>" class="get-in-touch-btn from-top " ><i class="fa fa-globe-americas"></i> <?=($lang == "tr") ? "EN" : "TR"?></a>

								<? endif; ?>

							</li>

							<!-- #dil -->



						</ul>





						
						<!-- Menu  -->

						<ul  style="display:none" class="nav navbar-nav navbar navbar-left">	



							<li class="sub-menu"><a href="javascript:void(0);"><span>ANASAYFA</span></a></li>


							<li class="sub-menu-down"><a href="javascript:void(0);"><span>KURUMSAL</span></a>
								<ul class="sub-menu">
									<li><a href="javascript:void(0)">Hakkımızda</a></li>
									<li><a href="javascript:void(0)">Vizyon - Misyon</a></li>
								
								</ul>
							</li>


							<li class="sub-menu-down"><a href="javascript:void(0);"><span>ÜRÜNLERİMİZ</span></a>
								<ul class="sub-menu">
									<li><a href="javascript:void(0)">Ürün 1</a></li>
									<li><a href="javascript:void(0)">Ürün 2</a></li>
								
								</ul>
							</li>

							<li class="sub-menu"><a href="javascript:void(0);"><span>FOTO GALERİ</span></a></li>

							<li class="sub-menu"><a href="javascript:void(0);"><span>VİDEO GALERİ</span></a></li>

							<li class="sub-menu"><a href="javascript:void(0);"><span>İLETİŞİM</span></a></li>


				
						</ul>
						<!-- #Menu -->



						<!-- Sosyal -->

						<div class="dz-social-icon">
							<ul>
								<li><a class="fab fa-facebook-f" href="https://www.facebook.com/"></a></li>
								<li><a class="fab fa-twitter" href="https://twitter.com/?lang=en"></a></li>
								<li><a class="fab fa-linkedin-in" href="https://www.linkedin.com/"></a></li>
								<li><a class="fab fa-instagram" href="https://www.instagram.com/?hl=en"></a></li>
							</ul>
						</div>

						<!-- #Sosyal -->


					</div>



				</div>
			</div>
		</div>
		<!-- Main Header End -->
	</header>
	
</div>





