<?php include("../../path.php"); ?>

<?php 
if(!empty($_GET['id'])){ 
    // Include and initialize database class 
    include_once 'DB.class.php'; 
    $db = new DB; 
     
    // Get payment details 
    $conditions = array( 
        'where' => array('id' => $_GET['id']), 
        'return_type' => 'single' 
    ); 
    $paymentData = $db->getRows('payments', $conditions); 
     
    // Get product details 
    $conditions = array( 
        'where' => array('id' => $paymentData['product_id']), 
        'return_type' => 'single' 
    ); 
    $eventData = $db->getRows('events', $conditions); 
}else{ 
    header("Location: index.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom Styling -->
<link rel="stylesheet" href="style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <title>Esport Brunei - Payment Status</title>
    <link rel="icon" href="../assets/logo/logo3.png">
</head>
<body>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
    <div class="sidebar-wrapper">


    </div>
    <!-- Content -->
    <div class="content clearfix">

    <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
                

        <div class="main-content single">
        <div class="status">
    <?php if(!empty($paymentData)){ ?>
        <h3 class="success" style="max-width:30%;">Your Payment has been Successful!</h3>
        <h1>Payment Information</h1>
        <p><b>TXN ID:</b> <?php echo $paymentData['txn_id']; ?></p>
        <p><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
        <p><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></p>
        <p><b>Payment Date:</b> <?php echo $paymentData['created']; ?></p>
        <p><b>Payer Name:</b> <?php echo $paymentData['payer_name']; ?></p>
        <p><b>Payer Email:</b> <?php echo $paymentData['payer_email']; ?></p>
		<!-- <p><b>User ID:</b> <?php echo $paymentData['user_id']; ?></p>  -->
        <h1>Product Information</h1>
        <p><b>Name:</b> <?php echo $eventData['title']; ?></p>
        <p><b>Price:</b> <?php echo $eventData['s_price'].' '.$eventData['currency']; ?></p>
    <?php }else{ ?>
        <h1 class="error">Your Payment has Failed</h1>
    <?php } ?>
    
        </div>
        <div class="home">
        <a href="../../index.php" class="btn-link">Back to Home</a>
        </div>
        <div class="profile">
        <a href="../../profile.php" class="btn-link">Back to Profile</a>
        </div>
</div>

</div>
</div>

</body>
</html>

<script>
  /* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }</script>