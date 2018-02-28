<!DOCTYPE html>
<html lang='en'>
<?php include("functions/functions.php"); ?>

<?php
if(isset($_POST['submit'])) {
$msg = $_POST['message'];
$msg = wordwrap($msg,70);
mail("valentinlehericy@gmail.com","My subject",$msg);
}
?>

  <head>
    <meta charset='UTF-8'/>
    <title>Contact Zillow</title>
    <link rel="shortcut icon" href="logo_zillow.ico" />
    <link rel='stylesheet' href='styles/contact.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="javascript/zillow.js"></script>

  </head>
<body>

  <div class="menu_cont_in">
    <?php include("menu_bar.php") ?>
  </div>
    <div class="content_cont">
      <form action="contact.php">
        <p class="contact_title">
          Any Questions ? We' re Always Awake
        </p>
        <div class="name_field_cont">
          <p>
            First name:
          </p>
          <p>
            Last name:
          </p>
        </div>
        <div class="input_name">
          <input class="first_name_input" name="first_name" type="text" required />
          <input name="last_name" type="text" required />
        </div>
        <div class="name_field_cont">
          <p>
            Email:
          </p>
        </div>
        <input class="email_input" name="email" type="text" required />
        <div class="name_field_cont">
          <p>
            Message:
          </p>
        </div>
        <input class="message_input" name="message" type="text" required />
        <input class="sub_but" type="submit" name="sub" />
      </form>



    </div>



</body>
<?php include("footer.php") ?>



</html>
