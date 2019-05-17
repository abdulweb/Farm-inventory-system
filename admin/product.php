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
                    <h3 class="content-header-title">Product</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Product
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">                                    
                                    <h4 class="card-title"><a href="addProduct.php" class="btn btn-primary "><i class="la la-plus"></i>Add New</a></h4>
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
                                            <table class="table table-striped table-bordered dom-jQuery-events">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>Product Price</th>
                                                        <th>Product Quantity</th>
                                                        <th>Product Category</th>
                                                        <th>Created Date</th>
                                                        <th>Control</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $results = $object->getProduct();
                                                    if(!empty($results)){
                                                    $i=1;
                                                    foreach($results as $value) { 
                                                    ?>
                                                    <tr>
                                                        <td><?=$i?></td>
                                                        <td id="productName<?php echo $value['id'] ?>"><?=$value['productName']?></td>
                                                        <td id="productPrice<?php echo $value['id'] ?>"><?=$value['productPrice']?></td>
                                                        <td id="productQuantity<?php echo $value['id'] ?>"><?=$value['quantity']?></td>
                                                        <td><?=$object->getProductCategory($value['productCategory'])?></td>
                                                        <td><?=$value['date_create']?></td>
                                                        <td>
                                                            <a title="Edit" href="#" class="btn btn-icon btn-primary mr-1 mb-1" onclick="edit_product('<?php echo $value['id'];?>');" id="editBtn<?php echo $value['id'] ?>"><i class="la la-edit"></i></a>
                                                            <!--  -->

                                                            <button type="button" class="btn btn-icon btn-danger mr-1 mb-1 cancel-button" id="<?=$value['id']?>"><i class="la la-trash"></i></button>

                                                            <a title="Edit" href="#" class="btn btn-icon btn-success mr-1 mb-1 saveBtn" onclick="save_product('<?php echo $value['id'];?>');" id="saveBtn<?php echo $value['id'] ?>"><i class="la la-save"></i></a>

                                                        </td>
                                                    </tr>
                                                <?php $i++; }
                                                }
                                                else{

                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
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
 function edit_product(id)
{
    //alert('hey');
 //var title=document.getElementById("title"+id).innerHTML;
 var productName=document.getElementById("productName"+id).innerHTML;
 var productPrice=document.getElementById("productPrice"+id).innerHTML;
 var productQuantity=document.getElementById("productQuantity"+id).innerHTML;
 document.getElementById("productName"+id).innerHTML="<input type='text' class='form-control' autofocus id='productName_text"+id+"' value='"+productName+"'>";
 document.getElementById("productPrice"+id).innerHTML="<input type='text' class='form-control' id='productPrice_text"+id+"' value='"+productPrice+"'>";
 document.getElementById("productQuantity"+id).innerHTML="<input type='text' class='form-control' id='productQuantity_text"+id+"' value='"+productQuantity+"'>";    
 document.getElementById("editBtn"+id).style.visibility="hidden";
 document.getElementById("saveBtn"+id).style.visibility="visible";
}

function save_product(id)
{
 var productName=document.getElementById("productName_text"+id).value;
 var productPrice=document.getElementById("productPrice_text"+id).value;
 var productQuantity=document.getElementById("productQuantity_text"+id).value;
    
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