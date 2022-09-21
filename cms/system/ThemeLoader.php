<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 08.03.2016
 * Time: 18:35
 */

namespace cms;


class Theme extends Settings{

    public $settings = '';
    public $sidebar ;

    public function __construct($settings,$sidebarList)
    {

       parent::__construct($settings,$sidebarList);
        $this->sidebar = $sidebarList;
        $this->settings = $settings;

    }



    public function solMenu()
    {
        $data =  new \cms\Sidebar($this->settings,$this->sidebar);
        return $data->sidebar();
    }








}