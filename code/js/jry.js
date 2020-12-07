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