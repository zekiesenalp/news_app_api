<?php 

/**
 * summary
 */

require "Controller.php";
require "../db.php";
class SiteController extends Controller
{
    /**
     * summary
     */
   
    public function index(){
    	echo "manga";
    }

    public function all_news(){
    	$db = new db();
        print_r(json_encode($db->news()));
    }

    public function all_category(){
        $db = new db();
        print_r(json_encode($db->cat_list()));
    }

    public function news_detail($id){
        $db = new db();
        print_r(json_encode($db->news_detail(db::temizle($id))));
    }
    public function get_uname($id){
        $db = new db();
        print_r(json_encode($db->user_name(db::temizle($id))));
    }
    public function news_count(){
        $db = new db();
        $dizi = $db->news_count();
       echo $dizi[0]["COUNT(*)"];
      //  print_r(json_encode($dizi[0]["COUNT(*)"]));
    }

    public function get_catname($id){
        $db = new db();
        print_r(json_encode($db->category_name(db::temizle($id))));
    }
    public function get_catid($name){
        $db = new db();
        print_r(json_encode($db->category_id(db::temizle($name))));
    }
    public function like($id){
        $db = new db();
        print_r(json_encode($db->news_like(db::temizle($id))));
    }
    public function un_like($id){
        $db = new db();
        print_r(json_encode($db->news_unlike(db::temizle($id))));
    }
    public function news_cat($id){
        $db = new db();
        print_r(json_encode($db->news_cat(db::temizle($id))));
    }
}
 ?>

