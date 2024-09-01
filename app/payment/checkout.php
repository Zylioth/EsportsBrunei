<?php include("../../path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/events.php');


// if (isset($_GET['id'])) {
//   $post = selectOne('events', ['id' => $_GET['id']]);
// }
// $topics = selectAll('topics');
// $posts = selectAll('events', ['published' => 1]);


// To get session of Events by id

if (isset($_GET['id'])) {
  $post = selectOne('events', ['id' => $_GET['id']]);
  $_SESSION['postid'] = $_GET['id'];
}
$topics = selectAll('topics');
$posts = selectAll('events', ['published' => 1]);

$_SESSION['postid'] = $_GET['id'];
?>


<?php 
// Redirect to the home page if id parameter not found in URL 
if(empty($_GET['id'])){ 
    header("Location: index.php"); 
} 
 
// Include and initialize database class 
include_once 'DB.class.php'; 
$db = new DB; 
 
// Include and initialize paypal class 
include_once 'PaypalExpress.class.php'; 
$paypal = new PaypalExpress; 
 
// Get product ID from URL 
$productID = $_GET['id']; 

// $eventID = $_GET['id']; 
 
// Get product details 
$conditions = array( 
    'where' => array('id' => $productID), 
    'return_type' => 'single' 
); 
// $conditions = array( 
//     'where' => array('id' => $productID), 
//     'return_type' => 'single' 
// ); 

$eventData = $db->getRows('events', $conditions);

// $eventData = $db->getRows('events', $conditions); 

 
// Redirect to the home page if product not found 
if(empty($eventData)){ 
    header("Location: index.php"); 
} 
?>



<!--
JavaScript code to render PayPal checkout button and execute payment
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- paypal checkout JS lib -->
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>

  <!-- Custom Styling -->
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

  <title> Esport Brunei - Payment confirmation </title>
  <link rel="icon" href="../assets/logo/logo3.png">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">
<div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>
<!-- Content -->
<div class="content clearfix">

 <!-- Main Content Wrapper -->
 <div class="main-content-wrapper">
        <div class="main-content single">

    <!-- Product details -->
    <div class="text-center">
        <img src="<?php echo BASE_URL . '/assets/images/' . $eventData['image']; ?>" class="rounded" style="max-width:100%;" alt="...">
    </div>

    <div class="post-content">  

        <h3>Tournament Title:</h3> 
        <p> <?php echo $eventData['title']; ?></p>

        <h3>Tournament Category :</h3> 
        <p> <?php echo $eventData['category']; ?></p>

        <h3>Registration Fees :</h3> 
        <p> <?php echo $eventData['s_price']; ?> SGD</p>
        
        <br>

        <!-- Checkout button -->
        <div id="paypal-button"></div>
    </div>

</div>
</div>
</div>

<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

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
<script>
paypal.Button.render({
    // Configure environment
    env: '<?php echo $paypal->paypalEnv; ?>',
    client: {
        sandbox: '<?php echo $paypal->paypalClientID; ?>',
        production: '<?php echo $paypal->paypalClientID; ?>'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
        size: 'small',
        color: 'gold',
        shape: 'pill',
    },
    // Set up a payment
    payment: function (data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '<?php echo $eventData['s_price']; ?>',
                    currency: '<?php echo $eventData['currency']; ?>'
                }
            }]
      });
    },
    // Execute the payment
    onAuthorize: function (data, actions) {
        return actions.payment.execute()
        .then(function () {
            // Show a confirmation message to the buyer
            //window.alert('Thank you for your purchase!');
            
            // Redirect to the payment process page
            window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $eventData['id']; ?>&teamid=<?php echo $_GET['teamid']; ?>";
        });
    }
}, '#paypal-button');
</script>

<script>
  /* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }</script>