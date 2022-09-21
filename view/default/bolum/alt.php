<?php /**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */ ?>
<?php
    $kurumsal  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 1", "", "LIMIT 6");
    $urunler  = $this->dbLangSelect("urun","aktif = 1 and baslik <> ''", "", "LIMIT 6");


	$haberler = $this->dbLangSelect("haber", "aktif = 1 and baslik <> ''", "resim", "LIMIT 2");
?>













	<!-- Footer -->
    <footer class="site-footer style-3 bg-secondary" id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-sm-8 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
						<div class="widget widget_about">

							<!-- Logo -->
							<div class="footer-logo logo-white">
								<a href="<?=$this->langLink("index")?>"><img src="<?=$assetURL?>img/ozteknik_logo_ve_katalog_deneme-01_White.svg" alt=""/></a> 
							</div>
							<!-- 'Logo -->


							<div class="widget widget_getintuch">
								<ul>
									<li>
										<i class="flaticon-placeholder"></i>
										<span><?=$this->ayarlar("adres_merkez")?></span>
									</li>
									<li>
										<i class="flaticon-call"></i>
										<span><?=$this->ayarlar("telefon_merkez")?></span>
									</li>
									<li>
										<i class="flaticon-chat-1"></i> 
										<span> <a> <?=$this->ayarlar("email_merkez")?></a></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-sm-4 col-6 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
						<div class="widget widget_services">
							<h4 class="footer-title"> <?=$this->lang->header('hizli')?></h4>
							<ul>
								<li><a href="<?=$this->langLink("index")?>"><?=$this->lang->header('index')?></a></li>
								<li><a href="<?=$this->langLink("kurumsal")?>"><?=$this->lang->header('kurumsal')?></a></li>
								<li><a href="<?=$this->langLink("urunler")?>"><?=$this->lang->header('urunler')?></a></li>
								<li><a href="<?=$this->langLink("haberler")?>"><?=$this->lang->header('haberler')?></a></li>
								<li><a href="<?=$this->langLink("iletisim")?>"><?=$this->lang->header('iletisim')?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-sm-4 col-6 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
						<div class="widget widget_services">
							<h4 class="footer-title"><?=$this->lang->header('dokuman')?></h4>
							<ul>
								<li><a href="javascript:void(0);"> <?=$this->lang->header('kullanim')?></a></li>
								<li><a href="javascript:void(0);"><?=$this->lang->header('sert')?></a></li>
								<li><a href="javascript:void(0);"><?=$this->lang->header('e-katalog')?></a></li>
								<li><a href="javascript:void(0);"> <?=$this->lang->header('teklif')?></a></li>

							</ul>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-sm-8 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
						<div class="widget recent-posts-entry">
							<h4 class="footer-title"><?=$this->lang->header('haberler')?></h4>
							<div class="widget-post-bx">


							
								<?
								foreach ($haberler as $item) {
										$haber_resim = $this->dbResimAl($item["resim"], "haber", "90x90", true);
										$url = $this->baseURL("haber/".$item["url"], $lang, 1);

								?>


								<div class="widget-post clearfix">
									<div class="dz-media"> 
										<img src="<?=$haber_resim?>" alt="">
									</div>
									<div class="dz-info">
										<h6 class="title"><a href="javascript::0"><?=$item['baslik']?></a></h6>
										<div class="dz-meta">
											<ul>
												<li class="post-date"> <i class="las la-calendar"></i> <?=$item['tarih']?> </li>
											</ul>
										</div>
									</div>
								</div>

								<? } ?>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer bottom part -->

	</footer>
    <!-- Footer End -->
	<button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>
	
</div>












