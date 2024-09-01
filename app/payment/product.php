<?php 
// Include and initialize database class 
include_once 'DB.class.php'; 
$db = new DB; 
 
// Get all products from database 
$events = $db->getRows('events'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esports Brunei - Event Payment</title>

</head>
<body>
    
<!-- List products -->
<?php
if(!empty($events)){
    foreach($events as $row){
?>
<div class="item">
    <img src="images/<?php echo $row['image']; ?>"/>
    <p>Name: <?php echo $row['title']; ?></p>
    <p>Price: <?php echo $row['s_price']; ?></p> 

    <!-- ani ambil id for event/product -->
    <a href="checkout.php?id=<?php echo $row['id']; ?>">BUY</a> 
</div>
<?php        
    }
}else{
    echo '<p>Product(s) not found...</p>';
}
?>

</body>
</html>
