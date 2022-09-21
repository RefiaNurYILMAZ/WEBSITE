<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiralık Dükkan Öneri Formu</title>
    <style media="all" type="text/css">

        body {
            background-color: #efefef;
            font-family: 'Arial', sans-serif !important;
            font-size: 15px;
            color:#555;
        }
        a, a:hover, a:focus, a:visited {
            text-decoration: none;
        }

        .detay {
            background-color: #ffffff;
            padding:20px;
            border:1px solid #d9d9d9;
            border-top:none;
        }

        .baslik {
            background-color: #f7f7f7;
            font-weight: bold;
            padding:15px;
            border:1px solid #d9d9d9;
        }

        .detay table tbody tr td ,.detay table tbody tr th {
            padding:10px;
            text-align: left;
            border-collapse: collapse;
            border:1px solid #dee2e6;
            border-spacing: 0px;
        }


        .container {
            width: 1000px;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
        }

        .detay table thead tr th {
            color:#ffffff;
            padding:20px !important;
        }

        .small {
            font-size: 11px;
        }


    </style>
</head>
<body>
<div class="container" align="center">
    <img src="<?=$this->themeURL?>img/logo/logo.png">
    <br><br>
</div>

<table class="container" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
    <tr>
        <td class="baslik">
            Merhaba Yetkili, <br>Websiteniz Üzerinden Kiralık Dükkan Öneri Formu Aldınız
        </td>
    </tr>
    <tr>
        <td class="detay">
            <table class="table" width="100%" cellspacing="0" cellpadding="0">

                <tbody>



                    <tr class="">
                        <th width="20%">Adı Soyadı</th>
                        <td><?=$adi?></td>
                    </tr>

                    <tr>
                        <th>E-posta</th>
                        <td><?=$email?></td>
                    </tr>

                    <tr>
                        <th>Telefon</th>
                        <td><?=$tel?></td>
                    </tr>

                    <tr>
                        <th>Şehir</th>
                        <td><?=$il?></td>
                    </tr>

                    <tr>
                        <th>İlçe</th>
                        <td><?=$ilce?></td>
                    </tr>

                    <tr>
                        <th>Adres</th>
                        <td><?=$adres?></td>
                    </tr>

                    <tr>
                        <th>Kat Sayısı</th>
                        <td><?=$kat_sayisi?></td>
                    </tr>

                    <tr>
                        <th colspan="2" style="text-align: center">Dükkan Katları Ölçüsü (m<sup>2</sup>)</th>
                    </tr>
                    <? foreach ($floor_m2 as $key=>$floor):?>
                        <tr>
                            <th><?=$key+1?>.Kat m<sup>2</sup></th>
                            <td><?=$this->temizle($floor)?> m<sup>2</sup></td>
                        </tr>
                    <? endforeach;?>

                        <tr>
                            <th>Detaylar</th>
                            <td><?=$mesaj?></td>
                        </tr>

                </tbody>
            </table>
        </td>
    </tr>
</table>
<table class="container" align="center" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="center" class="small">
            <br><br>
            <p><strong><?=$this->ayarlar('unvan_tr')?></strong></p>
            <p><?=$this->ayarlar('adres_merkez')?></p>
            <p>Telefon : <?=$this->ayarlar('telefon_merkez')?></p>
            <p>E-Posta : <?=$this->ayarlar('email_merkez')?></p>
        </td>
    </tr>
</table>
</body>
</html>