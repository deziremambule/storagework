
<?php

$connect =  new PDO("mysql:host=localhost;dbname=chatstore", "root", "");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM logos
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/

$limit = '4';
$page_array [] = '';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM tbl_products
";

if($_POST['query'] != '')
{
  $query .= ' WHERE product_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  $query .= 'OR product_value LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  $query .= 'OR product_price LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  $query .= 'OR product_type LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
  $query .= 'OR product_group LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
 
}


$query .= 'WHERE product_value = "New" ORDER BY product_id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '

<label>Total Records - '.$total_data.'</label>

';

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';


if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
 		 		    <div align="center">
			<div class="col-sm-4 col-lg-3 col-md-3 ">
				<div style="border:5px solid #06006B; border-radius: 5px; padding:16px; margin-bottom:16px; height:725px; ">
				
					<img src="./image/'. $row['product_image'] .'" alt="" class="img-responsive" "width="100%;" height="50%">
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
  $output .= '
  <tr>
    <td colspan="5" align="center">No Data Found</td>
  </tr>
  ';
}

echo $output;


?>
