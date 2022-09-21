<?
/* @var $this FrontClass|Loader object */

    $table = "katalog";
    $sayfa = "documents";

    $baslik = $this->lang->header("documents");
    $this->sayfaBaslik = $baslik." - ".$this->ayarlar("title_".$lang);
	$kosul = 'aktif = 1 and baslik <> ""';

	if($id){
		$kosul.= ' and kid = '.$id;
		$kat = $this->dbLangSelectRow('proje_kategori', ['id'=>$id, 'master_id'=>$id]);
	}

	$veri  = $this->dbLangSelect($table, $kosul);
	$kategoriler = $this->dbLangSelect("proje_kategori", 'aktif = 1');
?>


<div class="page-content bg-white">


		<section class="content-inner bg-white">
			<div class="container">
				<div class="section-head text-center style-1">
					<?php if($id):?>
						<h5 class="text-primary sub-title"><?=$this->temizle($kat['baslik'])?></h5>
					<?php endif; ?>
					<h3 class="title"><?=$baslik?></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-3  col-sm-12 m-b30">
						<aside class="side-bar sticky-top right">
							
							<div class="service_menu_nav widget style-1">
								<ul class="menu">
									<?php foreach($kategoriler as $kat): ?>
										<li class="menu-item"><a  class="<?=(($id == $kat[$mid.'id']) ? 'active' : '')?>" href="<?=$this->getURL($kat, 'documents')?>"><?= $this->temizle($kat["baslik"])?></a></li>	
									<?php endforeach ?>
								</ul>
							</div>
							
						</aside>
					</div>

					<div class="col-lg-9">

							<?
						
								if (is_array($veri)){
									foreach ($veri as $item){
										$dosya = $this->tekSorgu('SELECT * FROM dosyalar WHERE type = "katalog" and tur = "dosya" and data_id = '.$item[$mid.'id']);
										if($dosya):
											$par = explode(".", $dosya["dosya"]);
											$uzanti = $par[count($par) - 1];
											$filesize = filesize(str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME'])."/upload/katalog/".$dosya["dosya"]);
											$title = $this->temizle($item["baslik"]);
								?>

										<a href="<?=$this->baseURL("download/index.php?document=".$dosya["dosya"]."&dir=katalog&title=".$title)?>">		
											<div class="icon-bx-wraper left style-2 m-b30">
												<div class="icon-bx-sm radius bg-primary"> 
													<span href="javascript:void(0);" class="icon-cell text-white">
														<i class="fa fa-file-<?=$uzanti?>"></i>
													</span> 
												</div>
												<div class="row align-items-center w-100">
													<div class="col-sm-8">
														<h5 class="dz-title mb-sm-0 mb-2"><?=$title?></h5>
													</div>
													<div class="col-sm-4 text-end">
														<h6 class="m-b0"> <?=$this->lang->genel("indir")?> <br>[<?=$this->formatSizeUnits($filesize)?>]</h6>
													</div>
												</div>
											</div>
										</a>
										<?php endif; ?>
								



								<?  } ?>

						</ul>
					</div>


				<? } else {
					echo "<div class='col-md-12'><div class='alert alert-warning' style='font-size: 110%; text-align: center'>".$this->lang->genel("no_record")."</div></div> ";
				} ?>

				</div>

				
					
					
				</div>
			</div>
		</section>


</div>