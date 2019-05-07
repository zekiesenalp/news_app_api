<?php


/**
 * summary
 */
class db
{
    /**
     * summary
     */
    private static $db = null;
    public function __construct(){
        if(self::$db == null){
            try{
                self::$db = new PDO("mysql:host=localhost;dbname=yazlab","root","");
                self::$db->exec("SET NAMES utf8");
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    public static function temizle($veri){
        $veri = trim($veri);
        $temiz_veri = strip_tags(htmlspecialchars($veri));
        $sansurle = array('CREATE','DELETE','SELECT','FROM','LIMIT','TABLE','MYISAM','ORDER','ASC','JOIN','BINARY','WHERE',"'", "\"");
        $editle = array('---','---','---','---','---','---','---','---','---','---','---','---','','');
        return str_replace($sansurle,$editle,$temiz_veri);
    }

    public static function giris_kontrol($email,$password){
        $data = self::$db->prepare("SELECT * FROM users WHERE username=:mail AND password=:pw");
        $data->execute(['mail'=>$email,'pw'=>$password]);
        if($data->rowCount() == 1) return $data->fetchAll(); else return false;
    }

    public function cat_list(){
        $data = self::$db->prepare("SELECT * FROM category ORDER BY id DESC");
        $data->execute();
        return $data->fetchAll();
    }
     public function news_count(){
        $data = self::$db->prepare("SELECT COUNT(*) FROM news");
        $data->execute();
        return $data->fetchAll();
    }

    public function cat_delete($id){
        $data = self::$db->prepare("DELETE FROM `category` WHERE `category`.`id` = :id");
        $sonuc = $data->execute(['id'=>$id]);
        return $sonuc;
    }
    public function category_add($category){

        $data = self::$db->prepare("INSERT INTO `category` (`id`, `name`) VALUES (NULL, :category)");
        $sonuc = $data->execute(['category'=>$category]);
        return $sonuc;
    }
    public function news_add($subject,$date,$cat,$text,$file_name,$user){
        $data = self::$db->prepare("INSERT INTO `news` (`id`, `user_id`, `subject`, `body`, `image`, `category`, `date`) VALUES (NULL, :user, :subject, :text, :image, :cat, :date);
");
        $sonuc = $data->execute(['user'=>$user,'subject' => $subject, 'text' => $text, 'image' => $file_name, 'cat' => $cat, 'date'=>$date]);
        return $sonuc;
    }

    public function news(){

           $data = self::$db->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 0,5"); // son 5 için limit..
           $data->execute();

           return $data->fetchAll();
    }

    public function news_cat($cat_id){

        $data = self::$db->prepare("SELECT * FROM news where category=:kid ORDER BY id DESC");
        $data->execute(['kid' => $cat_id]);
        return $data->fetchAll();
    }

    public function category_name($id){
        $data = self::$db->prepare("SELECT * FROM category WHERE id=:id");
        $data->execute(['id'=>$id]);
        $data->bindColumn("name",$veri["name"]);
        $data->fetch(PDO::FETCH_BOUND);
        return $veri["name"];
    }

    public function category_id($name){
        $data = self::$db->prepare("SELECT * FROM category WHERE name=:name");
        $data->execute(['name'=>$name]);
        $data->bindColumn("id",$veri["id"]);
        $data->fetch(PDO::FETCH_BOUND);
        return $veri["id"];
    }

    public function user_name($id){
        $data = self::$db->prepare("SELECT * FROM users WHERE id=:id");
        $data->execute(['id'=>$id]);
        $data->bindColumn("name",$veri["name"]);
        $data->fetch(PDO::FETCH_BOUND);
        return $veri["name"];
    }
    public function news_like($id){
        $data = self::$db->prepare("UPDATE `news` SET `n_like` = `n_like` + 1 WHERE `news`.`id` = :id;;");
        $islem = $data->execute(['id'=>$id]);
        return $islem;
    }
    public function news_unlike($id){
        $data = self::$db->prepare("UPDATE `news` SET `n_unlike` = `n_unlike` + 1 WHERE `news`.`id` = :id;;");
        $islem = $data->execute(['id'=>$id]);
        return $islem;
    }
    public function news_detail($id){
        $data2 = self::$db->prepare("UPDATE `news` SET `read_count` = `read_count` + 1 WHERE `news`.`id` = :id;");
        $islem2 = $data2->execute(['id'=>$id]);

        $data = self::$db->prepare("SELECT * FROM news WHERE id=:id");
        $data->execute(['id'=>$id]);
        $data->bindColumn("user_id",$veri["user_id"]);
        $data->bindColumn("subject",$veri["subject"]);
        $data->bindColumn("body",$veri["body"]);
        $data->bindColumn("image",$veri["image"]);
        $data->bindColumn("category",$veri["category"]);
        $data->bindColumn("date",$veri["date"]);
        $data->bindColumn("read_count",$veri["read_count"]);
        $data->bindColumn("n_like",$veri["n_like"]);
        $data->bindColumn("n_unlike",$veri["n_unlike"]);
        $data->fetch(PDO::FETCH_BOUND);
        return $veri;
    }

    public function news_delete($id){
        $data = self::$db->prepare("DELETE FROM `news` WHERE `news`.`id` = :id");
        $sonuc = $data->execute(['id'=>$id]);
        return $sonuc;
    }

}
?>