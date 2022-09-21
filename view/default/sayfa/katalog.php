<?
/* @var $this FrontClass|Loader object */
$dil_ekle = ($lang != "tr") ? $lang."/" : "";
    $sayfa = "katalog";
    $baslik = $this->lang->header("katalog");
    $this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);
    $katalog = $this->dbLangSelect("katalog", "aktif = 1", "resim");
?>


<?
    echo $this->_include('bolum/sayfa',[
        "baslik" => $baslik,
        "contentClass"=>"service-details pt-60 pb-60",
        "page" => $sayfa,
        //'breadcrumbs' => array(array("title"=>$baslik)),
        'type' => "open",
        'row'=>false,
    ], $this->theme);
?>
    <div class="row team-members">

            <div class="col-lg-8  order-lg-1">
                <div class="single-item">

                        <div class="row">

                        <?
                            if (is_array($katalog)) {
                                foreach ($katalog as $item) {
                                $resim = $this->dbResimAl($item["resim"], "katalog", $this->getmodulinfo("katalog")["big"], true);
                            ?>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="team-member position-relative">
                                            <div class="member-picture-wrap mb-0">
                                                <div class="member-picture">
                                                    <img src="<?=$resim?>" alt="<?=$this->temizle($item["baslik"])?>">
                                                    <div class="social-icons">
                                                        <a href="#">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="member-desc">
                                                <h3 class="name"><?=$this->temizle($item["baslik"])?></h3>
                                            </div>
                                            <a target="_blank" href="<?=$this->baseURL($dil_ekle."e-katalog.html/".$item[$mid."id"])?>" class="stretched-link"   title="<?=$item["baslik"]?>"></a>
                                        </div>
                                    </div>

                            <?
                                    }
                                }
                            else {
                                    echo "<div class='col-md-12'><div class='alert alert-warning text-center fs-25'>".$this->lang->genel("yapim")."</div> </div>";
                                }
                        ?>

                        </div>


                    </div>
                </div>

            <div class="col-lg-4 order-lg-0">

                <div class="sidebar">
                    <div class="widget cat-widget mt-40 mt-lg-0">
                        <h4 class="widget-title"><?=$this->lang->header("multimedya")?></h4>
                        <ul>
                            <li>
                                <a href="<?=$this->langLink("foto-galeri")?>"><?=$this->lang->header("foto-galeri")?></a>
                            </li>
                            <li>
                                <a href="<?=$this->langLink("video-galeri")?>"><?=$this->lang->header("video-galeri")?></a>
                            </li>
                            <li class="active">
                                <a href="<?=$this->langLink("katalog")?>"><?=$this->lang->header("e-katalog")?></a>
                            </li>
                            <li>
                                <a href="<?=$this->langLink("renk-kartelası")?>"><?=$this->lang->header("renk-kartelası")?></a>
                            </li>
                            <li>
                                <a href="<?=$this->langLink("haberler")?>"><?=$this->lang->header("haberler")?></a>
                            </li>
                        </ul>
                    </div>

                </div>


            </div>


</div>




<?
    echo $this->_include('bolum/sayfa',["type"=>"close"], $this->theme);
?>