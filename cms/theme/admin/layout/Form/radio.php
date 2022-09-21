<?

?>
<div class="form-group form-md-line-input">
    <label style="font-size:14px;"><?=((isset($help) ? $help :''))?> <?=(isset($required)) ? '<span class="text-danger">*</span>':null?></label>

    <div class="controls">


        <?
            if (is_array($data)){
                foreach ($data as $item){
                    $rand = rand(1111,9999);
        ?>

                    <input name="<?=((isset($name) ? $name :'')).((isset($lang) and $lang) ? '_'.$lang:'')?>"
                           type="radio"
                           <?=(isset($required)) ? 'required':''?>
                           id="<?=(isset($id) ? $id : "radio-".$rand)?>"
                           value="<?=$item["value"]?>"
                           <?=(($checked == $item["value"]) ? "checked" : "")?>
                           data-validation-required-message="Seçeneklerden En Az Birini Seçmelisiniz."
                           class="with-gap radio-col-blue">

                    <label class="mr-20" style="font-weight: 500;" for="<?=(isset($id) ? $id : "radio-".$rand)?>"><?=$item["title"]?> </label>


        <?
                }
            }
        ?>


    </div>

</div>

