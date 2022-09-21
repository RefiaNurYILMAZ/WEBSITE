<?php /**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */ ?>
<?
$slayt = $this->slayt();


$haberler = $this->haberler(3);
$galeri = $this->index_galeri();
$urunler  = $this->dbLangSelect("urun", "aktif = 1  and baslik <> ''", "resim", "LIMIT 20");
$sss = $this->dbLangSelect("sorular","aktif = 1 and baslik <> ''", "", "LIMIT 10");
$rakamlar = $this->dbLangSelect("rakam", "aktif = 1 and baslik <> ''", "resim", "LIMIT 4");

$referanslar = $this->dbLangSelect("referans", "aktif = 1 and baslik <> ''", "resim", "");


?>



	
<div class="page-content bg-white">





        <!-- Slider Start -->
        <?php if ($slayt):?>

			<div class="main-slider3">
				<div class="swiper-container main-swiper3 banner-inner">
					<div class="swiper-wrapper">


					<?  
                        foreach ($slayt as $item){
                        ?>
                            

                            <div class="swiper-slide overlay-black-middle" style="background-image: url(<?=$item['resim']?>); background-size: cover;">
                                <div class="banner-content container">
                                    <div class="row">
                                        <div class="col-lg-9">


                                            <? if ($item["baslik"] != ""){?>
                                                <h1 class="title" data-swiper-parallax="-500"><?=$this->temizle($item["baslik"])?> </h1>
                                            <? } ?>

                                            <? if ($item["baslik2"] != ""){?>
                                                <p data-swiper-parallax="-1000"><?=$this->temizle($item["baslik2"])?></p>
                                            <? } ?>

                                           

                                            <? if ($item["button"] != ""){?>
                                                <div data-swiper-parallax="-1500">
                                                    <a href="<?=$item["link"]?>" class="btn btn-primary btn-border btn-border-white m-r10 m-b10"><?=$item["button"]?></a>
                                                </div>
                                            <? } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <? }  ?>
					</div>
				</div>

				<div class="swiper-container slider-thumbs-wraper main-swiper-thumb3">
					<div class="swiper-wrapper">
						
					<?  
                        foreach ($slayt as $item){
                            //$small_resim = $this->dbResimAl($item["resim"], "slayt", "180x90", true);
                        ?>
					
						<div class="swiper-slide">
							<div class="slider-thumbs">
								<div class="dz-media">
									<img src="<?=$item["resim"]?>" alt="">
								</div>
								<div class="dz-info">
									<h4 class="title"><?=$this->temizle($item["baslik"])?></h4>
								</div>
							</div>
						</div>
						
						<? }  ?>

					</div>
				</div>
			</div>

			

        
        
                <?php endif; ?>
        <!-- #Slider End -->







        <!-- Hakkimizda   $ Ürünler  -->
 

        <section class="content-inner-1" style="background-image:url('<?=$assetURL?>img/bg9.jpg');background-size: cover;background-position: top;">
			<div class="container">

				<!-- Hakkimizda-->
					<section class="content-inner bg-gray bg-particles" id="particles-js">
						<div class="container">
							<div class="row about-style3 align-items-center">
								<div class="col-lg-6 m-b30 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
									<div class="about-thumb">
										<div class="about-video overlay-white-light">
											<img class="w-100" src="<?=$assetURL?>img/1.jpg" alt="">
										</div>
									</div>
								</div>
								<div class="col-lg-6 m-b30 aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
									<div class="about-content">
										<div class="section-head style-1">
											<h2 class="title m-b20"><?=$this->lang->header('kurumsal')?></h2>
											<p><?=$this->lang->genel('bizkimiz')?></p>
										</div>
										<ul class="list-arrow-right-circle white m-b40">
                                            <?=$this->kisaca()?>
										</ul>


										<a href="<?=$this->langLink("kurumsal")?>" class="btn btn-primary btn-border m-r10 m-b10"><?=$this->lang->genel('devami')?></a>
									</div>
								</div>
							</div>
						</div>
					</section>	
				<!--  #Hakkimizda-->



				<!-- Ürünler-->

                <?php if ($urunler): ?>
					<div class="section-head style-1 mt-5">
						<h2 class="title"><?=$this->lang->header('urunler')?></h2>
					</div>

					<div class="swiper-container content-slider">
						<div class="swiper-wrapper">

                        <?
                            foreach ($urunler as $item) {
                                    $kategori_resim = $this->dbResimAl($item["resim"], "urun", "300x300", true);
                                    $url = $this->baseURL("urunkat/".$item["url"], $lang, 1);

                        ?>
							<div class="swiper-slide aos-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
								<div class="content-box2 overlay-shine">
									<div class="dz-info">
										<h3 class="title"><?=$item['baslik']?></h3>
									</div>
									<div class="dz-media m-b30">
										<img src="<?=$kategori_resim?>" alt="">
									</div>
									<div class="dz-bottom">
										<a href="<?=$url?>" class="btn-link"><?=$this->lang->genel('fazla')?> <i class="fas fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

                            <? } ?>

						</div>
						<div class="swiper-pagination-content m-t30 swiper-pagination text-center"></div>
					</div>	

                <?php endif; ?>
				<!-- #Ürünler-->

			</div>
		</section>


       <!-- #Hakkimizda   $ Ürünler  -->

        









       	<!-- Rakamlar -->

        <?php if ($rakamlar): ?>    



            <section class="content-inner bg-gray">
                <div class="container">
                    <div class="row">


                    <?
                    foreach ($rakamlar as $item) {
                    ?>

                        <div class="col-lg-3 m-b30 aos-item aos-init aos-animate" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                            <div class="check-box box-hover active">
                                <h4 class="title"><?=$item['baslik']?></h4>
                            </div>
                        </div>

                     <? } ?>


                    </div>
                </div>
            </section>



        <?php endif; ?>
		<!-- #Rakamlar -->











        		<!--  Destek -->



		<section class="content-inner-1 service-wrapper" style="background-image:url('<?=$assetURL?>img/bg6.jpg');background-size:cover;background-position:top;">
			<div class="container">
				<div class="service-box">
					<div class="row align-items-center">


						<div class="col-lg-12 m-b30 aos-item aos-init aos-animate" data-aos="zoom-out" data-aos-duration="800" data-aos-delay="400">
							<div class="section-head style-1">
								<h3 class="title m-b20"> <?=$this->lang->genel('kilav')?> </h3>
							</div>
						</div>


						<div class="col-lg-12 aos-item aos-init aos-animate" data-aos="zoom-out" data-aos-duration="800" data-aos-delay="800">



							<div class="row">

								<div class="col-lg-6">
									<a href="<?=$this->langLink("documents")?>">								
										<div class="icon-bx-wraper left style-3 m-b20">
											<div class="icon-lg text-primary"> 
												<span class="icon-cell"><i class="flaticon-information"></i></span>
											</div>
											<div class="icon-content">
												<h4 class="dz-title">   <?=$this->lang->genel('kilavuz')?>  </h4>
											</div>
										</div>	
									</a>
								</div>


								<div class="col-lg-6">
									<a href="<?=$this->baseURL("documents/e-katalog-2", $lang, 1)?>">
										<div class="icon-bx-wraper left style-3 m-b20">
											<div class="icon-lg text-primary"> 
												<span class="icon-cell"><i class="flaticon-exit"></i></span>
											</div>
											<div class="icon-content">
												<h4 class="dz-title">  <?=$this->lang->header('katalog')?> </h4>
											</div>
										</div>
									</a>
								</div>


								<div class="col-lg-6">
									<a href="<?=$this->baseURL("documents/certificates-3", $lang, 1)?>">
										<div class="icon-bx-wraper left style-3 m-b20">
											<div class="icon-lg text-primary"> 
												<span class="icon-cell"><i class="flaticon-file"></i></span>
											</div>
											<div class="icon-content">
												<h4 class="dz-title">  <?=$this->lang->genel('sertifika')?> </h4>
											</div>
										</div>
									</a>
								</div>


								<div class="col-lg-6">
									<div class="icon-bx-wraper left style-3 m-b20">
										<div class="icon-lg text-primary"> 
											<span class="icon-cell"><i class="flaticon-notebook"></i></span>
										</div>
										<div class="icon-content">
											<h4 class="dz-title"> <?=$this->lang->header('teklif')?>  </h4>
										</div>
									</div>
								</div>
								
							</div>
							

						</div>

						
					</div>
				</div>
			</div>
		</section>


		<!-- #Destek -->







            <!-- News Start -->
            <?php if ($haberler): ?>

                <section class="content-inner">
                        <div class="container">
                            <div class="clearfix">
                                <ul  class="row blog-masonry">


                                    <div class="section-head style-1">
                                        <h2 class="title"> <?=$this->lang->header('haberler')?> </h2>
                                    </div>


                                    <? foreach ($haberler as $item): ?>


                                        <li class="card-container grid-item col-xl-4 col-md-6">
                                            <div class="dz-card style-1 shadow m-b30">
                                                <div class="dz-media">
                                                    <a href="<?=$item['url']?>"><img src="<?=$item["resim"]?>" alt=""></a>
                                                </div>
                                                <div class="dz-info">
                                                    <div class="dz-meta">
                                                        <ul>
                                                            <li class="post-date"><?=$item["tarih"]?></li>
                                                        </ul>
                                                    </div>
                                                    <h4 class="dz-title"><a href="<?=$item['url']?>"><?=$item["baslik"]?></a></h4>
                                                </div>
                                            </div>
                                        </li>


                                    <? endforeach; ?>

                                </ul>
                        

                    

                                <div class="col-3 text-align-center" style="margin: auto;">
                                    <a href="<?=$this->langLink("haberler")?>" class="btn btn-primary"> <?=$this->lang->genel('fazla')?>  <i class="fas fa-long-arrow-alt-right m-l15"></i></a>
                                </div>



                            </div>
                        </div>

                </section>

                <?php endif; ?>
                <!-- #News End -->

		<!-- Referenaslar -->
        <?
           if (is_array($referanslar)){ 
        ?>

		<section class="content-inner-1 pt-0">
			<div class="container">

				<div class="section-head style-1 mb-5">
					<h2 class="title"><?=$this->lang->header('referanslar')?></h2>
				</div>


				<div class="swiper-container clients-swiper">
					<div class="swiper-wrapper">
                        <?
                            foreach ($referanslar as $item) {
                                $referans_resim = $this->dbResimAl($item["resim"], "referans", "200x70", true);
                        ?>

                            <div class="swiper-slide">
                                <div class="clients-logo">
									<a href="<?=((!empty($item['link'])) ? $item['link'] : 'javascript:void;')?>" target="<?=((!empty($item['link'])) ? '_blank' : '_self')?>">
                                    	<img class="logo-main" src="<?=$referans_resim?>" alt="">
									</a>
                                </div>
                            </div>

                        <? } ?>

					</div>
				</div>
			</div>
		</section>

        <? } ?>
		<!-- #Referenaslar -->




