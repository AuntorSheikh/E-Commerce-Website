<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
Session::init();
$login = Session::get('cuslogin');
$cmrId = Session::get('cmrId');
$connect = mysqli_connect("localhost","root","","cse311");
if(!$login){
	if (isset($_POST['cus_id'])) {
$sql = "UPDATE tbl_cart SET quantity='".$_POST['value']."' WHERE cart_id='".$_POST['cus_id']."'";
	}
}
else{
		if (isset($_POST['cus_id'])) {
 $sql = "UPDATE tbl_customer_cart SET quantity='".$_POST['value']."' WHERE cus_cart_id='".$_POST['cus_id']."'";
	}
}

$result = mysqli_query($connect, $sql);
if ($result) {
	echo $_POST['value'];
}else{
	echo 'false';
}

 
?>

