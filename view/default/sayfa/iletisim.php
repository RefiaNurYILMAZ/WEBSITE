<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */

$baslik =  $this->lang->header('iletisim');
$this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_tr");
$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

$referanslar = $this->dbLangSelect("referans", "aktif = 1 and baslik <> ''", "resim", "");

?>



<div class="page-content bg-white">
		
        <!-- Banner  -->
        <div class="dz-bnr-inr dz-bnr-inr-sm overlay-black-middle text-center" style="background-image: url(<?=$assetURL?>img/bnr1.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1><?=$baslik?></h1>
                </div>
            </div>
        </div>
        <!-- Banner End -->







        <!--  harita  -->


        <section class="content-inner-2 pt-0">
			<div class="map-iframe">
			<iframe allowfullscreen  style="border:0; width:100%; min-height:100%; margin-bottom: -8px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3182.766254460559!2d37.43881441529803!3d37.08687367989057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1531e5a405b01695%3A0x4d832749f01ed5be!2sSanayi%2C%20Nolu%20Cd%20No%3A32%2C%2060176%20%C5%9Eehitkamil%2FGaziantep!5e0!3m2!1str!2str!4v1653950625246!5m2!1str!2str"></iframe>	
			</div>
		</section>


         <!--  #harita  -->
		



        <!--  icerik  -->


        		
		<section class="contact-wraper1" style="background-image: url(<?=$assetURL?>img/bg18.jpg);">	
			<div class="container">
				<div class="row">
					<div class="col-lg-5">
						<div class="contact-info">

							<ul class="no-margin">
								<li class="icon-bx-wraper text-white left m-b30">
									<div class="icon-md">
										<span class="icon-cell">
											<i class="flaticon-placeholder-1"></i>
										</span>
									</div>
									<div class="icon-content">
										<h4 class=" dz-tilte text-white"> <?=$this->lang->iletisim('adres')?>  </h4>
										<p style="color:rgb(255, 83, 23)" class="font-18"><?=$this->ayarlar("adres_merkez")?></p>
									</div>
								</li>
								<li class="icon-bx-wraper text-white left m-b30">
									<div class="icon-md">
										<span class="icon-cell">
											<i class="flaticon-message"></i>
										</span>
									</div>
									<div class="icon-content">
										<h4 class="dz-tilte text-white">  <?=$this->lang->iletisim('email')?>  </h4>
										<p class="font-18"><a href="<?=$this->linkEmail()?>" ><?=$this->ayarlar("email_merkez")?></a>
                                        </p>
									</div>
								</li>

                                <li class="icon-bx-wraper text-white left m-b30">
									<div class="icon-md">
										<span class="icon-cell">
											<i class="flaticon-phone-call"></i>
										</span>
									</div>
									<div class="icon-content">
										<h4 class="dz-tilte text-white">  <?=$this->lang->iletisim('telefon')?>  </h4>
										<p class="font-18"><a href="<?=$this->linkTelefon()?>" ><?=$this->ayarlar("telefon_merkez")?></a>
                                        </p>
									</div>
								</li>


							</ul>
						</div>
					</div>
					<div class="col-lg-7 m-b40">
						<div class="contact-area1 m-r20 m-md-r0">
							<div class="section-head style-1">
								<h6 class="sub-title text-primary"><?=$baslik?></h6>
							</div>
                            <?
                            Form::Open(array(
                                "class" => "dz-form dzForm",
                                "id"=>"request_qoute_form",
                                "method" => "post",
                                "name"=>"contactform",
                                "action" => $this->baseURL("ajax/iletisimForm", "tr", 1),
                                "token" => true,
                                "message" => array(
                                    ["no" => 1, "title" => $this->lang->iletisim("formsucces"), "status" => "alert-success"],
                                    ["no" => 2, "title" => $this->lang->iletisim("formerror"), "status" => "alert-error"],
                                    ["no" => 3, "title" => $this->lang->iletisim("formvalid"), "status" => "alert-warning"],
                                    ["no" => 4, "title" => $this->lang->iletisim("doldur"), "status" => "alert-warning"],
                                ),
                                "lang"=>$lang
                            ));
                            ?>


                           <!--  <form id="request_qoute_form" class="request_qoute_form wrap-form clearfix" method="post" novalidate="novalidate" action="#"> -->



                                <div class="row">
                                    <div class="col-md-12 input-group">
                                        <span class="text-input" style="width: 100%;"><input class="form-control" name="adi" type="text" value="" placeholder="<?=$this->lang->iletisim('adi')?>*" required="required"></span>
                                    </div>
                                    <div class="col-md-12 input-group">
                                        <span class="text-input" style="width: 100%;"><input class="form-control" name="konu" type="text" value="" placeholder="<?=$this->lang->iletisim('konu')?>*" required="required"></span>
                                    </div>
                                    <div class="col-md-12 input-group">
                                        <span class="text-input" style="width: 100%;"><input class="form-control" name="tel" type="text" value="" placeholder="<?=$this->lang->iletisim('tel')?>*" required="required"></span>
                                    </div>
                                    <div class="col-md-12 input-group">
                                        <span class="text-input" style="width: 100%;"><input class="form-control" name="email" type="email" value="" placeholder="<?=$this->lang->iletisim('email')?>*" required="required"></span>
                                    </div>
                                    <div class="col-lg-12 input-group">
                                        <span class="text-input" style="width: 100%;"><textarea class="form-control " name="mesaj" rows="4" placeholder="<?=$this->lang->iletisim('mesaj')?>" required="required"></textarea></span>
                                    </div>

                                


                                    <div class="col-lg-12">
                                        <div class="padding_top15 text-center">
                                            <div class="alert" style="display: none"></div>
                                            <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor btn w-100 btn-primary btn-border" type="submit"><?=$this->lang->iletisim('gonder')?><i class="flaticon flaticon-right-arrow"></i></button>
                                        </div>
                                    </div>



                                    
                                </div>

                                <?
                                Form::Close();
                                ?>

							
						</div>
					</div>
				</div>
			</div>
		</section>
		


         <!--  #icerik  -->
















