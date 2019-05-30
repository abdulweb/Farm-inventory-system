<?php

include ('..\dbh.php');
include ('..\user.php');
include('header.php');
//unset($_SESSION['shopping_cart']);
if (isset($_POST['add_to_cart'])) {
  
  if (isset($_SESSION['shopping_cart'])) {
    # code...
    $item_array_id = array_column($_SESSION['shopping_cart']  , 'item_id');
    $checkitem = $object->checkProductQuantity($_GET['id']);
    if ($_POST['quantity'] > $checkitem) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Sorry!!"," Item Available is not up to demand ","error");';
        echo '}, 1000);</script>';
    }
    elseif($_POST['quantity'] < 1)
    {
      echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Sorry!!"," Item Must Be a in Positive Integer and More than 0 ","error");';
        echo '}, 1000);</script>';
    }
    elseif (!in_array($_GET['id'], $item_array_id)) {
      # code...
      $count = count($_SESSION['shopping_cart']);
      $item_array = array('item_id' => $_GET['id'], 
                        'item_name' => $_POST['productName'],
                        'item_price' => $_POST['productPrice'],
                        'item_quantity' => $_POST['quantity'],
    );
    $_SESSION['shopping_cart'] [$count] = $item_array;
    }
    else{
        // echo "<script>alert('Item Already Added ')</script>";
        // echo '<script>window.location = "suppliers.php"</script>';
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Sorry!!"," Item Already Added to Cart  ","error");';
        echo '}, 1000);</script>'; 
    }

  }
  else{
    
    
    $item_array = array('item_id' => $_GET['id'], 
                        'item_name' => $_POST['productName'],
                        'item_price' => $_POST['productPrice'],
                        'item_quantity' => $_POST['quantity'],
    );
    $_SESSION['shopping_cart'] [0] = $item_array;
  }
}

if (isset($_GET["action"])) {
  # code...
  if ($_GET["action"] == "delete") {
    # code...
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      if ($values['item_id'] == $_GET['id']) {
        # code...
        unset($_SESSION['shopping_cart'][$keys]);
        // echo '<script>alert("Item Removed")</script>';
        // echo '<script>window.location="suppliers.php"</script>';
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Successfully!!"," Item Removed from cart  ","success");';
        echo '}, 1000);</script>'; 
      }
      // echo '<script>alert("Item Not Removed")</script>';
      // //unset($_SESSION['shopping_cart']);
    }
  }
}
?>
<style type="text/css">
    .saveBtn{
        visibility: hidden;
    }
</style>
<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Suppliers</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Suppliers
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_SESSION['errorMes'])) {
                            echo '<script type="text/javascript">';
                            echo 'setTimeout(function () { swal("Error!","Fails to add to sales !","error");';
                            echo '}, 1000);</script>';
                            unset($_SESSION['errorMes']);
                        }
                            

                            if (isset($_SESSION['successMes'])) {
                                echo '<script type="text/javascript">';
                                echo 'setTimeout(function () { swal("Congratulation!","Cart Product CheckOut Successfully !","success");';
                                echo '}, 1000);</script>';
                                unset($_SESSION['successMes']);
                            }

                         ?>
                    </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">                                    
                                    <h4 class="card-title">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">                                        
                                        
                                        <div class="table-responsive">
                                           <form>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="table-responsive " style="margin-top: 30px;">
                                                                <table class="table table-striped table-bordered dom-jQuery-events">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product Name</th>
                                                                            <th>Quantity</th>
                                                                            <th>price</th>
                                                                            <th>control</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $results = $object->getProduct();
                                                                        if(!empty($results)){
                                                                        foreach($results as $value) { 
                                                                        ?>
                                                                        <tr>
                                                                            <td id="productName<?php echo $value['id'] ?>"><?=$value['productName']?></td>
                                                                            <td>
                                                                                <form method="POST" action="suppliers.php?action=add&id=<?php echo $value['id']?>">
                                                                                <input  text="text" class="form-control" name="quantity" required />
                                                                                <input type="hidden" name="productName" value="<?=$value['productName']?>">
                                                                                <input type="hidden" name="productPrice" value="<?=$value['productPrice']?>">
                                                                                
                                                                            </td>
                                                                            <td id="price<?php echo $value['id'] ?>"><?=$value['productPrice']?></td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-primary mr-1 mb-1" name="add_to_cart"><i class="fa fa-plus"></i>AddToCart</button></form>
                                                                                <!--  -->

                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                     }
                                                                    }
                                                                    else{

                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">                                    
                                    <h4 class="card-title">
                                    <h4>Customer- shopping cart</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">                                        
                                        <?php
                                        if (!empty($_SESSION['shopping_cart'])) {
                                          ?>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>price</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                      //
                                                      $total = 0;
                                                      foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                                                        # code...
                                                      
                                                      ?>
                                                     <form method="post" action="process_supplier.php">
                                                      <tr>
                                                        <td><?php echo $values['item_name']; ?></td>
                                                        <td><?php echo $values['item_quantity']; ?></td>
                                                         <td><?php echo $values['item_price']; ?></td>
                                                          <td><?php echo number_format($values['item_quantity'] * $values['item_price'] , 2); ?></td>
                                                          <td><a href="suppliers.php?action=delete&id=<?php echo $values['item_id']; ?>"><span style="font-size: 19px;" class="text-align text-danger la la-trash" title="delete"></span></a></td>
                                                      </tr>
                                                      <?php

                                                      $total = $total + ($values['item_quantity'] * $values['item_price']);
                                                    }
                                                    ?>
                                                     <input type="hidden" name="mytotal" id="mytotal" value="<?php echo "$total";?>"/>
                                                    <tr>
                                                      <td colspan="3" align="right" style="font-weight: bold;">Total : </td>
                                                      <td align="right" style="font-weight: bold;"><?php echo '#'. number_format($total,2); ?></td>
                                                      <td  style="margin-left: -30px;"> 
                                                      <a href="#myModal" data-toggle="modal" data-target="" class="btn btn-success la la-shopping-cart" style="width: 50px;"> 
                                                      </td>
                                                    </tr>
                                                 <?php }
                                                 // else
                                                 //  echo "<script>alert('shopping cart empty')</script>";
                                                  ?>
                                                  </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- DOM - jQuery events table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
     <!-- Category Modal -->
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> <span class="text-info pull-right">Modal Header </span></h4>
        </div>
        <div class="modal-body">
          <form method="post" action="process_supplier.php" novalidate>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <h5>Customer Name <span class="required">*</span></h5>
                        <div class="controls">
                           <input class="form-control mb-1" type="text" name="custName" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Customer Mobile Phone <span class="required">*</span></h5>
                        <div class="controls">
                           <input class="form-control mb-1" type="number" name="custNumber" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Customer Address <span class="required">*</span></h5>
                        <div class="controls">
                           <textarea class="form-control mb-1" name="custAddress" required></textarea>
                        </div>
                    </div>
                </div>
                

            </div>
            <div class="pull-right">
            <button type="submit" name="addCategory" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
        
      </div>
      
    </div>
  </div>
    <!-- end of category Modal -->
<?php include 'footer.php'; ?>
<script>
    $(document).ready(function(){

    $('.cancel-button').on('click',function(){        
        swal({
            title: "Are you sure?",
            text: "To Delete This Record!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
        .then((isConfirm) => {
            if (isConfirm) {
                var id=this.id;
                $.ajax({
                  type:'post',
                  url:'function.php',
                  data:{
                   delete_product:'delete_product',
                   row_id:id,
                  },
                  success: function(inputValue){
                    if (inputValue=="success") 
                    {
                        swal("Deleted!", "Your Record has been deleted.", "success");
                    setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                  }, 1000); 
                    }
                    else{swal("Error", "Your Record is safe", "error");}
                    
                    }
                });
                
            } 
            // else {
            //     swal("Cancelled", "Your Record is safe", "error");
            // }
        });

    });   

});
</script>
<script>
 function addquantity(id)
{
    //alert('hey');
 //var title=document.getElementById("title"+id).innerHTML;
 var quantity=document.getElementById("quantity"+id).innerHTML;
 document.getElementById("quantity"+id).innerHTML="<input type='text' class='form-control' autofocus id='quantity_text"+id+"' value='"+quantity+"'>";
     
 document.getElementById("editBtn"+id).style.visibility="hidden";
 document.getElementById("saveBtn"+id).style.visibility="visible";
}

function addToCart(id)
{
    //alert(id);
 var quantity=document.getElementById("quantity_text"+id).value;
 //var custName = id;
 //var productID = document.getElementById("productName"+id).value;
 //alert(productID);
    
 $.ajax
 ({
  type:'post',
  url:'function.php',
  data:{
   addCart:'addCart',
   row_id:id,
   quantity:quantity,
   // productID:productID,
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("editBtn"+id).style.visibility="visible";
    document.getElementById("saveBtn"+id).style.visibility="hidden";
    //alert('Record Updated Successfully');
    swal("Updated!", "Product Record has been Update.", "success");
                setTimeout(function(){// wait for 5 secs(2)
                   location.reload(); // then reload the page.(3)
              }, 1000);
   }
   else{
    alert(response);
   }
  }

 });
}

        </script>