<?
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 */

$table = "urun";
$sayfa = "urun";
$this->langZorunluSayfa($id, $table, $sayfa, "aktif = 1 and baslik <> ''");
$veri = $this->dbLangSelectRow($table,array("id"=>$id, "master_id"=>$id), "resim,detay_resim");



$getID = $this->getID($veri);
$baslik = $this->temizle($veri["baslik"]);
$this->sayfaBaslik = $this->temizle($veri["baslik"])." - ".$this->ayarlar("title_".$lang);
$boyut = $this->getimageinfo($table, "", "big");
$ek_boyut = $this->getimageinfo($table, "", "ek");
$resim = $this->dbResimAl($veri["resim"],$table, $boyut);
$detay_resim = $this->dbResimAl($veri["detay_resim"],$table, "750x300", false);
$sidebar = $this->dbLangSelect($table, "aktif = 1 and baslik <> ''");
$resimler = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = '".$p."' and tur = 'resim' and aktif = 1 and data_id = $getID and sil <> 1 ORDER BY sira ASC");


$resimler_galeri = $this->sorgu("SELECT *, baslik as baslik_tr FROM dosyalar WHERE type = 'urun' and tur = 'resim' and aktif = 1  and data_id = $getID and sil <> 1 ORDER BY sira ASC");



$kid = $this->temizle($veri["kid"]);
$kid2 = $this->temizle($veri["kid2"]);
$detay = $this->temizle($veri["detay"]);
$ozet = $this->temizle($veri["ozet"]);
$kategori = $this->dbLangSelectRow("kategori",array("id"=>$kid, "master_id"=>$kid), "resim,detay_resim");
$marka = $this->dbLangSelectRow("marka_kategori",array("id"=>$kid2, "master_id"=>$kid2), "resim,detay_resim");

$kategori_sidebar = $this->dbLangSelect("kategori", "aktif = 1 and baslik <> '' and ustu = 0");


$katalog = $this->dbLangSelectRow("katalog",array("id"=>$id, "master_id"=>$id), "resim,detay_resim");

//$kategori  = $this->dbLangSelect("kategori","aktif = 1 and baslik <> '' and id=".$getID);

$urun  = $this->dbLangSelect("urun","aktif = 1 and baslik <> ''");


/* dfdsfdsgf */

$veri2 = $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and url = "'.$katurl.'-'.$id.'"', 'resim,icon')[0];

$p = 'kategori';

if(!is_array($veri2)){
    $veri2 = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and url = "'.$katurl.'-'.$id.'"', 'resim,icon')[0];
    $p = 'urun';
    if(!is_array($veri2)){
        $dt = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and kid = '.$id, 'resim,icon');
    }

}else {
    $dt = $this->dbLangSelect('kategori', 'aktif = 1 and baslik <> "" and ustu = '.$veri2[$mid.'id'], 'resim,icon');
    if(!is_array($dt)){
        $dt = $this->dbLangSelect('urun', 'aktif = 1 and baslik <> "" and kid = '.$veri2[$mid.'id'], 'resim,icon');
    }
}

if($p == 'kategori'){
    $ust_kat = $this->dbLangSelectRow('kategori', ['id'=>$veri['ustu'], 'master_id'=>$veri['ustu']]);
}
if($p == 'urun'){
    $ust_kat = $this->dbLangSelectRow('kategori', ['id'=>$veri['kid'], 'master_id'=>$veri['kid']]);
}

/* sdfsdf */

if (!empty($resim)){
    $this->ogResim = $resim;
}

$this->ogBaslik = $this->sayfaBaslik;
$this->ogUrl = $this->fullUrl;

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







        <!-- ÜRÜN -->





		<section class="content-inner">
			<div class="container">
				<div class="row m-b60 m-sm-b30">



					<div class="col-xl-7 col-lg-6 m-b40">
						<div class="row sticky-top">
							<div class="col-3 position-relative">
								<div class="swiper-container thumb-slider sync2">
									<div class="swiper-wrapper">


                                        <!-- Slider -->

                                        <!-- Slider Section Start -->
                                        
                                        <? if (is_array($resimler_galeri)):?>



                                                <?
                                                foreach ($resimler_galeri as $item):
                                                    $resim46 = $this->dbResimAl($item["dosya"], "urun", "744x400", true);
                                                    $resim47 = $this->dbResimAl($item["dosya"], "urun", "0x1200", true);
                                                ?>


                                                    <div class="swiper-slide">
                                                        <div class="dz-media">
                                                            <img src="<?=$resim46?>" alt="">
                                                        </div>
                                                    </div>



                                                <? endforeach;?>

                                        <? endif;?>

                                    </div>



                                    <div class="thumb-slider-navigation">
										<div class="swiper-button-next-thumb"></div>
										<div class="swiper-button-prev-thumb"></div>
									</div>

								</div>
							</div>



                        </div>
                    </div>





                    <div class="col-xl-5 col-lg-6 m-b40">
						<form method="post" class="cart p-md-l0">
							<div class="dlab-post-title ">
								<h3 class="post-title">Cashmere Sweater</h3>
								<p class="m-b30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
							</div>
							<div class="position-relative">
								<h3 class="m-tb10">$2,140.00 </h3>
								<div class="shop-item-rating">
									<ul class="item-review">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fas fa-star-half-alt"></i></li>
										<li><i class="far fa-star"></i></li>
										<li><i class="far fa-star"></i></li>
									</ul>
									<span>4.5 Rating</span>
								</div>
							</div>
							<div class="shop-item-tage m-b30">
								<span>Tags :- </span>
								<a href="">Shoes,</a>
								<a href="">Clothing</a>
								<a href="">T-shirts</a>
							</div>
							<div class="row">
								<div class="col-md-7 col-sm-8">
									<div class="widget">
										<div class="widget-title mb-3">
											<h6 class="title">Product Size</h6>
										</div>
										
										<div class="btn-group product-size">
											<input type="radio" class="btn-check" name="btnradio1" id="btnradio11" checked="">
											<label class="btn" for="btnradio11">XS</label>

											<input type="radio" class="btn-check" name="btnradio1" id="btnradio21">
											<label class="btn" for="btnradio21">SM</label>

											<input type="radio" class="btn-check" name="btnradio1" id="btnradio31">
											<label class="btn" for="btnradio31">MD</label>
										  
											<input type="radio" class="btn-check" name="btnradio1" id="btnradio41">
											<label class="btn" for="btnradio41">LG</label>
										  
											<input type="radio" class="btn-check" name="btnradio1" id="btnradio51">
											<label class="btn" for="btnradio51">XL</label>
										</div>
									</div>
								</div>
								<div class="col-md-5 col-sm-4">
									<div class="widget">
										<div class="widget-title mb-3">
											<h6 class="title">Select quantity</h6>
										</div>
										<div class="quantity btn-quantity style-1">
											<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="demo_vertical2" type="text" value="1" name="demo_vertical2" class="form-control" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="ti-plus"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="ti-minus"></i></button></span></div>
										</div>
									</div>
								</div>
							</div>
							<div class="widget">
								<div class="widget-title mb-3">
									<h6 class="title">Select the color</h6>
								</div>
								
								<div class="btn-group product-item-color">
									<input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked="">
									<label class="btn bg-red" for="btnradio1"></label>

									<input type="radio" class="btn-check" name="btnradio" id="btnradio2">
									<label class="btn bg-dark" for="btnradio2"></label>

									<input type="radio" class="btn-check" name="btnradio" id="btnradio3">
									<label class="btn bg-yellow" for="btnradio3"></label>
								  
									<input type="radio" class="btn-check" name="btnradio" id="btnradio4">
									<label class="btn bg-blue" for="btnradio4"></label>
								  
									<input type="radio" class="btn-check" name="btnradio" id="btnradio5">
									<label class="btn bg-green" for="btnradio5"></label>
								</div>
							</div>
							<button class="btn btn-primary"><i class="ti-shopping-cart m-r10"></i> Add To Cart</button>
						</form>
					</div>



                    <div class="row m-b80 m-sm-b30">
					    <div class="col-xl-12">
                            <div class="product-description tabs-site-button">
                                <ul class="nav nav-tabs ">
                                    <li><a data-bs-toggle="tab" href="#web-design-1" class="">Description</a></li>
                                    <li><a data-bs-toggle="tab" href="#graphic-design-1" class="">Additional Information</a></li>
                                    <li><a data-bs-toggle="tab" href="#developement-1" class="active">Product Review</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="web-design-1" class="tab-pane">
                                        <p class="m-b10">Suspendisse et justo. Praesent mattis commyolk augue Aliquam ornare hendrerit augue Cras tellus In pulvinar lectus a est Curabitur eget orci Cras laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis  commyolk augue aliquam ornare augue.</p>
                                        <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                                        <ul class="list-check-1 primary">
                                            <li>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and </li>
                                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </li>
                                        </ul>
                                    </div>
                                    <div id="graphic-design-1" class="tab-pane">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                <td>Size</td>
                                                <td>Small, Medium &amp; Large</td>
                                            </tr>
                                            <tr>
                                                <td>Color</td>
                                                <td>Pink &amp; White</td>
                                            </tr>
                                            <tr>
                                                <td>Rating</td>
                                                <td>
                                                    <ul class="item-review">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fas fa-star-half-alt"></i></li>
                                                        <li><i class="far fa-star"></i></li>
                                                        <li><i class="far fa-star"></i></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Waist</td>
                                                <td>26 cm</td>
                                            </tr>
                                            <tr>
                                                <td>Length</td>
                                                <td>40 cm</td>
                                            </tr>
                                            <tr>
                                                <td>Chest</td>
                                                <td>33 inches</td>
                                            </tr>
                                            <tr>
                                                <td>Fabric</td>
                                                <td>Cotton, Silk &amp; Synthetic</td>
                                            </tr>
                                            <tr>
                                                <td>Warranty</td>
                                                <td>3 Months</td>
                                            </tr>
                                            <tr>
                                                <td>Chest</td>
                                                <td>33 inches</td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div id="developement-1" class="tab-pane active">
                                        <div id="comments">
                                        <div class="comments-area style-1">
                                                <div class="widget-title">
                                                    <h4 class="title">Comments</h4>
                                                </div>
                                                <div class="clearfix">
                                                    <!-- comment list END -->
                                                    <ol class="comment-list">
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <div class="comment-author vcard"> 
                                                                    <img class="avatar photo" src="images/testimonials/large/pic1.jpg" alt=""> 
                                                                </div>
                                                                <div class="comment-info">
                                                                    <div class="title">
                                                                        <cite class="fn">Sarah Albert</cite>
                                                                        <div class="reply"> 
                                                                            <a href="javascript:void(0);" class="comment-reply-link">Reply</a> 
                                                                        </div>
                                                                    </div>
                                                                    <p>Vivamus imperdiet erat id leo malesuada bibendum tristique in ipsum. Nulla vel elit ac ipsum maximus dapibus. Aenean aliquet euismod eros, quis dictum mauris congue a. Integer porttitor et eros non hendrerit.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <div class="comment-author vcard"> 
                                                                    <img class="avatar photo" src="images/testimonials/large/pic2.jpg" alt=""> 
                                                                </div>
                                                                <div class="comment-info">
                                                                    <div class="title">
                                                                        <cite class="fn">Kevin Martin</cite>
                                                                        <div class="reply"> 
                                                                            <a href="javascript:void(0);" class="comment-reply-link">Reply</a> 
                                                                        </div>
                                                                    </div>
                                                                    <p>Vivamus imperdiet erat id leo malesuada bibendum tristique in ipsum. Nulla vel elit ac ipsum maximus dapibus. Aenean aliquet euismod eros, quis dictum mauris congue a. Integer porttitor et eros non hendrerit.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                    <!-- comment list END -->
                                                </div>
                                                <div class="widget-title">
                                                    <h4 class="title">Leave Comment</h4>	
                                                </div>
                                                <div class="clearfix">
                                                    <!-- Form -->
                                                    <div class="comment-respond style-1" id="respond">
                                                        <form class="comment-form" id="commentform" method="post">
                                                            <p class="comment-form-author">
                                                                <label>First Name <span class="required">*</span></label>
                                                                <input type="text" name="FirstName" placeholder="First Name" id="FirstName">
                                                            </p>
                                                            <p class="comment-form-email">
                                                                <label>Email <span class="required">*</span></label>
                                                                <input type="text" placeholder="Email" name="email" id="email">
                                                            </p>
                                                            <p class="comment-form-comment">
                                                                <label>Message</label>
                                                                <textarea rows="8" name="Message" placeholder="Message" id="Message"></textarea>
                                                            </p>
                                                            <p class="form-submit">
                                                                <button type="submit" class="btn effect btn-primary" id="submit">Submit A Comment<i class="fas fa-long-arrow-alt-right m-l15"></i></button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                    <!-- Form -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-12">
                            <div class="swiper-container related-item-swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-2584eb28f39b1749" aria-live="off" style="transform: translate3d(-299.75px, 0px, 0px); transition-duration: 0ms;">
                                    <div class="swiper-slide swiper-slide-prev" role="group" aria-label="1 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item1.jpg" alt="">
                                                <span class="badge bg-success">Sale</span>
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Denim Jeans</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price">$400</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="2 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item2.jpg" alt="">
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Outlaw Jacket</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price"><del>$232</del> <span class="text-primary">$192</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="3 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item3.jpg" alt="">
                                                <span class="badge bg-danger">New</span>
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Tennis Shorts</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price">$384</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="4 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item4.jpg" alt="">
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Plain Multicolored</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price"><del>$500</del> <span class="text-primary">$299</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="5 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item5.jpg" alt="">
                                                <span class="badge bg-danger">Hot</span>
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Cashmere Sweater</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price">$280</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" role="group" aria-label="6 / 6" style="width: 269.75px; margin-right: 30px;">
                                        <div class="item-box">
                                            <div class="item-img">
                                                <img src="images/product/item6.jpg" alt="">
                                                <span class="badge bg-info">Trending</span>
                                                <div class="item-info-in">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">shopping_cart</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">visibility</span></a></li>
                                                        <li><a href="javascript:void(0);"><span class="material-icons">favorite_border</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center">
                                                <h4 class="item-title"><a href="shop-grid-3.html">Cotton Jacket</a></h4>
                                                <ul class="item-review">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                    <li><i class="far fa-star"></i></li>
                                                </ul>
                                                <h4 class="item-price">$198</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next-related" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-2584eb28f39b1749" aria-disabled="false"></div>
                                <div class="swiper-button-prev-related" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-2584eb28f39b1749" aria-disabled="false"></div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                        </div>
				    </div>

				</div>

                        
                     <!-- Slider Section End -->


                        <!-- #Slider -->

                    <div class="row mt-4">
   
                            <!-- kategori -->
                            <div class="col-lg-6">
                                <h6 style="margin-top: 10px;">Kategori</h6>

                                <div class="btn-part mb-30">
                                    <a class="readon price big" href="javascript::0"><?=$kategori['baslik']?></a>
                                </div>
                            </div>
                            <!-- #kategori -->
                            
                            <!-- marka -->
                            <div class="col-lg-6">
                                <h6 style="margin-top: 10px;">Marka</h6>

                                <div class="btn-part mb-30">
                                    <a class="readon price big" href="javascript::0"><?=$marka['baslik']?></a>
                                </div>
                            </div>
                            <!-- #marka -->
                    </div>

                        <span class="mt-10 ok_ol">
                            <?=$ozet?>
                        </span>
                              
<!--
                        <div class="btn-part mb-20">
                            <div class="form-group mb-0 mt-20">
                                <input class="readon submit" type="submit" value="E-Katalog">
                            </div>
                        </div>
-->

                        <div class="module-contact module-contact-2 mt-20">
                         <a class="btn btn--primary " target="_blank" style="background-color: #504f4f;color: white;font-size: 15px;font-weight: bold;padding: 11px 22px 11px 22px;" href="http://localhost/no_name_dinamik/e-katalog.html/<?=$katalog['id']?>">E-Katalog</a>
                        </div>
                      
                    </div>


                    <div class="col-lg-4">
                        <aside class="sidebar-area  pt-lg-0">
                            <div class="widget widget_categories">

                                <ul class="services-list">

                                   <?=$this->multipleSubmenu(0, $this->lang->link("urunler"), $katurl."-".$id, ((isset($ust_kat)) ? $ust_kat['url'] : 'null'));?>

                                </ul>
                            </div>

                        </aside>

                        <div class="services-add mb-50 mt-50">
                            <div class="rs-videos address-item mb-35">
                                <div class="address-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <h2 class="title">Herhangi bir sorunuz mu var? <br> Bugün bizi arayın!</h2>
                            <div class="sec-title text-center">
                                <h2 class="title title2" style="z-index: 55;position: relative;">
                                    <a href="<?=$this->linkTelefon()?>"><?=$this->ayarlar("telefon_merkez")?></a>
                                </h2>
                            </div>
                        </div>


                    </div>




                    <!-- deneme -->


                    <!-- Project Section Start -->
                    <div id="rs-project" class="rs-project style1 project-home5-style bg26 pt-40 pb-40 md-pt-70 md-pb-70">
                        <div class="container">

                            <div class="gridFilter mb-50 md-mb-30 text-center">
                                <!-- <button class="active" data-filter="*">Tümü</button> -->
                                <button data-filter=".filter1">Açıklama</button>
                                <!-- <button data-filter=".filter2">Video</button> -->
                                <!-- <button data-filter=".filter4">360° Görünüm</button> -->
                                <button data-filter=".filter3">Talep Formu</button>
                            </div>

                            <div class="row grid">

                                <div class="col-lg-12 col-md-6 mb-30 grid-item filter1">
                                    <div class="project-item">

                                      <?=$detay?>

                                    </div>
                                </div>

                                <!--
                                <div class="col-lg-4 col-md-6 mb-30 grid-item filter2">

                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/JZtfX-Jl5Wg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                </div>
                                    -->

                                <div class="col-lg-12 col-md-6 mb-30 grid-item filter3 rs-contact contact-style2">


                                    <div class="contact-wrap">


                                        <form id="contact-form" method="post" action="mailer.php">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                                        <input class="from-control" type="text" id="name" name="name" placeholder=" İsim Soyisim" required="">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                                        <input class="from-control" type="text" id="email" name="email" placeholder="E-Mail" required="">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                                        <input class="from-control" type="text" id="phone" name="phone" placeholder="Cep Telefon" required="">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                                        <input class="from-control" type="text" id="Website" name="subject" placeholder="Firmanızın Adı" required="">
                                                    </div>

                                                    <div class="col-lg-12 mb-35">
                                                        <textarea class="from-control" id="message" name="message" placeholder="Notunuz" required=""></textarea>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <input type="checkbox" required=""> 6698 Sayılı Kişisel Verilerin Korunması Kanunu kapsamında kişisel verilerimin kaydedilmesine <a style="color:#504f4f" target="_blank" href="javascript::0"><b>aydınlatılmış açık rızam</b></a>                                                        ile onay veririm.</div>
                                                </div>
                                                <div class="btn-part">
                                                    <div class="form-group mb-0 mt-10">
                                                        <input class="readon submit" style="background-color: #504f4f;" type="submit" value="Gönder">
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>


                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Project Section End -->


                    <!-- #deneme -->

                </div>
            </div>
        </div>


        <!-- ÜRÜN -->


    </div>
    <!-- Main content End -->


    

<script>
    jQuery(window).on("load", function() {
        if (jQuery(".rs-project").length) {
            setTimeout(function() {
                jQuery(".gridFilter").find("button:first-child").trigger("click");
            }, 200);
        }

    });
</script>

