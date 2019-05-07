<?php include 'header.php'; ?>
    <div class="col-md-12"> <div class="panel panel-primary panel-body">

            <form id="giris_form" class="form-group" role="form" method="post">
                <div class="form-group">

                    <label>E-Mail Adresi</label>

                    <input type="email" name="mail" placeholder="E-Mail" class="form-control" required>
                </div>
                <div class="form-group">

                    <label>Şifre</label>

                    <input type="password" name="sifre" placeholder="Şifre" class="form-control" required>
                </div>
                <div class="form-group">

                    <label>Güvenlik Kodu &nbsp;&nbsp;&nbsp;&nbsp; <img src="guvenlik.php"></label>

                    <input type="text" name="guvenlik" placeholder="Güvenlik Kodu" class="form-control" required>
                </div>
                <input type="submit" name="giris" id="giris" value="Giriş Yap" class="btn btn-primary btn-lg">
            </form>
        </div></div>

    <?php

if($_POST['giris']){
    if($_SESSION["security_code"] == $_POST["guvenlik"]){

        $email = $db->temizle($_POST["mail"]);
        $sifre = md5($db->temizle($_POST["sifre"]));
        if(empty($email) || empty($sifre)){
            $_SESSION['hata'] = "Kullanici Adi veya Şifre Boş";
            $_SESSION['tur'] = "danger";
            header("Location:giris.php");
        }else{
            if($response = $db->giris_kontrol($email,$sifre)){
                $_SESSION['hata'] = "Giriş yapıldı.";
                $_SESSION['tur'] = "success";
                $_SESSION['login_status'] = $response[0]["id"];
                $_SESSION['username'] = $response[0]["name"];
                header("Location:index.php");

            }else{
                $_SESSION['hata'] = "Kullanıcı adı veya şifre hatalı.";
                $_SESSION['tur'] = "danger";
                header("Location:giris.php");
            }
        }
    }else{
        $_SESSION['hata'] = "Güvenlik kodu hatalı.";
        $_SESSION['tur'] = "danger";
        header("Location:giris.php");
    }

}

?>
<?php include 'footer.php'; ?>
