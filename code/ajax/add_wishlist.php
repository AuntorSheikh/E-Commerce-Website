<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Wishlist.php');
include_once ($filepath.'/../lib/Session.php');
Session::init();
$login = Session::get('cuslogin');
$cmrId = Session::get('cmrId');
$menu = new Wishlist();
$data = '';
if(!$login){
	if (isset($_POST['getid'])) {
   		$data = $menu->insertIntoWishlist($_POST['getid'],$_POST['ssid']);
	}
}else{
 	$data = $menu->addToWishlist($cmrId,$_POST['getid']); 
}
echo $data;
	
?>

