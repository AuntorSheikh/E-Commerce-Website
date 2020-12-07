<?php include 'inc/header.php' ?>
<?php 
   $login = Session::get('cuslogin');
   $dd = Session::get('cmrId');
   $ssid = session_id();
  if (!$login) {
    $getValue = $Menu->getAllCartItemBySsid($ssid);
  }else{
    $getValue = $Menu->getAllCartItemBycusid($dd);
  }
     
  
 ?>
<section class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div style="background-image: url(images/bro.jpg);background-size: cover;">
          <h3 class="p-5 text-center"></h3>
        </div>
        
      </div>
  </div>
</section>
<section class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <table class="table">
          	<thead class="bg-warning text-light">
          		<th>Item</th>
          		<th>Title</th>
          		<th>Price($)</th>
          		<th>Quantity</th>
          		<th>Total($)</th>
          	</thead>
          	<tbody>
    <?php 
        if ($getValue) {
          $count_one = 0;
          $count_two = 100;
          while ($row = mysqli_fetch_array($getValue)) {
            $count_one++;
            $count_two++;
    ?>
        <tr id="<?php echo $count_one; ?>">
                <td><img width="80" src="images/<?php echo $row['product_image'] ?>"></td>
                <td><?php echo $row['product_name'] ?></td>
                <td><?php echo $row['product_price'] ?></td>
                <td>
                  <div class="input-group main" id="<?php echo $count_two ?>">
                    <span class="input-group-btn">
                        <button type="button" id="<?php echo $row['product_id'] ?>" class="btn btn-danger bminus"  data-type="minus">
                          <span class="fa fa-minus"></span>
                        </button>
                    </span>
                    <input type="text" name="quant" class="qnty" value="<?php echo $row['quantity'] ?>" min="1" max="100" size="2">
                    <span class="input-group-btn">
                        <button type="button" id="<?php 
                            if(!$login){
                             echo $row['cart_id'];
                             }else{
                              echo $row['cus_cart_id'];
                            } 
                          ?>" class="btn btn-success bplus" data-type="plus" data-field="quant[2]">
                            <span class="fa fa-plus"></span>
                        </button>
                    </span>
                </div>
                </td>
                <td class="subtotal"><?php echo ($row['product_price']*$row['quantity']) ?></td>
              </tr>
      <?php    }
        }else{
          header("Location: index.php");
        }
     ?>
          

          	</tbody>
          </table>
        </div>
      </div>
      <div class="col-md-5">
        <form method="post">
          <div class="pl-3">
            <ul class="list-group">
              <li class="list-group-item list-group-item-secondary">Cart Sub total <span class="pull-right" id="totalAmount">150Tk</span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Tax <span class="pull-right">10%</span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Shipping cost <span class="pull-right">Free</span></li>
              <li class="list-group-item mt-3 list-group-item-secondary">Total <span class="pull-right" id="finalAmount"></span></li>
            </ul>
          </div>
          <br>
          <br>
          <a href="#" class="btn btn-primary pull-right" name="save">checkout</a>
        </form>
        
      </div>
  </div>
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
<script type="text/javascript">
$(document).ready(function(){

  $( ".bminus" ).on('click',function() {
    $div = $(this).closest('div');
    $tr = $(this).closest('tr');
    var getid = $div.attr("id");
    var getValueid = $tr.attr("id");
    var carttext = parseInt($('#carting').text());
    carttext --;
    $('#carting').text(carttext);
    $pvalue = parseFloat($div.find("input").val());
    $pvalue = $pvalue-1;
    $value = parseFloat($tr.find("td:nth-child(3)").text());
    $value *= $pvalue;
    if ($pvalue >= 0) {
      $("#"+getid+" input").val($pvalue);
      $("#"+getValueid+" td:nth-child(5)").text($value);
    }

    empty();
  });

  $('#carting').text('<?php check($Menu); ?>');

  $( ".bplus" ).on('click',function() {
    $div = $(this).closest('div');
    $tr = $(this).closest('tr');
    var getid = $div.attr("id");
    var cus_id = $(this).attr("id");
    var getValueid = $tr.attr("id");
    var carttext = parseInt($('#carting').text());
    carttext ++;
    $('#carting').text(carttext);
    $pvalue = parseFloat($div.find("input").val());
    $pvalue = $pvalue+1;
    var value = $pvalue;
    $value = parseFloat($tr.find("td:nth-child(3)").text());
    $.ajax({
      url:"ajax/update_cart.php",
      method:"POST",
      data:{cus_id:cus_id,value:value},
      success:function(data)
      {
        $("#"+getid+" input").val(data);
      }
    });
    $value *= $pvalue;
    
    $("#"+getValueid+" td:nth-child(5)").text($value);

    empty();
  });
  empty();
  function empty(){
    var total = 0,finalAmount;
    $(".subtotal").each(function () {
        total += parseFloat($(this).text());
    });
    avg = total * 0.1;
    finalAmount = avg + total;
    $('#totalAmount').text(total);
    $('#finalAmount').text(finalAmount);
  }
    

});
    
</script>
<?php
   echo "<script>document.writeln(finalAmount);</script>";
?>
  </body>
</html>
