<!DOCTYPE html>
<html lang='en'>
<?php include("functions/functions.php"); ?>

  <head>
    <meta charset='UTF-8'/>
    <title>Shop Zillow</title>
    <link rel="shortcut icon" href="logo_zillow.ico" />
    <link rel='stylesheet' href='styles/shop_style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="javascript/zillow.js"></script>

  </head>
<body>
  <div class="menu_cont_in">
    <?php include("menu_bar.php") ?>
  </div>
<div class="main_cont">

    <div class="content_cont">
      <div class="shop_back">
      </div>
      <div class="filter_cont">
        <div class="filter_by">
          <p>
            Filter by
          </p>
          <div class="size_filter">
            <p class="drop">
              Size
            </p>
            <img src="images/drop_icon.png" />

          </div>
          <div class="texture_filter">
            <p class="drop">
              Texture
            </p>
            <img src="images/drop_icon.png" />
          </div>
          <div class="type_filter">
            <p class="drop">
              Type
            </p>
            <img src="images/drop_icon.png" />
          </div>
        </div>
        <div class="sort_by">
          <p>
            Sort by:
          </p>
          <div class="relevance_filter">
            <p class="drop">
              Relevance by
            </p>
            <img src="images/drop_icon.png" />
          </div>
        </div>
      </div>
      <div class="all_product_cont">

        <?php getAllPro(); ?>

      </div>

    </div>



</div>




</body>
<?php include("footer.php") ?>



</html>
