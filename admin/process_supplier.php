<?php
include ('..\dbh.php');
include ('..\user.php');
$custid = $_POST['custName'];


if (empty($_SESSION['shopping_cart'])) {
  echo "<script>alert('shopping_cart is empty')</script>";
}

  $_SESSION['customer'] = $_POST['custName'];
  $date = date('Y-m-d');
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

     $object->storetoCart($id,$quantitys,$date,$custid);
      
    }
    // unset($_SESSION['shopping_cart']);
    // $_SESSION['successMes'] = 'Cart Product Chat out';
    // header('location:suppliers.php');
    header('location:reciept.php');



// else{
//   echo "<script>alert('shopping_cart is not empty')</script>";
// }

?>