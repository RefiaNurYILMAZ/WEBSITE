
<div class="form-group ">
    <label style="font-size: 14px;" for="<?=((isset($id) ? $id :'')).((isset($lang)) ? '_'.$lang:'')?>">
        <?=(isset($title)) ? $title : ""?> <?=(isset($lang)) ? "<small>[".$this->langSelect($lang)."]</small>" : ""?>
        <?=(isset($required)) ? '<span class="text-danger">*</span>':null?>
    </label>
    <div class="controls">
        <select class="form-control  select2 <?=(isset($class) ? $class : "")?>"
                data-url="<?=(isset($url) ? $url : "")?>"
                name="<?=((isset($name) ? $name :'')).((isset($lang)) ? '_'.$lang:'')?>[]"
                id="<?=((isset($name))? $name:null).((isset($lang)) ? '_'.$lang:'')?>"
                multiple
            <?=(isset($required)) ? 'required'." data-validation-required-message=\"En Az Bir Seçenek Seçiniz.\" ":null?>
        >
            <?=(isset($data) ? $data:null)?>
        </select>
        <div class="help-block" style="width: 100% !important;"></div>
    </div>

</div>

