<?php

//fetch_item.php

include('database_connection.php');

$query = "SELECT * FROM product ORDER BY product_id DESC";

$statement = $connect->prepare($query);

if($statement->execute())
{
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  $output .= '
  <div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:525px;" align="center">
             <img src="../image/'.$row["product_image"].'" class="img-responsive" /><br />
             <h4 class="text-info">'.$row["product_name"].'</h4>
             <h4 class="text-info">'.$row["product_size"].'</h4>
             <h4 class="text-danger">$ '.$row["product_price"] .'</h4>
             <input type="text" name="quantity" id="quantity' . $row["product_id"] .'" class="form-control" value="1" />
             <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />
             <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_size"].'" />
             <input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_price"].'" />
             <input type="button" name="add_to_cart" id="'.$row["product_id"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" />
			 <br/>
			 <br/>
			 <button type="button"   name="view" class="btn btn-info  btn-lg view"  id="'.$row["product_id"].'" >View</button>
            </div>
        </div>
  ';
 }
 echo $output;
}


?>
