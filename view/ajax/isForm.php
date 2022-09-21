<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İş Arayan Formu</title>
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
    <img src="<?=$this->themeURL?>images/logo/logo.png">
    <br><br>
</div>

<table class="container" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
    <tr>
        <td class="baslik">
            Merhaba Yetkili, <br><?=$this->ayarlar("firma_tr")?> Web Sitesinden, İş Arayan Formu Aldınız
        </td>
    </tr>
    <tr>
        <td class="detay">
            <table class="table" width="100%" cellspacing="0" cellpadding="0">

                <tbody>

                    <tr class="">
                        <th width="20%">Adı Soyadı</th>
                        <td><?=$adi_soyadi?></td>
                    </tr>

                    <tr>
                        <th>T.C. No</th>
                        <td><?=$tc_kimlik?></td>
                    </tr>

                    <tr>
                        <th>Telefon</th>
                        <td><?=$cep_telefonu?></td>
                    </tr>

                    <tr>
                        <th>Engellilik Oranı</th>
                        <td><?=$engellilik?></td>
                    </tr>

                    <tr>
                        <th>Meslek</th>
                        <td><?=$meslek?></td>
                    </tr>


                    <tr>
                        <th>Eğitim Durumu</th>
                        <td><?=$tahsil?></td>
                    </tr>

                    <tr>
                        <th>Cinsiyet</th>
                        <td><?=$cinsiyet?></td>
                    </tr>

                    <tr>
                        <th>Yaşı</th>
                        <td><?=$yas?></td>
                    </tr>


                    <tr>
                        <th>Adresi</th>
                        <td><?=$adresi?></td>
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