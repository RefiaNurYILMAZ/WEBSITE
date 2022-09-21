<div class='box-footer'>
    <button type="submit" class="btn  <?=((isset($class) ? $class :''))?> <?=((isset($color) ? $color :'dark'))?>">
        <?=((isset($icon)) ? "<i class='".$icon."'></i>" : "")?>
        <?=((isset($submit) ? $submit :'Gönder'))?>
    </button>
</div>