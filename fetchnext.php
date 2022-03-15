<?php
//fetch.php
if(isset($_POST["post_id"]))
{
 $connect = mysqli_connect("localhost", "root", "", "chatstore");
 $output = '';
   $query_1 = "SELECT product_id FROM tbl_products WHERE product_id < '".$_POST['post_id']."' ORDER BY product_id DESC LIMIT 1";
  $result_1 = mysqli_query($connect, $query_1);
  $data_1 = mysqli_fetch_assoc($result_1);
  $query_2 = "SELECT product_id FROM tbl_products WHERE product_id > '".$_POST['post_id']."' ORDER BY product_id ASC LIMIT 1";
  $result_2 = mysqli_query($connect, $query_2);
  $data_2 = mysqli_fetch_assoc($result_2);
  $if_previous_disable = '';
  $if_next_disable = '';
  if($data_1["product_id"] == "")
  {
   $if_previous_disable = 'disabled';
  }
  if($data_2["product_id"] == "")
  {
   $if_next_disable = 'disabled';
  }
 $query = "SELECT * FROM tbl_products WHERE product_id = '".$_POST["post_id"]."'";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
    <div align="center">
     
  <h2 class="box">'.$row["product_name"].'</h2>
	<img src="./image/'.$row["product_image"].'" class="img-responsive box"  align="center" />
	  <h2 class="box">£'.$row["product_price"].'</h2>
	             <input type="text" name="quantity" id="quantity' . $row["product_id"] .'" class="form-control" value="1" />
				 
            	<input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />
            	<input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_size"].'" />
            	<input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_price"].'" />
            	<input type="button" name="add_to_cart" id="'.$row["product_id"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" /><br />
				  </div>
		';
  $query_1 = "SELECT product_id FROM tbl_products WHERE product_id < '".$_POST['post_id']."' ORDER BY product_id DESC LIMIT 1";
  $result_1 = mysqli_query($connect, $query_1);
  $data_1 = mysqli_fetch_assoc($result_1);
  $query_2 = "SELECT product_id FROM tbl_products WHERE product_id > '".$_POST['post_id']."' ORDER BY product_id ASC LIMIT 1";
  $result_2 = mysqli_query($connect, $query_2);
  $data_2 = mysqli_fetch_assoc($result_2);
  $if_previous_disable = '';
  $if_next_disable = '';
  if($data_1["product_id"] == "")
  {
   $if_previous_disable = 'disabled';
  }
  if($data_2["product_id"] == "")
  {
   $if_next_disable = 'disabled';
  }
  $output .= '
  ';
 }
 echo $output;
}

?>