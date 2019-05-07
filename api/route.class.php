<?php
	
	/**
	* Ahmet Manga
     * 2017
	*/
	class Route
	{
		private static $error = false;
		public static function get($pattern,$function){
			if(!is_string($pattern)){
				echo "1. Parametre String Olmak Zorunda. <br>";
				exit;
			}
			if(!is_string($function) && !is_callable($function)){
				echo "2. Parametre String Yada Fonksiyon Olabilir.";
			}

			if($pattern != "/"){
				$pattern = "/".$pattern;
			}
			self::run($pattern,$function,"GET");
		}
		public static function post($pattern,$function){
			if(!is_string($pattern)){
				echo "1. Parametre String Olmak Zorunda. <br>";
				exit;
			}
			if(!is_string($function) && !is_callable($function)){
				echo "2. Parametre String Yada Fonksiyon Olabilir.";
			}

			if($pattern != "/"){
				$pattern = "/".$pattern;
			}
			self::run($pattern,$function,"POST");
		}
		private static function run($pattern,$function,$method){
			if(empty($pattern) || empty($function) || empty($method)){
				echo "Parametre Eksik. <br>";
				exit;
			}

			if(empty($_SERVER["PATH_INFO"])) $adres = "/"; else $adres = $_SERVER["PATH_INFO"];  
			if($adres == $pattern && $_SERVER["REQUEST_METHOD"] == $method){
				self::$error = true;
				if(!is_callable($function)){
					$exp = explode("@",$function);
					require($exp[0].".php");
					$object = new $exp[0]();
						if(class_exists($exp[0]) && method_exists($object,$exp[1])){
							call_user_func([$object,$exp[1]]);
						}
				}else{
					call_user_func($function);
				}
				exit;
			}else{
				$bol = explode("/",$adres);
				$pattern_str = $pattern;
				$pattern =  explode("/",$pattern);
				array_shift($bol);
				array_shift($pattern);

				$ortak = array_intersect($bol,$pattern);
				$ortak_sayi = count($ortak);
				if(!empty($ortak) && substr($pattern[$ortak_sayi],0,1) == "{" && $_SERVER["REQUEST_METHOD"] == $method){
					self::$error = true;
					$pattern_func = implode("/",$ortak);
					$different = array_diff($bol, $pattern);
					if(count($different) < substr_count($pattern_str,"{")){
						echo "Parametre gönderilmedi.";
						exit;
					}else{
							if(!is_callable($function)){
							$exp_3 = explode("@",$function);
							require($exp_3[0].".php");
							$object = new $exp_3[0];
							if(class_exists($exp_3[0]) && method_exists($object,$exp_3[1])){
								call_user_func_array([$object,$exp_3[1]],$different);
							}
							}else{
								call_user_func_array($function,$different);
							}
							exit;
					}
				}

			}

	}

	public static function error(){
		if(self::$error == false){
			require "Controller.php";
			header("Location:".Controller::$site_url);
		}
	}
}
?>