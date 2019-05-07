<?php include 'header.php';
$id = $_GET["id"]+0;
$news = $db->news_detail($id);
?>
<div class="col-md-12"><div class="panel panel-default">

        <div class="panel-body"><h2 class="page-header"><?php echo $news["subject"]; ?></h2>


            <p>Tarih: <?php echo $news["date"]; ?> | Yazan: <?php echo $db->user_name($news["user_id"]); ?> | Kategori:
                <a href="index.php?kat_id=<?php echo $news["category"]; ?>"><?php echo $db->category_name($news["category"]); ?></a></p>

    <img src="dosyalar/<?php echo $news["image"]; ?>" width="300" height="300">

            <br />
            <?php echo $news["body"]; ?>



        </div>
        <div class="panel-footer">
           Okunma Sayısı: <?php echo $news["read_count"]; ?> | <a href="detay.php?id=<?php echo $id;?>&islem=like"><span class="glyphicon glyphicon-thumbs-up"></span></a> <?php echo $news["n_like"]; ?> | <a href="detay.php?id=<?php echo $id;?>&islem=un"><span class="glyphicon glyphicon-thumbs-down
"></span></a>  <?php echo $news["n_unlike"]; ?>
        </div>
    </div></div>
    </div></div>


<?php
if($_GET["islem"] == "like"){
    $db->news_like($id);

}else if($_GET["islem"] == "un"){
    $db->news_unlike($id);
}


include 'footer.php'; ?>
