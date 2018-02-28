<?php

$con = mysqli_connect("localhost", "root","","Zillow");
$ip = get_client_ip();
$total=0;
// Get categories
if (mysqli_connect_errno())
{
  echo "There was a problem with the server. Sorry, come back later";
}

// Function to get the client IP address
// getting the user ip address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getAllPro() {

  global $con;
    $get_pro= "select * from products";
    $run_pro=mysqli_query($con, $get_pro);
    if (!$run_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    while($row_pro = mysqli_fetch_array($run_pro)) {
      $pro_id = $row_pro['product_id'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_image = $row_pro['product_image'];
      echo "
          <a href='detail.php?pro_id=$pro_id' class='product_box'>
            <img src='admin_area/product_images/$pro_image'/>
            <div class='product_title'>
            $pro_title
            </div>
            <div class='product_price'>
            Coming soon
            </div>
          </a>
      ";
    }
  }

function detail_pro() {
  global $con;
  if(isset($_GET['pro_id'])){
  $product_id = $_GET['pro_id'];
  $get_pro= "select * from products where product_id=$product_id";
  $run_pro=mysqli_query($con, $get_pro);
  if (!$run_pro) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  while($row_pro = mysqli_fetch_array($run_pro)) {
    $pro_id = $row_pro['product_id'];
    $pro_title = $row_pro['product_title'];
    $pro_price = $row_pro['product_price'];
    $pro_image = $row_pro['product_image'];
    $pro_desc = $row_pro['product_desc'];
    echo "
    <div class='product_box'>
      <img src='admin_area/product_images/$pro_image' />
      <div class='product_spec'>
        <div class='product_title'>
        $pro_title
        </div>
        <div class='product_price'>
        Coming soon
        </div>
        <p class='prod_desc'>
        $pro_desc
        </p>
        <div class='choose_spec'>
          <div class='type_filter'>
            <p class='drop'>
              Memory
            </p>
            <img src='images/drop_icon.png' />
          </div>
          <div class='quantity_prod'>
            <p class='drop'>
              1
            </p>
            <img src='images/drop_icon.png' />
          </div>
        </div>
        <div class='learn-shop-but'>
          Coming soon
        </div>

      </div>

    </div>
    ";
  }
}
}







//getting the add product to cart
/*

function getPro() {

  global $con;
  if(!isset($_GET['cat']) && !isset($_GET['brand']))
  {
    $get_pro= "select * from products order by RAND() LIMIT 0,6";
    $run_pro=mysqli_query($con, $get_pro);
    if (!$run_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    while($row_pro = mysqli_fetch_array($run_pro)) {
      $pro_id = $row_pro['product_id'];
      $pro_cat = $row_pro['product_cat'];
      $pro_brand = $row_pro['product_brand'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_image = $row_pro['product_image'];
      echo "
          <div class='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='180' height='180' />
            <p>
            $$pro_price
            </p>
            <div class='links' style='padding:0 5px 0 5px;'>
            <a href='detail.php?pro_id=$pro_id'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
            </div>
          </div>
      ";
    }
  }
}
function add_cart() {
  global $ip;
  global $con;
  if(isset($_GET['add_cart'])) {
    $pro_id = $_GET['add_cart'];
    $check_pro= "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
    $run_check = mysqli_query($con,$check_pro);
    if(mysqli_num_rows($run_check)>0){

    }
    else {
      $insert_pro="insert into cart (p_id, ip_add) values ('$pro_id','$ip')";
      $run_insert = mysqli_query($con,$insert_pro);
      echo "<script>window.open('index.php','_self');</script>";
    }

  }
}
/
//calling the function
add_cart();

//function to view the cart

function update_cart() {
  global $con;
  global $ip;
  if (isset($_POST['update_cart'])) {
    foreach($_POST['remove'] as $remove_id) {
      $delete_pro = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
      $run_delete= mysqli_query($con, $delete_pro);
      if ($run_delete){
      echo "<script> window.open('cart.php', '_self')</script>";
      }
    }

  }
}

  function continue_shopping(){
    if (isset($_POST['continue'])) {
        echo "<script> window.open('index.php', '_self')</script>";
  }

}
function refresh_qty() {
  global $con;
  global $ip;
  global $total;
  $total_price=0;
    $get_items= "select * from cart where ip_add='$ip'";
    $run_items=mysqli_query($con, $get_items);
    while($list_items=mysqli_fetch_array($run_items)){
      $pro_id=$list_items['p_id'];
      $x = "quantity" . $pro_id;
      if(isset($_POST[$x]))  {
        $pro_quantity= $_POST[$x];
        update_quantity($pro_id);
      }
      else {
        $pro_quantity=$list_items['qty'];
      }
}
}

function cart() {
  global $con;
  global $ip;
  global $total;
  $total_price=0;
    $get_items= "select * from cart where ip_add='$ip'";
    $run_items=mysqli_query($con, $get_items);
    while($list_items=mysqli_fetch_array($run_items)){
      $pro_id=$list_items['p_id'];
      $x = "quantity" . $pro_id;
      $pro_quantity=$list_items['qty'];
      $select_pro= "select * from products where product_id='$pro_id'";
      $run_pro=mysqli_query($con, $select_pro);
      while($pro_item=mysqli_fetch_array($run_pro)){
        $total_price = $total_price + ($pro_item['product_price']* $pro_quantity);
        $pro_price = $pro_item['product_price'] * $pro_quantity;
        $pro_title = $pro_item['product_title'];
        $pro_image = $pro_item['product_image'];
        $n = "index.php";
        echo "
        <tr>
        <td>
        <input type='checkbox' name='remove[]' value='$pro_id' />
        </td>
        <td>$pro_title<br />
        <img src='admin_area/product_images/$pro_image' width='60' height='60' style='margin-top:5px;'</td>
        <td>
        <form action='cart.php' method='post'>
        <select name='quantity$pro_id' value='5' onchange='this.form.submit()' >";
        for($x =1; $x<10; $x++){
          if($x == $pro_quantity){
            $y = strval($pro_quantity);
            echo "<option selected='selected' value='$y'>$y
            </option>";
          }
          else {
            $z = strval($x);
            echo "<option value='$z'>$z
            </option>";
          }
        }

        echo "
        </select>
        </form>

        </td>
        <td>$$pro_price</td>
        </tr>



        ";




      }
    }

  echo "
  <tr style='justify-content:flex-end;'>
    <td>
      <b>Sub Total:</b>
      <td>$$total_price</td>
    </td>
  </tr>

  ";
}


function update_quantity($pro) {
  global $con;
  global $ip;

  if(isset($_POST['quantity'. $pro]))  {
    $qty = $_POST['quantity' . $pro];
    $update_qty = "update cart set qty='$qty' where ip_add='$ip' AND p_id='$pro'";
    $run_qty = mysqli_query($con,$update_qty);
  }
}

*/
/*
function total_items(){
  global $con;
  global $ip;
    $get_items= "select * from cart where ip_add='$ip'";
    $run_items=mysqli_query($con, $get_items);
    $count_items=mysqli_num_rows($run_items);


  echo "$count_items";
}*/
/*
//getting total price of items in cart
function total_price(){
  global $con;
  global $ip;
    $get_items= "select * from cart where ip_add='$ip'";
    $run_items=mysqli_query($con, $get_items);
    $total_price=0;
    while($p_price=mysqli_fetch_array($run_items)){
      $pro_id=$p_price['p_id'];
      $pro_qty = $p_price['qty'];
      $select_pro_price= "select * from products where product_id='$pro_id'";
      $run_pro_price=mysqli_query($con, $select_pro_price);
      while($pro_price=mysqli_fetch_array($run_pro_price)){
        $total_price = $total_price + ($pro_price['product_price']* $pro_qty);
        /*alternative way
        $product_price = array($pro_price['product_price']);
        $total_price = array_sum($product_price);

        *//*
      }

    }

  echo $total_price ;
}


/**

//get the cat in side bar
function getCat(){
  global $con;
 $get_cat=" SELECT * from categories";
 $run_cat=mysqli_query($con,$get_cat);
 while($row_cat=mysqli_fetch_array($run_cat)){
   $cat_id = $row_cat['cat_id'];
   $cat_title = $row_cat['cat_title'];
   echo "<li class='cat_item'><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
 }

}

function getBrand(){
  global $con;
 $get_brand=" SELECT * from brands";
 $run_brand=mysqli_query($con,$get_brand);
 while($row_brand=mysqli_fetch_array($run_brand)){
   $brand_id = $row_brand['brand_id'];
   $brand_title = $row_brand['brand_title'];
   echo "<li class='cat_item'><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
 }

}




function getCatPro() {

  global $con;
  if(isset($_GET['cat']))
  {
    $cat_id= $_GET['cat'];
    $get_cat_pro= "select * from products where product_cat='$cat_id'";
    $run_cat_pro=mysqli_query($con, $get_cat_pro);
    if (!$run_cat_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    $count_cat= mysqli_num_rows($run_cat_pro);
    if($count_cat == 0){
      echo "<h2>Sorry, there is no product in this category.</h2>";
      exit();
    }
    else {
      while($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
        $pro_id = $row_cat_pro['product_id'];
        $pro_cat = $row_cat_pro['product_cat'];
        $pro_brand = $row_cat_pro['product_brand'];
        $pro_title = $row_cat_pro['product_title'];
        $pro_price = $row_cat_pro['product_price'];
        $pro_image = $row_cat_pro['product_image'];
        echo "
            <div class='single_product'>
              <h3>$pro_title</h3>
              <img src='admin_area/product_images/$pro_image' width='180' height='180' />
              <p>
              $$pro_price
              </p>
              <div class='links' style='padding:0 5px 0 5px;'>
              <a href='detail.php?pro_id=$pro_id'>Details</a>
              <a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
              </div>
            </div>
        ";
      }
    }
  }
}

function getBrandPro() {

  global $con;
  if(isset($_GET['brand']))
  {
    $brand_id= $_GET['brand'];
    $get_brand_pro= "select * from products where product_brand='$brand_id'";
    $run_brand_pro=mysqli_query($con, $get_brand_pro);
    if (!$run_brand_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    $count_brand= mysqli_num_rows($run_brand_pro);
    if($count_brand == 0){
      echo "<h2>Sorry, there is no product from this brand.</h2>";
      exit();
    }
    else {
      while($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
        $pro_id = $row_brand_pro['product_id'];
        $pro_cat = $row_brand_pro['product_cat'];
        $pro_brand = $row_brand_pro['product_brand'];
        $pro_title = $row_brand_pro['product_title'];
        $pro_price = $row_brand_pro['product_price'];
        $pro_image = $row_brand_pro['product_image'];
        echo "
            <div class='single_product'>
              <h3>$pro_title</h3>
              <img src='admin_area/product_images/$pro_image' width='180' height='180' />
              <p>
              $$pro_price
              </p>
              <div class='links' style='padding:0 5px 0 5px;'>
              <a href='detail.php?pro_id=$pro_id'>Details</a>
              <a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
              </div>
            </div>
        ";
      }
    }
  }
}

function getAllPro() {

  global $con;
  if(!isset($_GET['cat']) && !isset($_GET['brand']))
  {
    $get_pro= "select * from products";
    $run_pro=mysqli_query($con, $get_pro);
    if (!$run_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    while($row_pro = mysqli_fetch_array($run_pro)) {
      $pro_id = $row_pro['product_id'];
      $pro_cat = $row_pro['product_cat'];
      $pro_brand = $row_pro['product_brand'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_image = $row_pro['product_image'];
      echo "
          <div class='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='180' height='180' />
            <p>
            $$pro_price
            </p>
            <div class='links' style='padding:0 5px 0 5px;'>
            <a href='detail.php?pro_id=$pro_id'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
            </div>
          </div>
      ";
    }
  }
}

function getResults() {

  global $con;
  if(isset($_GET['search']))
  {
    $search_query= $_GET['user_query'];
    $get_pro= "select * from products where product_keywords like '%$search_query%'";
    $run_pro=mysqli_query($con, $get_pro);
    if (!$run_pro) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    while($row_pro = mysqli_fetch_array($run_pro)) {
      $pro_id = $row_pro['product_id'];
      $pro_cat = $row_pro['product_cat'];
      $pro_brand = $row_pro['product_brand'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_image = $row_pro['product_image'];
      echo "
          <div class='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='180' height='180' />
            <p>
            $$pro_price
            </p>
            <div class='links' style='padding:0 5px 0 5px;'>
            <a href='detail.php?pro_id=$pro_id'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button>Add to Cart</button></a>
            </div>
          </div>
      ";
    }
  }
}
*/

 ?>
