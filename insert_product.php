<!DOCTYPE html>
<html lang='en'>

<?php include("includes/db.php");
?>

  <head>
    <meta charset='UTF-8'/>
    <title>Zillow Inserting Product</title>
    <link rel='stylesheet' href='../styles/insert_product.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
<body>

<form action="insert_product.php" method="post" enctype="multipart/form-data">
  <table >
    <tr>
      <td class="table_title"> <h2>Insert New Post Here</h2></td>
    </tr>

    <tr>
      <td class="prod_char">Product Title</td>
      <td><input type="text" name="product_title" required /></td>
    </tr>
    <tr>
      <td class="prod_char">Product Price</td>
      <td><input type="text" name="product_price"required /></td>
    </tr>
    <tr>
      <td class="prod_char">Product Image</td>
      <td><input type="file" name="product_image" required /></td>
    </tr>
    <tr>
      <td class="prod_char">Product Description</td>
      <td><textarea name="product_desc" cols="10" rows="5"></textarea></td>
    </tr>
    <tr>
      <td class="prod_char">Product Keywords</td>
      <td><input type="text" name="product_keywords"required /></td>
    </tr>
    <tr>
      <td class="submit_values"><input type="submit" name="insert_post" value="Insert Now" /></td>
    </tr>

   <?php
      if (isset($_POST['insert_post']))
      {
        $product_title=$_POST['product_title'];
        $product_price=$_POST['product_price'];
        $product_desc= $_POST['product_desc'];
        $product_keywords=$_POST['product_keywords'];

      //Getting the image
      $product_image=$_FILES['product_image']['name'];
      $product_image_tmp= $_FILES['product_image']['tmp_name'];
      move_uploaded_file($product_image_tmp,"product_images/$product_image");
      $insert_product = "insert into products (product_title, product_price, product_desc, product_image, product_keywords) values ('$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
      $insert = mysqli_query($con, $insert_product);
    }
    ?>

  </table>

</form>

</body>



</html>
