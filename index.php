<?php include 'header.php'; ?>



<div class="col-md-3">
   					<div class="panel panel-primary">
   					<div class="panel-heading">Kategoriler</div>
   						<div class="panel-body"><?php $cat = $db->cat_list(); foreach ($cat as $value){?>
                                <p><a href="index.php?kat_id=<?php echo $value["id"]; ?>"><?php echo $value["name"];?></a></p><?php } ?></div>
   					</div>

   				</div>
   				<div class="col-md-9">
                    <div class="panel panel-default">
                        <table class="table table-responsive table-responsive">
                            <thead><tr><th>Konu</th> <th>Resim</th> <th>Tarih</th><th>User</th><th>Kategori</th></tr></thead>
                            <tbody><?php

                            if(empty($_GET["kat_id"])) $new = $db->news(); else $new = $db->news_cat($_GET["kat_id"]+0);

                            foreach ($new as $data){

                                ?>
                                <tr><th><a href="detay.php?id=<?php echo $data["id"]; ?>"><?php echo $data["subject"]; ?></a></th> <th><img src="dosyalar/<?php echo $data["image"];?>" width="150" height="150"></th>
                                    <th><?php echo $data["date"];?> </th>
                                    <th><?php echo $db->user_name($data["user_id"]);?></th>
                                    <th><a href="index.php?kat_id=<?php echo $data["category"];?>"><?php echo $db->category_name($data["category"]); ?></a></th>
                                    <th><a href="detay.php?id=<?php echo $data["id"]; ?>" class="btn btn-primary">Görüntüle</a> <?php if($_SESSION["username"] != ""){ ?> <a href="index.php?id=<?php echo $data["id"]; ?>" class="btn btn-danger">Sil</a> <?php } ?></th></tr>
                                <?php
                            }
                            ?></tbody>
                        </table>
                    </div></div>


<?php
if(!empty($_GET["id"]) && $_SESSION["login_status"] != ""){
    if($db->news_delete($_GET["id"]+0)){
        $_SESSION['hata'] = "Haber silindi";
        $_SESSION['tur'] = "success";
        header("Location:index.php");
    }else{
        $_SESSION['hata'] = "HATA ALINDI";
        $_SESSION['tur'] = "danger";
        header("Location:index.php");
    }
}


include 'footer.php'; ?>

   			
