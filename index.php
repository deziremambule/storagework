<?php 

//index.php

include('database_connection.php');


$query = "SELECT * FROM storehomepage WHERE id ='1'";
$statement = $connect->prepare($query);
$statement->execute();
$title = $statement->fetchAll();

$query = "SELECT * FROM storehomepage WHERE id ='3'";
$statement = $connect->prepare($query);
$statement->execute();
$new = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Sport Essential</title>
	<!--bootstrap and javascript libraries for navigation and css -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
  

  </head>
  
  <style>
  
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #F1F1F2;
  
}

.topnav a {
  float: left;
  display: block;
  color: #000;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #06006B;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

  .popover
  {
      width: 100%;
      max-width: 800px;
  }
  
  #loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}


  .box
  {
   padding:20px;
   background-color: #06006B;
   color: #fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  
    .box2
  {
   padding:0px;
   width:30%;
    color: #fff;
    background-color:  #06006B;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  
   #top{  
	   position:fixed;  
	   bottom:50px;  
	   right:0px;  
	   display:none;  
	   width:70px;
	   height:50px;
	   font-size:20px;
	} 
		

.footer {
   padding: 10px;
   font-size: 20px;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #06006B;
   color: white;
   text-align: left;
}
  
  </style>
 </head>
 <body>
 <div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
   <a href="footwear/index.php">Footwear</a>
  <a href="products/index.php">Products</a>
  <a href="chatgeneral/index.php">Social Chat</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
   <ul class="nav navbar-nav navbar-right">
      <li><a href="loggedproducts/index.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
    </ul>
</div>
<br/>
<br/>
 
  <div class="container">
  
       
  <br/>
    <div align="center">
    <div class="container-fluid">
      <span class="sr-only">Menu</span>
     <div id="navbar-cart" class="">
      <ul class="nav navbar-nav">
       <li>
        <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
         <span class="glyphicon glyphicon-shopping-cart"></span>
         <span class="badge"></span>
         <span class="total_price">£ 0.00</span>
        </a>
       </li>
      </ul>
     </div>
     </div>
    </div>

   
      <!-- Page Content, set up classes, names and ids to use in js and php -->

    <div class="container">
	
	   <div align="center"><?php   foreach($title as $row)
                            {
								$output = ''; 
								$output .= '<br> <h1><div><div class=" box"  align="center">'  .$row["heading"].'<h1/>'; 
								$output .= '<h4>'  .$row["description"].' </div></div></h4>'; 
							 echo $output;
								
							}?></div>
							    </div>
						
							
								   <div align="center"><?php   foreach($new as $row)
                            {
								$output = ''; 
								$output .= '<br> <h1><div><div class=" box2"  align="center">'  .$row["heading"].'<h1/>'; 
								$output .= '<h4>'  .$row["description"].' </div></div></h4>'; 
							 echo $output;		
							}?></div>
							<br/>
							<br/>
		    <div class="container">
	
		  <br/>
        <div class="row">
        
       <div class="table-responsive" id="dynamic_content">
            
        
     
            <div class="col-md-15">
            	<br />
                <div class="row filter_data">

                </div>
				 </div>
            </div>
  
        </div>


    </div>

   
   <div id="popover_content_wrapper" style="display: none">
    <span id="cart_details"></span>
    <div align="right">
     <a href="./invoice/index.php" class="btn btn-primary" id="check_out_cart">
      <span class="glyphicon glyphicon-shopping-cart"></span> Check out
     </a>
     <a href="" class="btn btn-default" id="clear_cart">
      <span class="glyphicon glyphicon-trash"></span> Clear
     </a>
    </div>
   </div>

   <div id="display_item" class="row">

   </div>

<div id="post_modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content"> 
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"></h4>
   </div>
   <div class="modal-body" id="book_detail">
	 
	
     <br />
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
    
    <br />
    <br />
   </div>
  </div>
      <button type="button" class="btn btn-danger" id="top">Top</button>
  </div>
      <br><br>
  <div class="footer">
      &copy; <?php echo date('Y'); ?> Dezire Mambule
</div>
 </body>
</html>

<script>  

function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

$(document).ready(function(){
	

  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetchsearch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
 
	
	  filter_data();

    function filter_data() //set up parameters to display data
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var Value = get_filter('Value');
        var type = get_filter('type');
        var group = get_filter('group');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, Value:Value, type:type, group:group},
            success:function(data){
                $('.filter_data').html(data); //set up parameters for data filter
            }
        });
    }

    function get_filter(class_name) //set up parameters for check box function
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({ //set up parameters for price range function
        range:true,
        min:10,
        max:60,
        values:[10, 60],
        step:10,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });




	 
 function fetch_post_data(post_id)
 {
  $.ajax({
   url:"fetchnext.php",
   method:"POST",
   data:{post_id:post_id},
   success:function(data)
   {
    $('#post_modal').modal('show');
    $('#book_detail').html(data);
   }
  });
 }

 $(document).on('click', '.view', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });

 $(document).on('click', '.previous', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });

 $(document).on('click', '.next', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });
 
 

 
 load_cart_data();



 function load_cart_data()
 {
  $.ajax({
   url:"fetch_cart.php",
   method:"POST",
   dataType:"json",
   success:function(data)
   {
    $('#cart_details').html(data.cart_details);
    $('.total_price').text(data.total_price);
    $('.badge').text(data.total_item);
   }
  })
 }

 $('#cart-popover').popover({
  html : true,
  container : 'body',
  content:function(){
   return $('#popover_content_wrapper').html();
  }
 });

 $(document).on('click', '.add_to_cart', function(){
  var product_id = $(this).attr('id');
  var product_name = $('#name'+product_id+'').val();
  var product_price = $('#price'+product_id+'').val();
  var product_quantity = $('#quantity'+product_id).val();
  var action = 'add';
  if(product_quantity > 0)
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
    success:function(data)
    {
     load_cart_data();
     alert("Item has been Added into Cart");
    }
   })
  }
  else
  {
   alert("Please Enter Number of Quantity");
  }
 });

 $(document).on('click', '.delete', function(){
  var product_id = $(this).attr('id');
  var action = 'remove';
  if(confirm("Are you sure you want to remove this product?"))
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{product_id:product_id, action:action},
    success:function(data)
    {
     load_cart_data();
     $('#cart-popover').popover('hide');
     alert("Item has been removed from Cart");
    }
   })
  }
  else
  {
   return false;
  }
 });

 $(document).on('click', '#clear_cart', function(){
  var action = 'empty';
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{action:action},
   success:function()
   {
    load_cart_data();
    $('#cart-popover').popover('hide');
    alert("Your Cart has been clear");
   }
  })
 });
    
});

/*this code is for scrollTop function */
 $(document).ready(function(){  
                $('a[href^="#"]').on('click', function(e){  
                     e.preventDefault();  
                     var target = this.hash;  
                     var $target = $(target);  
                     $('html, body').animate({  
                          'scrollTop':$target.offset().top  
                     }, 1000, 'swing');  
                });  
           });  
           $(function(){  
                $(window).scroll(function(){  
                     if($(this).scrollTop() != 0)  
                     {  
                          $('#top').fadeIn();  
                     }  
                     else  
                     {  
                          $('#top').fadeOut();  
                     }  
                });  
                $('#top').click(function(){  
                     $('body,html').animate({scrollTop:0},500);  
                });  
           });

</script>