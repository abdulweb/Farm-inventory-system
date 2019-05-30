<?php
include ('..\dbh.php');
include ('..\user.php');
$custid = $_POST['custName'];


if (empty($_SESSION['shopping_cart'])) {
  echo "<script>alert('shopping_cart is empty')</script>";
}

 
  $custName = $_POST['custName'];
  $custNumber = $_POST['custNumber'];
  $custAddress = $_POST['custAddress'];
  $date = date('Y-m-d');
  $transcationID =substr(md5($custNumber.$custName.time()),0,9);

  $_SESSION['customer'] = $transcationID;
  $_SESSION['custNumber'] = $custNumber;
  $_SESSION['custAddress'] = $custAddress;
  $_SESSION['custName'] = $custName;
  //insert into db
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $id = $values['item_id'];
      $product_name = $values['item_name'];
      $quantitys = $values['item_quantity'];
      $prices = $values['item_price'];
      $amounnt = $values['item_quantity'] * $values['item_price'];
      ?>
      <tr>
              <td><?=$id?></td>
              <td><?=$product_name?></td>
              <td id="name<?php echo $value['id'] ?>"><?=$quantitys?></td>
              <td><?=$prices?></td>
              <td>
              <?=$amounnt?>
              </td>
          </tr>
      <?php

     $object->storetoCart($id,$quantitys,$date,$custName,$custNumber,$custAddress,$transcationID);
      
    }
    // unset($_SESSION['shopping_cart']);
    // $_SESSION['successMes'] = 'Cart Product Chat out';
    // header('location:suppliers.php');
    header('location:reciept.php');



// else{
//   echo "<script>alert('shopping_cart is not empty')</script>";
// }

?>