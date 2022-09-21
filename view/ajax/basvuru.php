<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İş Başvuru Formu</title>
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
    <img src="<?=$this->themeURL?>images/logo.png">
    <br><br>
</div>

<table class="container" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
    <tr>
        <td class="baslik">
            Merhaba Yetkili, <br>Web Siteniz Üzerinden İş Başvuru Formu Aldınız.
        </td>
    </tr>
    <tr>
        <td class="detay">
            <table class="table" width="100%" cellspacing="0" cellpadding="0">

                <tbody>
                <tr>
                    <th width="30%">T.C No</th>
                    <td><?=$tc_kimlik?></td>
                </tr>

                <tr>
                    <th>Adı Soyadı</th>
                    <td><?=$adi_soyadi?></td>
                </tr>

                <tr>
                    <th>E Posta</th>
                    <td><?=$email?></td>
                </tr>

                <tr>
                    <th>Doğum Yeri ve Tarihi</th>
                    <td><?=$dogum_yeri_ve_tarihi?></td>
                </tr>


                <tr>
                    <th>Cinsiyet / Medeni Hali / Çocuk Sayısı</th>
                    <td><?=$cinsiyeti_medeni_hali_cocuk_sayisi?></td>
                </tr>

                <tr>
                    <th>Ehliyeti</th>
                    <td><?=$ehliyet?></td>
                </tr>

                <tr>
                    <th>Askerlik Durumu</th>
                    <td><?=$askerlik_durumu?></td>
                </tr>

                <tr>
                    <th>Cep Telefonu</th>
                    <td><?=$cep_telefonu?></td>
                </tr>

                <tr>
                    <th>Adresi</th>
                    <td><?=$adresi?></td>
                </tr>

                <tr>
                    <th>Bilgisayar Bilgisi</th>
                    <td><?=$bilgisayar?></td>
                </tr>

                <tr>
                    <th>Mesleği</th>
                    <td><?=$meslegi?></td>
                </tr>


                <tr>
                    <th>İstediği Pozisyon</th>
                    <td><?=$istenilen_gorev?></td>
                </tr>

                <tr>
                    <th>İstediği Ücret</th>
                    <td><?=$istenilen_ucret?></td>
                </tr>

                <tr>
                    <th>Sigara Kullanımı</th>
                    <td><?=$sigara?></td>
                </tr>

                <tr>
                    <th>Hükümlülük Durumu</th>
                    <td><?=$hukumluluk?></td>
                </tr>

                <tr>
                    <th>Engel Durumu</th>
                    <td><?=$engel?></td>
                </tr>

                <tr>
                    <th>Seyahat Engeli</th>
                    <td><?=$seyahat?></td>
                </tr>

                <tr>
                    <th>Mezuniyet</th>
                    <td><?=$mezuniyet?></td>
                </tr>

                <tr>
                    <th>Önceki İşyeri</th>
                    <td><?=$eski_isyeri?></td>
                </tr>

                <tr>
                    <th>Mesajı</th>
                    <td><?=$not?></td>
                </tr>

                <tr>
                    <th>Başvuru Yaptığı Tarih</th>
                    <td><?=$tarih?></td>
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