<?php session_start(); ob_start(); error_reporting(0);
include 'db.php';
$db = new db(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<!-- Ahmet Manga -->
	<link rel="stylesheet" type="text/css" href="css/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/css/bootstrap-theme.css">
	<script type="text/javascript" src="css/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="css/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<meta name="viewport" content="width=device-width; initial-scale=1">
	<title>Blog</title>
	<script type="text/javascript" src="js/site.js"></script>
	<style type="text/css">
			.back-to-top {
			position: fixed;
			left:20px;
			bottom:80px;
			display: none;
						}

	</style>
	<script type="text/javascript">
	$(document).ready(function(){
			$(window).scroll(function(){
					var yukseklik = $(this).scrollTop();
					if(yukseklik>50){
						$("#back-to-top").fadeIn();
					}else{
						$("#back-to-top").fadeOut();
					}
			});
			$("#back-to-top").click(function(){
					$("body,html").animate({
						'scrollTop':'0px'
					},800);
					return false;
			});
	});
	</script>
</head>
<body>

<div id="ust_div" class="container-fluid">
	<div class="container-fluid" style="width: 90%">
   		<div class="row">
   			<div class="col-md-12">
   				<nav id="ust" class="navbar navbar-inverse">
   				<div class="navbar-header">
   					<div class="navbar-brand">

   						<input type="color" name="renk_sec" value="#ff0000">
   					</div>
   					<button class="navbar-toggle" data-toggle="collapse" data-target="#ackapa"><div class="icon-bar"></div><div class="icon-bar"></div><div class="icon-bar"></div></button>
   				</div>

   					<div class="collapse navbar-collapse navbar-static-top" id="ackapa">
   					<ul class="nav navbar-nav">
   						<div class="collapse navbar-collapse">
   						<form id="giris_form" class="navbar-form" type="get" action="index.php">
   							<input type="text" class="form-control" name="ara" placeholder="Arama yap.">
   							<input type="submit" name="ara-yap" value="Ara" class="btn btn-primary">
   							</form>
   						</div>

   					</ul>

   					<ul class="nav navbar-nav navbar-right">
                        <?php if($_SESSION["username"] != ""){ ?><li><a>Hoşgeldiniz, <?php echo $_SESSION["username"]; ?></a></li> <?php }?>
   							<li class="active"><?php if($_SESSION["login_status"] != ""){ ?> <a href="cikis.php"><span  class="glyphicon glyphicon-log-in"></span>&nbsp;Çıkış Yap</a> <?php } else{ ?> <a href="giris.php"><span  class="glyphicon glyphicon-log-in"></span>&nbsp;Giriş Yap</a> <?php } ?></li>
   							


   					</ul>
   					</div>
   				</nav>


   			<div class="row">
   			<div class="col-md-12" style="text-align: center;margin-top:-20px">
   			<img src="https://wp-themes.com/wp-content/themes/graphene/images/headers/flow.jpg" class="img-rounded img-responsive">

   			</div>
   			</div>
   			<div class="row">
   			<div class="col-md-12">
   				<nav id="alt" class="navbar navbar-inverse">
   					<button class="navbar-toggle" data-toggle="collapse" data-target="#menuackapa"><div class="icon-bar"></div><div class="icon-bar"></div> <div class="icon-bar"></div></button>
   					<div class="collapse navbar-collapse" id="menuackapa">
   					<ul class="nav navbar-nav">
   						<li class="active"><a href="index.php">Anasayfa</a></li>
                        <?php if($_SESSION["username"] != ""){ ?>

   						<li><a href="yazi_ekle.php">Yazı Ekle</a></li>
   						<li><a href="kategori.php">Kategoriler</a></li>
   						<li><a href="kategori_ekle.php">Kategori Ekle</a></li>

                        <?php } ?>
   					</ul>


   					</div>
   				</nav>
   			</div>
   			</div>
   			<div class="row">
                <?php if(!empty($_SESSION["hata"])){
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-<?php echo $_SESSION["tur"]; ?>">
                            <?php echo $_SESSION["hata"]; ?>
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                        </div>
                    </div>
                    <?php unset($_SESSION["hata"]); unset($_SESSION["tur"]); }?>
   				