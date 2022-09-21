<?php

/**
 * Created by PhpStorm.
 * User: 
 * Date: 9.11.2016
 * Time: 17:02
 */
class Lang
{

    public  $lang;

    public function __construct($lang=null)
    {
        $this->lang = $lang;
    }


    public function __call( $meth, $args ) {
        if($meth and file_exists('include/lang/'.$this->lang.'/'.$meth.'.php')):
            $data = $this->inc('include/lang/'.$this->lang.'/'.$meth);
            if (isset($data[$args[0]])){
                return $data[$args[0]];
            }else {
                $tr = $this->inc('include/lang/tr/'.$meth);
                if (isset($tr[$args[0]])){
                    return $tr[$args[0]];
                }else {
                    if ($meth != "link"){
                        return $args[0];
                    }else {
                        return $data;
                    }
                }
            }
        else:
            return $args[0];
        endif;
    }

    public function inc($file)
    {

        if($file.'.php' and file_exists($file.'.php')):
            return  include $file.'.php' ;
        else:
            return null;
        endif;
    }

}