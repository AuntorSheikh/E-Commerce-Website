<?php include 'inc/header.php' ?>
<?php 
   $login = Session::get('cuslogin');
   $dd = Session::get('cmrId');
  if (!$login) {
    $getValue = $wish->getAllWishlistItemBySsid($ssid);
  }else{
    $getValue = $wish->getAllWishlistItemBycusid($dd);
  }
     
  
 ?>
<section class="container-fluid mt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="row">
          <h2 class="text-center text-warning">Category</h2>
          <div class="table-responsive">
            <table class="table table-bordered">
<?php 
  $cate = $Menu->allCategory();
  if ($cate) {
    while ($row = mysqli_fetch_array($cate)){
 ?>
              <tr>
                <td><?php echo $row['cat_name'] ?></td>
                <td></td>
              </tr>
<?php }} ?>
            </table>
          </div>
        </div>
        <div class="row">
          <h2 class="text-center text-warning">Brand</h2>
          <div class="table-responsive">
            <table class="table table-bordered">
<?php 
  $brnd = $Menu->allBrand();
  if ($brnd) {
    while ($row = mysqli_fetch_array($brnd)){
 ?>
              <tr>
                <td><?php echo $row['brand_name'] ?></td>
                <td></td>
              </tr>
<?php }} ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">
      <?php 
        if ($getValue) {
          while ($row = mysqli_fetch_array($getValue)) {
      ?>
          <div class="col-md-4">
            <div class="card" style="width: 100%;">
              <img class="card-img-top" src="images/<?php echo $row['product_image'] ?>" alt="Card image cap" style="height:200px">
              <div class="card-body">
                <div class="row">
                  <p class="h4 text-warning pull-left col-md-7"><?php echo '$'.$row['product_price'] ?></p>
                  <p class=" col-md-5 pull-right">4.2(420)</p>
                </div>
                <p class="card-text h5 text-secondary"><?php echo '$'.$row['product_name'] ?></p>
                <a href="checkout.php?price=<?php echo $row['product_price'] ?>" class="text-light btn btn-warning float-left">buy Now</a>
                <button type="button" class="text-light btn btn-warning float-right addTocart">Add To Cart</button>
              </div>
            </div>
            <br>
          </div>
      <?php }} ?>
          <br>
        </div>
      </div>
    </div>
  </div>
  <div id="ssid"><?php echo $ssid; ?></div>
</section>

  
<footer class="footer text-center text-light container-fluid bg-dark">
	<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="info">
						<ul class="nav nav-pills">
							<li><a href="" class="text-white"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href="" class="text-white"><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<button class="btn top_btn"><i class="fa fa-facebook"></i></button>
						<button class="btn top_btn"><i class="fa fa-twitter"></i></button>
						<button class="btn top_btn"><i class="fa fa-trash"></i></button>
						<button class="btn top_btn"><i class="fa fa-close"></i></button>
						<button class="btn top_btn"><i class="fa fa-folder"></i></button>
					</div>
				</div>
			</div>
		</div>
</footer>
<?php 
function check($Menu){
  $men = $Menu->CountCartItem();
  $row = mysqli_fetch_array($men);
  echo $row['count'];
}

 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
<script >
  $(document).ready(function(){
    load_data();
    function load_data(txt)
     {
      $.ajax({
       url:"ajax/fetch_search.php",
       method:"POST",
       data:{txt:txt},
       success:function(data)
       {
        $('#result').html(data);
       }
      });
     }

    function wishlistCount(){
      $.get("ajax/wishlistProductCount.php",function(data){
          console.log(data);
          $('#wishing').text(data);
      }).fail(function(){
          console.log( "error");
      });
    }
    wishlistCount();
    $('#search_text').keyup(function(){
      var txt = $(this).val();
      if (txt != '') {
        load_data(txt);
      }else{
        load_data();
      }
    });
    $(document).on('click','.addToWishlist',function(){
      var getid = $(this).attr('id');
      var ssid = $('#ssid').text();
      $.ajax({
        url:"ajax/add_wishlist.php",
        method:"POST",
        data:{getid:getid,ssid:ssid},
        success:function(data)
        {
          alert(data);
          wishlistCount();
        }
      });
    });
    $('#carting').text('<?php check($Menu); ?>');
    $(document).on('click','.addTocart',function(){
      var getid = $(this).attr('id');
      var ssid = $('#ssid').text();
      var carttext = parseInt($('#carting').text());
      $.ajax({
        url:"ajax/add_cart.php",
        method:"POST",
        data:{getid:getid,ssid:ssid},
        success:function(data)
        {
          alert(data);
          carttext ++;
          $('#carting').text(carttext);
        }
      });
      
    });
  });
</script>
  </body>
</html>
