<?php
Namespace cms;

class Sidebar extends  Settings
{
    public  $sidebar;
    public  $settings;

    public function __construct($settings,$sidebarList)
    {

        parent::__construct($settings,$sidebarList);

        $this->sidebar = $sidebarList;
        $this->settings = $settings;

    }


    public function sidebar($a=1)
    {
        return $this->_inc('Sidebar',array('a'=>$a,'sidebar'=>$this->sidebar));

    }



}





?>