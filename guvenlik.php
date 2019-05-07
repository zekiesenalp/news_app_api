<?php
session_start();
/* Olusturulan kodu diger sayfalara tasiyabilmemiz icin oturum baslatiyoruz.
  0-999 araliginda bir sayi olusturup bunu md5 ile sifreliyoruz.
 */
$md5yap = md5(rand(0, 9999));

//md5 ile sifrelenen sayimizin uzunlugu 32 karakter olacaktir. Biz 6 karakterli alacagiz.
$dogrulamakodu2 = strtoupper(substr($md5yap, 8, 6));
$dogrulamakodu = strtolower($dogrulamakodu2);
//Dogrulama icin kullanicak kodumuzu acilan oturuma kaydediyoruz.
$_SESSION["security_code"] = $dogrulamakodu;

//Resim boyutlari belirleniyor
$en = 75;
$boy = 25;

//Uzerinde calisacagimiz resim olusturuluyor.
$image = ImageCreate($en, $boy);

//Beyaz,Siyah ve Kirmizi renkler olusturuyoruz. Rakamlar renkleri ifade etmektedir.
$beyaz = ImageColorAllocate($image, 255, 255, 255);
$siyah = ImageColorAllocate($image, 0, 0, 0);
$kirmizi = ImageColorAllocate($image, 242, 0, 0);

//Arka plani beyaz yapiyoruz
ImageFill($image, 0, 0, $siyah);

//Olusturulan dogrulama kodunu resime yaziyoruz.
ImageString($image, 6, 9, 5, $_SESSION["security_code"], $beyaz);



// Tarayiciya dosyamizin tipini yolluyoruz.
header("Content-Type: image/jpeg");

//Resmimizi Jpg formatinda basiyoruz.
ImageJpeg($image);

//Bir kereye mahsus kullanacagimiz icin siliyoruz.
ImageDestroy($image);
exit();
?>