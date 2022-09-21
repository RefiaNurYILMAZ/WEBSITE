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
    <img src="<?=$this->themeURL?>img/logo.png">
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

                <? if ($resim != ""):?>
                    <tr>
                        <td colspan="2" align="center" style="text-align: center;">
                            <img src="<?=$resim?>" style="height: 150px; width: auto;" height="150" width="auto">
                        </td>
                    </tr>
                <? endif; ?>

                <? if (!empty($cv)):?>
                    <tr><th>CV: </th><td><a href="<?=$cv?>" target="_blank">CV İndirmek İçin Tıklayınız</a></td></tr>
                <? endif; ?>

                <?
                if ($tc_kimlik != ""){
                    ?>

                    <tr><th>T.C. Kimlik No.</th><td><?=$tc_kimlik?></td></tr>
                    <?
                }

                if ($adi_soyadi != ""){
                    ?>

                    <tr><th>Adınız Soyadınız</th><td><?=$adi_soyadi?></td></tr>

                    <?
                }

                if ($cinsiyet != ""){
                    ?>

                    <tr><th>Cinsiyet</th><td><?=$cinsiyet?></td></tr>


                    <?
                }

                if ($boy != ""){
                    ?>

                    <tr><th>Boy</th><td><?=$boy?></td></tr>

                    <?
                }

                if ($kilo != ""){
                    ?>

                    <tr><th>Kilo</th><td><?=$kilo?></td></tr>


                    <?
                }

                if ($dogum_yeri_ve_tarihi != ""){
                    ?>

                    <tr><th>Doğum Tarihi</th><td><?=$dogum_yeri_ve_tarihi?></td></tr>

                    <tr><th>İkametgah İli</th><td><?=$ik_il?></td></tr>

                    <tr><th>İkametgah İlçesi</th><td><?=$ik_ilce?></td></tr>

                    <?
                }

                if ($adresi != ""){
                    ?>



                    <tr><th>İkametgah Adresi</th><td><?=$adresi?></td></tr>


                    <?
                }

                if ($calismak_istenen_yer != ""){
                    if ($calismak_istenen_yer == "1001"){
                        $text = "Herhangi birisi olabilir";
                    }else {
                        $text = $this->temizle($this->tekSorgu("SELECT * FROM sube WHERE id = $calismak_istenen_yer and sil <> 1")["baslik"]);
                    }

                    ?>



                    <tr><th>Çalışmak İstediği Yer</th><td><?=$text?></td></tr>

                    <?
                }

                if ($cep_telefonu != ""){
                    ?>

                    <tr><th>İletişim</th><td><?=$cep_telefonu?></td></tr>


                    <?
                }

                if ($meslek != ""){
                    ?>

                    <tr><th>Mesleğiniz</th><td><?=$meslek?></td></tr>
                    <?
                }

                if ($ehliyet != ""){
                    ?>

                    <tr><th>Ehliyetiniz Varsa (Sınıfı)</th><td><?=$ehliyet?></td></tr>

                    <?
                }

                if ($askerlik != ""){
                    ?>

                    <tr><th>Askerlik Durumu</th><td><?=$askerlik?></td></tr>

                    <?
                }

                if ($tecil_tarih != ""){
                    ?>

                    <tr><th>Askerlik Tecilli ise tarihi</th><td><?=$tecil_tarih?></td></tr>

                    <?
                }

                if ($rahatsizlik != ""){
                    ?>

                    <tr><th>Kalıcı Rahatsızlığınız Var mı?</th><td><?=$rahatsizlik?></td></tr>



                    <?
                }

                if ($tahsil != ""){
                    ?>

                    <tr><th>Tahsil Durumu</th><td><?=$tahsil?></td></tr>

                    <?
                }

                if ($medeni_hal != ""){
                    ?>

                    <tr><th>Medeni Haliniz</th><td><?=$medeni_hal?></td></tr>

                    <?
                }

                if ($cocuk_sayisi != ""){
                    ?>

                    <tr><th>Kaç Çocuğunuz var</th><td><?=$cocuk_sayisi?></td></tr>


                    <?
                }
                if ($engellilik != ""){
                    ?>

                    <tr><th>Engellilik Durumu</th><td><?=$engellilik?></td></tr>

                    <?
                }

                if ($sabika != ""){
                    ?>

                    <tr><th>Sabıkanız Var mı?</th><td><?=$sabika?></td></tr>

                    <?
                }

                if ($icra_takibi != ""){
                    ?>

                    <tr><th>İcra Takibiniz Var mı?</th><td><?=$icra_takibi?></td></tr>



                    <?
                }

                if ($istenen_bolum != ""){
                    ?>

                    <tr><th>Hangi Bölümde Çalışmak İstersiniz ?</th><td><?=$istenen_bolum?></td></tr>

                    <?
                }

                if ($kurslar != ""){
                    ?>

                    <tr><th>Katıldığınız Kurs ve Seminerler</th><td><?=$kurslar?></td></tr>
                    <?
                } if ($aile_calisan != ""){
                    ?>
                    <tr><th>Ailede Çalışan Var mı?</th><td><?=$aile_calisan?></td></tr>
                    <?
                } if ($aile_calisan != ""){
                    ?>
                    <tr><th>Referanslar</th><td><?=$referans?></td></tr>
                    <?
                }
                ?>

                <tr><th>Başvuru Tarihi</th><td><?=$basvuru_tarihi?></td></tr>


                </tbody>
            </table>

            <br><br>
            <table class="table" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <th colspan="2" align="center"><b>GEÇMİŞTE ÇALIŞTIĞI İŞYERLERİ</b></th>
                </tr>
                </tbody>
            </table>

            <table class="table" width="100%" cellspacing="0" cellpadding="0">
                <tbody>

                <?
                if ($firma_adi_1 != ""){
                    ?>
                    <tr><th width="30%">Firma Adı</th><td><?=$firma_adi_1?></td></tr>
                    <?
                }

                if ($firma_telefon_1 != ""){
                    ?>
                    <tr><th>Firma İrtibat Telefon</th><td><?=$firma_telefon_1?></td></tr>
                    <?
                }

                if ($firma_gorev_1 != ""){
                    ?>
                    <tr><th>Göreviniz</th><td><?=$firma_gorev_1?></td></tr>

                    <?
                }

                if ($calisma_suresi_1 != ""){
                    ?>
                    <tr><th>Çalışma Süresi</th><td><?=$calisma_suresi_1?></td></tr>
                    <?
                }

                if ($ayrilik_nedeni_1 != ""){
                    ?>
                    <tr style="border-bottom:1px solid #ccc;"><th>Ayrılık Nedeniniz</th><td><?=$ayrilik_nedeni_1?></td></tr>
                    <?
                }
                ?>

                </tbody>
            </table>
            <br>
            <table class="table" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <?
                if ($firma_adi_2 != ""){
                    ?>

                    <tr><th width="30%">Firma Adı</th><td><?=$firma_adi_2?></td></tr>

                    <?
                }

                if ($firma_telefon_2 != ""){
                    ?>
                    <tr><th>Firma İrtibat Telefon</th><td><?=$firma_telefon_2?></td></tr>
                    <?
                }

                if ($firma_gorev_2 != ""){
                    ?>
                    <tr><th>Göreviniz</th><td><?=$firma_gorev_2?></td></tr>

                    <?
                }

                if ($calisma_suresi_2 != ""){
                    ?>
                    <tr><th>Çalışma Süresi</th><td><?=$calisma_suresi_2?></td></tr>
                    <?
                }

                if ($ayrilik_nedeni_2 != ""){
                    ?>
                    <tr style="border-bottom:1px solid #ccc;"><th>Ayrılık Nedeniniz</th><td><?=$ayrilik_nedeni_2?></td></tr>
                    <?
                }
                ?>

                </tbody>
            </table>
            <br>
            <table class="table" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <?
                if ($firma_adi_3 != ""){
                    ?>

                    <tr><th width="30%">Firma Adı</th><td><?=$firma_adi_3?></td></tr>

                    <?
                }

                if ($firma_telefon_3 != ""){
                    ?>

                    <tr><th>Firma İrtibat Telefon</th><td><?=$firma_telefon_3?></td></tr>
                    <?
                }

                if ($firma_gorev_3 != ""){
                    ?>
                    <tr><th>Göreviniz</th><td><?=$firma_gorev_3?></td></tr>

                    <?
                }

                if ($calisma_suresi_3 != ""){
                    ?>
                    <tr><th>Çalışma Süresi</th><td><?=$calisma_suresi_3?></td></tr>
                    <?
                }

                if ($ayrilik_nedeni_3 != ""){
                    ?>
                    <tr><th>Ayrılık Nedeniniz</th><td><?=$ayrilik_nedeni_3?></td></tr>
                    <?
                }

                ?>
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