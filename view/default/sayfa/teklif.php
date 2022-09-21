<?
/* @var $this FrontClass|Loader object */


$sayfa = "tekilf";
?>



<section class="content-inner">
    <div class="container">
        <div class="row">


            <div class="section-head text-center style-1">
                <h5 class="text-primary sub-title"> Ürünlerimiz hakkinda bilgi alin</h5>
                <h3 class="title">Teklif Formu</h3>
            </div>


            <div class="col-xl-8" style="margin: auto;">


                <div id="graphic-design-1">
                    <?
                    Form::Open(array(
                        "class" => "contact-form teklifform",
                        "id"=>"teklifform",
                        "method" => "post",
                        "name"=>"teklifform",
                        "action" => $this->baseURL("ajax/teklif", "tr", 1),
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
                    <fieldset>
                        <div class="row">

                            <div class="form-group col-md-12 dropdown mb-3">
                                <select class="form-select" name="urun" required="">
                                    <option value="">Lütfen Bir Ürün Seçiniz</option>
                                    <?
                                    $sehirler =  $this->dbLangSelect("urun", "aktif = 1  and baslik <> ''");
                                    foreach ($sehirler as $sehir) {
                                        ?>

                                        <option value="<?=$this->temizle($sehir["baslik"])?>"><?=$this->temizle($sehir["baslik"])?></option>

                                        <?
                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                <input class="form-control" type="text"  name="adi" placeholder=" <?=$this->lang->iletisim('adi')?> " required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                <input class="form-control" type="email" name="email" placeholder="<?=$this->lang->iletisim('email')?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                <input class="form-control" type="text"  name="tel" placeholder="<?=$this->lang->iletisim('tel')?>" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mb-30 input-group">
                                <input class="form-control" type="text"  name="konu" placeholder="<?=$this->lang->iletisim('firma_adi')?>" required="">
                            </div>


                            <div class="alert" style="display: none"></div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                                <div class="padding_top15 text-center">

                                    <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor btn w-100 btn-primary btn-border" type="submit">Gönder<i class="flaticon flaticon-right-arrow"></i></button>
                                </div>
                            </div>

                        </div>

                    </fieldset>
                    <?
                    Form::Close();
                    ?>


                </div>


            </div>

        </div>
    </div>
</section>





