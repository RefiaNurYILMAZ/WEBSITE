<?php
/**
 * Created by PhpStorm.
 * User: Abdulkadir
 * Date: 23.10.2016
 * Time: 01:12
 */
$_URL =  explode('.',$_SERVER["HTTP_HOST"]);
$_URL  = $_URL[count($_URL)-1];

return [

    /*

    |--------------------------------------------------------------------------

    | Site URL si

    |--------------------------------------------------------------------------

    |

    */

    'url' =>  (($_SERVER['SERVER_PORT'] =="443") ? 'https://':'http://').$_SERVER["HTTP_HOST"].(($_URL=="dev") ? '/':str_replace('/cms','',str_replace('index.php','',$_SERVER["PHP_SELF"]))),

    /*
     *

|--------------------------------------------------------------------------

|  Site İzleme İsmi

|--------------------------------------------------------------------------

|

*/

    "display_error"=>true,


   'adminAnalyticsCode' => 'UA-87157922-1',
    /*

|--------------------------------------------------------------------------

|  Varsayılan tema

|--------------------------------------------------------------------------

|

*/

    'version' => '1.5.6',


    'siteTemasi' => 'default',


    'siparisNoUzunluk'=>6,


    'siparisIslemDurum'=>array(
        "1"=>"Ödeme Bekleniyor",
        "2"=>"Ödeme İşlemi Tamamlandı",
        "3"=>"Ödeme Sırasında Hata Oluştu",
    ),




    /*

  |--------------------------------------------------------------------------

  |Yapım Aşamasında  True/False

  |--------------------------------------------------------------------------

  |

  */


    'yapimAsamasinda' => false,
    /*

     |--------------------------------------------------------------------------

     | Şifreleme Key

     |--------------------------------------------------------------------------

     |

     */


    'passkey' => 'panelkey00xx',


    'sifre_anahtar'=>"vmdy3441",



    /*

 |--------------------------------------------------------------------------

 | default database

 |--------------------------------------------------------------------------

 |

 */


    'defaultDb' => 'pdo',

   /*

 |--------------------------------------------------------------------------

 | veri limitleri

 |--------------------------------------------------------------------------

 |

 */



    'referansLimit' => 50,

    'veriLimit' => 30,



    /*

   |--------------------------------------------------------------------------

   | Panel Klasör İsmi

   |--------------------------------------------------------------------------

   |

   */



    'adminfolder' => 'cms',

    /*

     |--------------------------------------------------------------------------

     | Admin Panel Seo  true/false

     |--------------------------------------------------------------------------

     |

     */



    'adminSeo' => false,

    /*

 |--------------------------------------------------------------------------

 | Resim  Klasörü

 |--------------------------------------------------------------------------

 |

 */


    'folder'=>'upload/',

    /*

     |--------------------------------------------------------------------------

     | Yönetim Paneli Teması
     |--------------------------------------------------------------------------

     |

     */

    'adminTheme' => 'admin',



    'cdnURL' => '',


    'urlUzanti' => '.html',


    'checkDomains'=>array(
        "com",
        "com.tr",
        "net"
    ),

    "domainPrices"=>array(
        "com"=>100,
        "com.tr"=>100,
        "net"=>100
    ),

    "paketTurleri"=>array(
        1=>array("id"=>1, "title"=>"Kurumsal Site"),
        2=>array("id"=>2, "title"=>"Etkinlik veya Proje Sitesi"),
        3=>array("id"=>3, "title"=>"Kişisel Blog"),
    ),

    "amaclar"=>array(
        1=>array(
            "title"=>"Firma, Ürün ve Hizmetleri Tanıtmak",
            "icon"=>"mdi mdi-dropbox",
            "aktif"=>1,
            "tur"=>1,
        ),
        2=>array(
            "title"=>"Bir etkinlik ve/veya projeyi tanıtmak",
            "icon"=>"mdi mdi-table",
            "aktif"=>1,
            "tur"=>2,
        ),
        3=>array(
            "title"=>"Portföyümü tanıtmak",
            "icon"=>"mdi mdi-image-album",
            "aktif"=>0
        ),
        4=>array(
            "title"=>"Online Satış Yapmak",
            "icon"=>"mdi mdi-cart",
            "aktif"=>0
        ),
        5=>array(
            "title"=>"Kişisel Blog Oluşturmak",
            "icon"=>"mdi mdi-blogger",
            "aktif"=>1,
            "tur"=>3,
        ),
    ),

    "sslPrice"=>100,


];