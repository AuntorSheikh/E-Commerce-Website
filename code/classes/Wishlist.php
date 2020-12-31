<?php 

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
class Wishlist
{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}


	public function deleteWishlist($ssid){
		$qry = "DELETE FROM wishlist WHERE ssid = '$ssid'";
		$deldata = $this->db->delete($qry);
	}

	public function addingProAftrDelete($cmrid,$sid){
		$qry = "SELECT * FROM wishlist WHERE ssid='{$sid}'";
    	$getProduct = $this->db->select($qry);
    	if ($getProduct) {
    		while ($result = $getProduct->fetch_assoc()) {
    			$productId = $result['product_id'];
    			$cmrid = (int)$cmrid;
    			if (!$this->checkWishlistProduct($cmrid,$productId)) {
    				$query = "INSERT INTO customer_wishlist(cus_id, product_id) ";
					$query .="VALUES('{$cmrid}','{$productId}')";
		    		$inserted_rows = $this->db->insert($query);
    			}
    		}
   		}
	}
	public function checkWishlistProduct($id,$productid){
		if (is_string($id)) {
			$sql ='SELECT * FROM wishlist WHERE ssid="'.$id.'" AND product_id ="'.$productid.'"';
		}else{
			$sql ='SELECT * FROM customer_wishlist WHERE cus_id="'.$id.'" AND product_id ="'.$productid.'"';
		}
		
		$value = $this->db->select($sql);
    	return $value;
	}
		//WishList
	function insertIntoWishlist($productId,$ssid){
		$getresult = $this->checkWishlistProduct($ssid,$productId);
		if ($getresult) {
			$msg = 'Already Exists this product in Wishlist';
		}else{
			$sql ="INSERT INTO wishlist(ssid, product_id) 
			VALUES('{$ssid}','{$productId}')";
			$insert = $this->db->insert($sql);
			if ($insert) {
				$msg = 'Added successfull in wishlist';
			}
		}
		return $msg;
	}
	public function addToWishlist($cmrid,$productid){
		$productid = $this->fm->validation($productid);
		$productid = mysqli_real_escape_string($this->db->link, $productid);

		$cmrid = $this->fm->validation($cmrid);
		$cmrid = mysqli_real_escape_string($this->db->link, $cmrid);
		$cmrid = (int)$cmrid;

		$getresult = $this->checkWishlistProduct($cmrid,$productid);

		if ($getresult) {
			$msg = "product already Exists in Wishlist";
		}else {
			$sql ="INSERT INTO customer_wishlist(cus_id, product_id) 
			VALUES('{$cmrid}','{$productid}')";
			$insert = $this->db->insert($sql);
			if ($insert) {
				$msg = 'Added successfull in wishlist';
			}
		}
		return $msg;
	}
	
	function CountWishlistItem($ssid){
		$logCheck = Session::get('cuslogin');
		
		$ssid = session_id();
		$cus_id = Session::get('cmrId');
		if (!$logCheck) {
			$sql ="SELECT count(*) as count FROM wishlist WHERE ssid='".$ssid."'";
			$fetchAll = $this->db->select($sql);
		}else{
			$sql ='SELECT count(*) as count FROM customer_wishlist WHERE cus_id="'.$cus_id.'"';
			$fetchAll = $this->db->select($sql);
		}
		return $fetchAll;
		
	}
	function getAllWishlistItemBySsid($ssid){ //retrieve all cart product by id
		$sql ='SELECT * FROM wishlist INNER JOIN tbl_product ON wishlist.product_id=tbl_product.product_id WHERE wishlist.ssid="'.$ssid.'"';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
	function getAllWishlistItemBycusid($dd){ //retrieve all cart product by id
		$sql ='SELECT * FROM customer_wishlist INNER JOIN tbl_product ON customer_wishlist.product_id=tbl_product.product_id WHERE customer_wishlist.cus_id="'.$dd.'"';
		$fetchAll = $this->db->select($sql);
		return $fetchAll;
	}
}
?>