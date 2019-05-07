<?php include 'header.php'; ?>
<?php if($_SESSION["username"] != ""){?>
<div class="col-md-9">
    <div class="panel panel-default">
<table class="table table-responsive table-responsive">
    <thead><tr><th>ID</th> <th>İsim</th> <th></th></tr></thead>
    <tbody><?php
    $cat = $db->cat_list();

    foreach ($cat as $data){

        ?>
        <tr><th><?php echo $data["id"]; ?></th> <th><?php echo $data["name"]; ?></th> <th><a href="kategori.php?id=<?php echo $data["id"]; ?>" class="btn btn-danger">Sil</a></th></tr>
    <?php
    }
    ?></tbody>
</table>
    </div></div>
<?php if(!empty($_GET["id"])){
    if($db->cat_delete($_GET["id"]+0)){
        $_SESSION['hata'] = "Kategori silindi";
        $_SESSION['tur'] = "success";
        header("Location:kategori.php");
    }else{
        $_SESSION['hata'] = "HATA ALINDI";
        $_SESSION['tur'] = "danger";
        header("Location:kategori.php");
    }
} } include 'footer.php'; ?>
