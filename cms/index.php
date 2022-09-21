<?php
	session_start();
	ob_start();
    include('../vendor/autoload.php');
	include('system/AutoLoader.php');
    include('system/class.fileuploader.php');
	include '../include/Ayarlar.php';
    include('../include/Smap.php');
    include('../include/Functions.php');
    include('../include/Database.php');
	include('system/Modules.php');
	include('system/Settings.php');
	include('system/AppCropper.php');
    include('system/ThemeLoader.php');





    $settings = new cms\Ayarlar('../include');
    $controller_loader = new cms\AutoLoader('controller');
    $modules_loader = new cms\AutoLoader('modules');
    $layout_loader = new cms\AutoLoader('system/');


if ($settings->config("display_error")){
    ini_set('display_errors', "On");
    ini_set('display_startup_errors', "On");
    ini_set('error_reporting', "E_ALL & ~E_NOTICE & ~E_DEPRECATED");
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}else {
    ini_set('display_errors', "Off");
    ini_set('display_startup_errors', "Off");
}



spl_autoload_register(array($controller_loader, 'autoload'));
    spl_autoload_register(array($layout_loader, 'layout'));
    spl_autoload_register(array($modules_loader, 'autoload'));
    $theme = new cms\Theme($settings,$settings->sidebar());
    $control = new cms\Controller(((isset($_GET['cmd'])) ? $_GET['cmd']:'Index'),$settings);
    $systemSetting = new cms\Settings($settings);
    $modul = explode('/',((isset($_GET['cmd'])) ? $_GET['cmd']:'Index'));


    $sistem = array('Files','Sirala','Dosya','Login', 'durum', "Ajax", "AjaxPage");

    if(!in_array($modul[0],$sistem)):
      $theme->load('theme/'.$settings->config('adminTheme').'/master',
          array(
          'settings'=> $settings,
          'control' => $control,
          'sidebar'=>$theme,
          'system'=>$systemSetting
          )
      );

    endif;

