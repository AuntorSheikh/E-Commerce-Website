<?php include 'inc/header.php' ?>

<section class="container-fluid mainSelector">
  <div class="container pb-5">
    <div class="row">
      <div class="col-md-7">
        <h2 class="p-4 text-dark">Search your product which you want <br>Here</h2>
      </div>
      <div class="col-md-5">
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="input-group mb-3">
          <input type="text" id="search_text" class="form-control" placeholder="Enter product Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
          
        </div>
      </div>  
    </div>
  </div>
</section>
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
        <div id="result"></div>
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
							<li><a href="" class="text-white"><i class="fa fa-phone"></i> Auntor shek</a></li>
							<li><a href="" class="text-white"><i class="fa fa-phone"></i> Rituporna roy mitu</a></li>
              <li><a href="" class="text-white"><i class="fa fa-phone"></i> Sharbon</a></li>
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
  
    $('#search_text').keyup(function(){
      var txt = $(this).val();
      if (txt != '') {
        load_data(txt);
      }else{
        load_data();
      }
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
