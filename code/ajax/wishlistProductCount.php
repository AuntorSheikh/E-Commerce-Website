<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Wishlist.php');
include_once ($filepath.'/../lib/Session.php');

$menu = new Wishlist();
$data = '';
session_start();
$ssid = session_id();
$men = $menu->CountWishlistItem($ssid);
$row = mysqli_fetch_array($men);

echo  $row['count'] ;
	
?>

