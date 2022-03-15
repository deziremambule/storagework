<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"])) //set up and execute parameters for tbl_products price display
{
	$query = "
		SELECT * FROM tbl_products WHERE product_type = 'Footwear' Order by product_id desc 
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["Value"])) //set up and execute parameters for displaying data in the following row
	{
		$Value_filter = implode("','", $_POST["Value"]);
		$query .= "
		 AND product_value IN('".$Value_filter."') 
		";//execute filter function
	}
	if(isset($_POST["type"])) //set up and execute parameters for displaying data in the following row
	{
		$type_filter = implode("','", $_POST["type"]);
		$query .= "
		 AND product_type IN('".$type_filter."')
		";//execute filter function
	}
	if(isset($_POST["group"])) //set up and execute parameters for displaying data in the following row
	{
		$group_filter = implode("','", $_POST["group"]);
		$query .= "
		 AND product_group IN('".$group_filter."')
		";//execute filter function
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(); 
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0) //set up and execute parameters to display images and content together
	{
		foreach($result as $row)
		{
			$output .= '
			    <div align="center">
			<div class="col-sm-4">
				<div style="border:5px solid #06006B; border-radius:5px; padding:16px; margin-bottom:16px; height:725px; ">
				
					<img src="../image/'. $row['product_image'] .'" alt="" class="img-responsive" "width="100%;" height="50%">
					<h4 align="center"><strong><a href="">'. $row['product_name'] .'</a></strong></h4>
					<h4 style="text-align:center;" class="text-danger" >£'. $row['product_price'] .'</h4>
					<h4>Value : '. $row['product_value'] .' </h4>
					<h4>Type : '. $row['product_type'] .' </h4>
					<h4>Group : '. $row['product_group'] .'  </h4>
			
             <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_name"].'" />
             <input type="hidden" name="hidden_name" id="name'.$row["product_id"].'" value="'.$row["product_size"].'" />
             <input type="hidden" name="hidden_price" id="price'.$row["product_id"].'" value="'.$row["product_price"].'" />
				<button type="button"   name="view" class="btn btn-info  btn-sm view"  id="'.$row["product_id"].'" >View</button>
            </div>
				</div>

			</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>