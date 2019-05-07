<?php include 'header.php'; ?>
<?php if($_SESSION["username"] != "") { ?>
    <div class="col-md-12">
        <div class="panel panel-primary panel-body">

            <form id="form" enctype="multipart/form-data" class="form-group" role="form" method="post">
                <div class="form-group">

                    <label>Konu</label>

                    <input type="text" name="subject" placeholder="Konu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Resim: <input type="file" class="btn btn-danger" name="dosya"></label>

                </div>
                <div class="form-group">

                    <label>Kategori</label>

                    <select name="category" class="input-lg"><?php $category = $db->cat_list();
                        foreach ($category as $data) { ?>
                            <option value="<?php echo $data["id"]; ?>"><?php echo $data["name"]; ?></option><?php } ?>
                    </select>
                </div>
                <div class="form-group">

                    <label>Tarih</label>

                    <input type="date" name="date" placeholder="Tarih" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Yazı</label>

                    <textarea name="body" id="body"></textarea>
                   <!---
                   	 <script>
                        CKEDITOR.replace('body');
                    </script>
						--->
                </div>
                <input type="submit" name="ekle" id="ekle" value="Yazı Ekle" class="btn btn-primary btn-lg">
            </form>
        </div>
    </div>

    <?php

    if ($_POST['ekle']) {


        $subject = $db->temizle($_POST["subject"]);
        $cat = $db->temizle($_POST["category"]);
        $date = $db->temizle($_POST["date"]);
        $text = $_POST["body"];
        if (empty($cat) || empty($subject) || empty($date) || empty($text) || $_FILES['file']['dosya']) {
            $_SESSION['hata'] = "Tüm alanlari doldurun.";
            $_SESSION['tur'] = "danger";
            header("Location:kategori_ekle.php");
        } else {
            $tur = ['image/jpeg', 'image/png', 'image/gif', 'image/x-png', 'image/jpg'];
            $uzantilar = ['jpg', 'png', 'gif', 'x-png', 'jpg'];

            $ad = $_FILES['dosya']['name'];
            $bol = explode(".", $ad);
            $uzanti = $bol[count($bol) - 1];
            $yeni_isim = substr(md5(rand(0, 9999999999)), -6) . "." . $uzanti;


            if (in_array($_FILES['dosya']['type'], $tur) && $_FILES['dosya']['size'] <= 2097152 && in_array($uzanti, $uzantilar)) {
                move_uploaded_file($_FILES['dosya']['tmp_name'], 'dosyalar/' . $yeni_isim);
            } else {
                $_SESSION['hata'] = "Dosya türü uygun değil. Tekrar deneyin.";
                $_SESSION['tur'] = "danger";
                header("Location:kategori_ekle.php");
            }
            if ($db->news_add($subject, $date, $cat, $text, $yeni_isim, $_SESSION["login_status"])) {
                $_SESSION['hata'] = "Yazı eklendi";
                $_SESSION['tur'] = "success";
                header("Location:index.php");

            } else {
                $_SESSION['hata'] = "Hata alındı. Tekrar deneyin.";
                $_SESSION['tur'] = "danger";
                header("Location:kategori_ekle.php");
            }
        }
    }
}
include 'footer.php'; ?>
