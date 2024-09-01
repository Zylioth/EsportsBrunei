<?php 
include("../../path.php");
require (ROOT_PATH . "/app/database/connect.php");

$eventid = $_GET['id'];

$participants = "SELECT * FROM `payments` as p 
inner join users as u on p.user_id = u.id
inner JOIN events as e on e.id = p.product_id where e.id = $eventid
";
?>

<table>
  <thead>
   <th ><h2>no.</h2></th>
   <th ><h2>Participants</h2></th>
   <th><h2>Category</h2></th>
   <th colspan="2"><h2>Payment Status</h2></th>
</thead>
<?php 
      $res = mysqli_query($conn, $participants);
        if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
       
       foreach ($fetch as $key => $participant){   ?>
                                    <tr>
                                      <td><?php echo $key + 1; ?>.</td>
                                      <td><?php echo $participant['username']; ?></td>
                                      <td><?php echo $participant['category']; ?></td>
                                      <td><?php echo $participant['payment_status']; ?></td>
                                      <td><?php echo $participant['s_price'];?></td>
                                      <td><?php echo $participant['currency'];?></td>
                                    </tr>  
                                        <?php
                                        } 
                                    }
                                  ?>
 </table>