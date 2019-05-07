<?php
	ob_start();
	session_start();
	header("Cache-Control:public");
	error_reporting(0);
	require('route.class.php');

	route::get('asd','SiteController@index');
	route::get('all_news','SiteController@all_news');
    route::get('all_category','SiteController@all_category');
    route::get('news/{id}','SiteController@news_detail');
    route::get('get_username/{id}','SiteController@get_uname');
    route::get('get_catname/{id}','SiteController@get_catname');
    route::get('get_catid/{name}','SiteController@get_catid');
    route::get('like/{id}','SiteController@like');
    route::get('un_like/{id}','SiteController@un_like');
    route::get('news_cat/{id}', 'SiteController@news_cat');
    route::get('news_count', 'SiteController@news_count');
	route::error();

?>