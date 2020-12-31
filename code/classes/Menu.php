<?php 

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 include_once ('Wishlist.php');

class Menu
{
	private $db;
	private $fm;
	private $wishlist;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
		$this->wishlist = new Wishlist();
	}
	function getAllCartItemBySsid($ssid){ //retrieve all cart product by id
		$sql ='SELECT * FROM tbl_cart WHERE ssid="'.$ssid.'"';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
	function getAllCartItemBycusid($dd){ //retrieve all cart product by id
		$sql ='SELECT * FROM tbl_customer_cart WHERE cus_id="'.$dd.'"';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
	function allBrand(){
		$sql ='SELECT * FROM tbl_brand';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
	function CountCartItem(){
		$logCheck = Session::get('cuslogin');
		$ssid = session_id();
		$cus_id = Session::get('cmrId');
		if (!$logCheck) {
			$sql ='SELECT count(*) as count FROM tbl_cart WHERE ssid="'.$ssid.'"';
			$fetchAll = $this->db->select($sql);
		}else{
			$sql ='SELECT count(*) as count FROM tbl_customer_cart WHERE cus_id="'.$cus_id.'"';
			$fetchAll = $this->db->select($sql);
		}
		return $fetchAll;
		
	}
	function allCategory(){
		$sql ='SELECT * FROM tbl_category';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
	function insertIntoCart($id,$ssid){
		$sql ='SELECT * FROM tbl_cart WHERE ssid="'.$ssid.'" AND product_id ="'.$id.'"';
		$value = $this->db->select($sql);
		if ($value) {
			$msg = 'Already Exists this product in cart';
		}else{
			$sql ="insert into tbl_cart(ssid, product_id,product_name,product_price,product_image,quantity) 
			select '".$ssid."', product_id, product_name, product_price, product_image, 1 from tbl_product where product_id='".$id."'";
			$insert = $this->db->insert($sql);
			if ($insert) {
				$msg = 'Added success';
			}
		}
		return $msg;
	}

	public function delCustomerCart($ssid){
		$qry = "DELETE FROM tbl_cart WHERE ssid = '$ssid'";
		$deldata = $this->db->delete($qry);
	}

	public function addingProInUser($cmrid){
		$sid = session_id();
		$qry = "SELECT * FROM tbl_cart WHERE ssid='$sid' ORDER BY cart_id DESC";
    	$getCat = $this->db->select($qry);
    	if ($getCat) {
    		while ($result = $getCat->fetch_assoc()) {
    			$productId = $result['product_id'];
    			$productName = $result['product_name'];
    			$quantity = $result['quantity'];
    			$product_price = $result['product_price'];
    			$product_image = $result['product_image'];
    			if (!$this->checkUserCartTable($productId,$cmrid)) {
    				$query = "INSERT INTO tbl_customer_cart(cus_id,product_id,product_name,quantity,product_image,product_price) ";
					$query .="VALUES('$cmrid','$productId','$productName','$quantity','$product_image','$product_price')";
		    		$inserted_rows = $this->db->insert($query);

    			}
    			
    		}
   	}
	}
	public function cutomerLogin($data){
		$ssid = session_id();
		$email = $this->fm->validation($data['email']);
		$password = $this->fm->validation($data['password']);

		$email = mysqli_real_escape_string($this->db->link,$email);
		$password = mysqli_real_escape_string($this->db->link,$password);
		if (empty($email) || empty($password)) {
		 	$loginmsg = "Username or Password must not be empty";
		 }else{
		 	$qry = "SELECT * FROM tbl_customer WHERE 
		 			cus_email = '$email'";
		 	$result=$this->db->select($qry);
		 	if ($result != false) {
		 		$value = $result->fetch_assoc();
		 		if ($password == $value['cus_pass']) {
		 			Session::set('cuslogin',true);
		 			Session::set('cmrId',$value['cus_id']);
		 			Session::set('cmrname',$value['cus_name']);
		 			$this->addingProInUser(Session::get('cmrId'));
		 			$this->delCustomerCart($ssid);
		 			$this->wishlist->addingProAftrDelete(Session::get('cmrId'),$ssid);
		 			$this->wishlist->deleteWishlist($ssid);
		 			header("Location: index.php");
		 		}else{
		 			$loginmsg = "<span class='text-danger'>Username And Password Not Match !</span>";
		 		}
		 	}else{
		 		$loginmsg ="<span class='text-danger'>not found email.Please resgister first</span>";
		 	}	
		}
		return $loginmsg;
	}
	public function checkuserCartTable($cmrid,$productid){
		$qry = "SELECT * FROM tbl_customer_cart WHERE product_id='$productid' AND cus_id='$cmrid'";
    	$getCat = $this->db->select($qry);
    	return $getCat;
	}
	public function addToCart($cmrid,$quantity,$productid){
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$id = mysqli_real_escape_string($this->db->link, $productid);
		
		$sqry = "SELECT * FROM tbl_product WHERE product_id = '$productid' LIMIT 1";
		$result = $this->db->select($sqry)->fetch_assoc();

		 $product_name = $result['product_name'];
		 $product_price = $result['product_price'];
		 $product_image = $result['product_image'];

		$getresult = $this->checkuserCartTable($cmrid,$productid);

		if ($getresult) {
			$msg = "product already Exists in Cart";
			return $msg;
		} else {
			$sid = session_id();
			$query = "INSERT INTO tbl_customer_cart(cus_id,product_id,product_name,quantity,product_image,product_price) ";
					$query .="VALUES('$cmrid','$productid','$product_name','$quantity','$product_image','$product_price')";
		    		$inserted_rows = $this->db->insert($query);
		    if ($inserted_rows) {
		        $msg = "product Added in Cart";
		    }else {
		        $msg = "product Not Added in Cart";
		    }
		    return $msg;
		}
	}
	public function delAllCustomerCart($cus_id){
		$qry = "SELECT cus_cart_id FROM tbl_customer_cart WHERE cus_id='$cus_id'";
    	$getCat = $this->db->select($qry);
    	if ($getCat) {
    		while ($value = $getCat->fetch_assoc()) {
    			$qry = "DELETE FROM tbl_customer_cart WHERE cus_id='".$value['cus_cart_id']."'";
				$deldata = $this->db->delete($qry);
    		}
    	}
	}

}
