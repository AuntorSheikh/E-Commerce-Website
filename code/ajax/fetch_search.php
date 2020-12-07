<?php 
	$connect = mysqli_connect("localhost","root","","cse311");
	if (isset($_POST['txt'])) {
		$sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%".$_POST['txt']."%'";
		
	}else{
		$sql = "SELECT * FROM tbl_product";

	} 
	$result = mysqli_query($connect, $sql);
	$output ='';
	if (mysqli_num_rows($result) > 0 ) {
		$output .= '
    <h1 class="text-dark p-3">Popular Restaurants</h1>
    <div class="row">';
		while ($row = mysqli_fetch_array($result)) {
			$output .='<div class="col-md-4">
        <div class="card" style="width: 100%;">
          <img class="card-img-top" src="images/'.$row['product_image'].'" alt="Card image cap" style="height:200px">
          <div class="card-body">
            <div class="row">
              <p class="h4 text-warning pull-left col-md-7">$'.$row['product_price'].'</p>
              <p class=" col-md-5 pull-right">4.2(420)</p>
            </div>
            <p class="card-text h4 text-center text-secondary product_name">'.$row['product_name'].'</p>
			
				<a href="#" class="text-light btn btn-warning float-left">buy Now</a>
		<button type="button" class="text-light btn btn-warning float-right addTocart" id="'.$row['product_id'].'">Add To Cart</button>
			
          </div>
        </div>
        <br>
      </div>';
		}
		$output .= '</div>';
echo $output;
	}else{
		echo '<h1 class="text-danger p-5">No search found</h1>';
	}
		
 
?>

