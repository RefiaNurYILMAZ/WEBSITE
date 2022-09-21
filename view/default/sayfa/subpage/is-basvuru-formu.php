<?php
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $id int
 * @var $katurl string
 **/
?>
<?php Form::Open(array(
    "class" => "basvuruForm contact-form",
    "method" => "post",
    "id" => "basvuruForm",
    "action" => $this->baseURL("ajax/basvuru", "tr", 1),
    "token" => true,
    "message" => array(
        ["no" => 1, "title" => $this->lang->iletisim("formsucces"), "status" => "success"],
        ["no" => 2, "title" => $this->lang->iletisim("formerror"), "status" => "error"],
        ["no" => 3, "title" => $this->lang->iletisim("formvalid"), "status" => "warning"],
    ),
    "name" => "basvuruForm",
    "lang" => $lang
)); ?>
    <div class="row">
        <div class="col-sm-12"><h5 style="color:#ff0000; font-size: 12px; margin-bottom: 30px;"><?=$this->lang->form("zorunlu")?></h5></div>

        <div class="col-sm-6">

            <fieldset>
                <div class="form-group required">
                    <label><?=$this->lang->form("tc_kimlik")?></label>
                    <input type="text" name="tc_kimlik" id="tc_kimlik" class="form-control" required>
                </div>

                <div class="form-group required">
                    <label><?=$this->lang->form("adi_soyadi")?></label>
                    <input type="text" name="adi_soyadi" id="adi_soyadi" class="form-control" required>
                </div>

                <div class="form-group required">
                    <label class=""><?=$this->lang->form("email")?></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("dogum_yeri_ve_tarihi")?></label>
                    <input type="text" name="dogum_yeri_ve_tarihi" class="form-control " required>
                </div>

                <div class="form-group  required">
                    <label class=""><?=$this->lang->form("cinsiyeti_medeni_hali_cocuk_sayisi")?></label>
                    <input type="text" name="cinsiyeti_medeni_hali_cocuk_sayisi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><?=$this->lang->form("ehliyet")?></label>
                    <input type="text" name="ehliyet" class="form-control">
                </div>
                <div class="form-group">
                    <label class=""><?=$this->lang->form("askerlik_durumu")?></label>
                    <input type="text" name="askerlik_durumu" class="form-control">
                </div>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("cep_telefonu")?></label>
                    <input type="text" name="cep_telefonu" class="form-control" required>
                </div>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("adresi")?></label>
                    <input type="text" name="adresi" class="form-control" required>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("yabanci_dil")?></label>
                    <input type="text" name="yabanci_dil" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class=""><?=$this->lang->form("bilgisayar")?></label>
                    <input type="text" name="bilgisayar" class="form-control">
                </div>
            </fieldset>

        </div>

        <div class="col-sm-6">

            <fieldset>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("meslegi")?></label>
                    <input type="text" name="meslegi" id="meslegi" class="form-control zorunlu" required>
                </div>
                <div class="form-group">
                    <label><?=$this->lang->form("ne_zaman_baslayabilecegi")?></label>
                    <input type="text" name="ne_zaman_baslayabilecegi" class="form-control">
                </div>
                <div class="form-group required">
                    <label class=""><?=$this->lang->form("istenilen_gorev")?></label>
                    <input type="text" name="istenilen_gorev" id="istenilen_gorev" class="form-control zorunlu" required>
                </div>
                <div class="form-group">
                    <label><?=$this->lang->form("istenilen_ucret")?></label>
                    <input type="text" name="istenilen_ucret" class="form-control">
                </div>
            </fieldset>

            <fieldset>


                <div class="form-group">
                    <label><?=$this->lang->form("sigara")?></label>
                    <input type="text" name="sigara" class="form-control" placeholder="<?=$this->lang->form("evet_hayir")?>">
                </div>

                <div class="form-group required">
                    <label class=""><?=$this->lang->form("hukumluluk")?></label>
                    <input type="text" name="hukumluluk" class="form-control" placeholder="<?=$this->lang->form("var_yok")?>" required>
                </div>

                <div class="form-group required">
                    <label class=""><?=$this->lang->form("engel")?></label>
                    <input type="text" name="engel" class="form-control" placeholder="<?=$this->lang->form("var_yok")?>" required>
                </div>

                <div class="form-group">
                    <label class=""><?=$this->lang->form("seyahat")?></label>
                    <input type="text" name="seyahat" class="form-control" placeholder="<?=$this->lang->form("var_yok")?>">
                </div>

                <div class="form-group">
                    <label><?=$this->lang->form("universite_bolum")?></label>
                    <input type="text" name="universite_bolum" class="form-control">
                </div>

                <div class="form-group">
                    <label><?=$this->lang->form("eski_isyeri")?></label>
                    <input type="text" name="eski_isyeri" class="form-control">
                </div>

                <div class="form-group">
                    <label><?=$this->lang->form("not")?></label>
                    <input type="text" name="not" class="form-control">
                </div>
            </fieldset>

        </div>
        <div class="vc_clearfix"></div>

        <div class="col-sm-12">
            <div class="form-group mb-4">
                <label style="padding-top: 10px; padding-left: 9px;" class="master"><?=$this->lang->form("guvenlik_kodu")?></label>
                <div class="captcha">
                    <img class="captcha_image" src="<?=$this->baseURL("ajax/getcaptchaimage", "tr", 1)?>">
                    <input type="text" minlength="6"  name="captcha_value" maxlength="6" required>
                    <small><?=$this->lang->form("change_captcha")?></small>
                </div>
            </div>
            <button type="submit" id="formGonder" class="main-btn"  name="submit-form"><?=$this->lang->iletisim("gonder")?><i class="fa fa-arrow-right pl-3"></i></button>
        </div>

    </div>


<?php Form::Close(); ?>