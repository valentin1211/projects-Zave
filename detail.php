<!DOCTYPE html>
<html lang='en'>
<?php include("functions/functions.php"); ?>

  <head>
    <meta charset='UTF-8'/>
    <title>Detail Zillow</title>
    <link rel="shortcut icon" href="logo_zillow.ico" />
    <link rel='stylesheet' href='styles/detail_style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="javascript/zillow.js"></script>

  </head>
<body>
  <div class="menu_cont_in">
    <?php include("menu_bar.php") ?>
  </div>
<div class="main_cont">

    <div class="content_cont">
      <?php detail_pro(); ?>



    </div>
    <?php include("pro_adv.php") ?>

    <?php //include("newsletter.php") ?>

</div>




</body>
<?php include("footer.php") ?>



</html>
