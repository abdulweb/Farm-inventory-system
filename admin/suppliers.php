<?php
include ('..\dbh.php');
include ('..\user.php');
include('header.php');

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
                        <div class="col-md-7">
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
                                                    <div class="form-group">
                                                        <h5>Customer Name <span class="required">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control mb-1" name="productCategory" validation-required-message="Product Category is required" required>
                                                                <option value="">-- SELECT CUSTOMER -- </option>

                                                                <?php $results = $object->getAllCustomers(); foreach ($results as $result) {?>
                                                                    <option id="name<?=$result['id']?>"> value="<?=$result['id']?>"><?=$result['fullName']?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                            <div class="table-responsive " style="margin-top: 30px;">
                                            <table class="table table-striped table-bordered dom-jQuery-events">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>price</th>
                                                        <th>Quantity</th>
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
                                                        <td id="price<?php echo $value['id'] ?>"><?=$value['productPrice']?></td>
                                                        <td id="quantity<?php echo $value['id'] ?>"></td>
                                                        <td>
                                                            <a title="Edit" href="#" class="btn btn-sm btn-primary mr-1 mb-1" onclick="addquantity('<?php echo $value['id'];?>');" id="editBtn<?php echo $value['id'] ?>">Add quantity</a>
                                                            <!--  -->

                                                            <a title="Edit" href="#" class="btn btn-sm btn-success mr-1 mb-1 saveBtn" onclick="addToCart('<?php echo $value['id'];?>');" id="saveBtn<?php echo $value['id'] ?>">Add to Cart</a>

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
                                        <!--  -->
                                                        </div>
                                                    </div>
                                                </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
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
                                        
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                </tr>
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
 var quantity=document.getElementById("quantity_text"+id).value;
 var custName = document.getElementById("name"+id).value;
 var productID = document.getElementById("productName"+id);
    
 $.ajax
 ({
  type:'post',
  url:'function.php',
  data:{
   edit_product:'edit_product',
   row_id:id,
   productName:productName,
   productPrice:productPrice,
   productQuantity:productQuantity,
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("productName"+id).innerHTML=productName;
    document.getElementById("productPrice"+id).innerHTML=productPrice;
    document.getElementById("productQuantity"+id).innerHTML=productQuantity;

    document.getElementById("editBtn"+id).style.visibility="visible";
    document.getElementById("saveBtn"+id).style.visibility="hidden";
    //alert('Record Updated Successfully');
    swal("Updated!", "Product Record has been Update.", "success");
                setTimeout(function(){// wait for 5 secs(2)
                   location.reload(); // then reload the page.(3)
              }, 1000);
   }
   else{
    alert('response');
   }
  }

 });
}

        </script>