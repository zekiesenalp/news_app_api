<?php include 'header.php'; ?>
<?php if($_SESSION["username"] != ""){?>
    <div class="col-md-12"> <div class="panel panel-primary panel-body">

            <form id="giris_form" class="form-group" role="form" method="post">
                <div class="form-group">

                    <label>Kategori Adı</label>

                    <input type="text" name="category" placeholder="Kategori Adı" class="form-control" required>
                </div>

                <input type="submit" name="ekle" id="ekle" value="Ekle" class="btn btn-primary btn-lg">
            </form>
        </div></div>
    <?php if($_POST['ekle']){


        $category = $db->temizle($_POST["category"]);
        if(empty($category)){
            $_SESSION['hata'] = "Kategori Boş";
            $_SESSION['tur'] = "danger";
            header("Location:kategori_ekle.php");
        }else{
            if($db->category_add($category)){
                $_SESSION['hata'] = "Kategori eklendi.";
                $_SESSION['tur'] = "success";

                header("Location:kategori.php");

            }else{
                $_SESSION['hata'] = "HATA ALINDI";
                $_SESSION['tur'] = "danger";
                header("Location:kategori_ekle.php");
            }
        }


    } ?>

<?php } include 'footer.php'; ?>
