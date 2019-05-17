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
                    <h3 class="content-header-title">Category</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Product Category
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
                                <?php
                                    if (isset($_POST['addCategory'])) {
                                        $catName = $_POST['catName'];
                                        $object->storeCategory($catName);
                                    }
                                ?>                                   
                                    <h4 class="card-title"><a href="#myModal"  data-toggle="modal" data-target="" class="btn btn-primary "><i class="la la-plus"></i>New Category</a></h4>
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
                                                        <th>Date Add</th>
                                                        <th>Control</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $results = $object->productCategory();
                                                    if(!empty($results)){
                                                    $i=1;
                                                    foreach($results as $value) { 
                                                    ?>
                                                    <tr>
                                                        <td><?=$i?></td>
                                                        <td id="name<?php echo $value['id'] ?>"><?=$value['name']?></td>
                                                        <td><?=$value['date_add']?></td>
                                                        <td>
                                                            <a title="Edit" href="#" class="btn btn-icon btn-primary mr-1 mb-1" onclick="edit_cat('<?php echo $value['id'];?>');" id="editBtn<?php echo $value['id'] ?>"><i class="la la-edit"></i></a>
                                                            <!--  -->

                                                            <button type="button" class="btn btn-icon btn-danger mr-1 mb-1 cancel-button" id="<?=$value['id']?>"><i class="la la-trash"></i></button>

                                                            <a title="Edit" href="#" class="btn btn-icon btn-success mr-1 mb-1 saveBtn" onclick="save_cat('<?php echo $value['id'];?>');" id="saveBtn<?php echo $value['id'] ?>"><i class="la la-save"></i></a>

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
          <form action="" method="post" novalidate>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <h5>Caregory Name <span class="required">*</span></h5>
                        <div class="controls">
                            <input type="text" name="catName" class="form-control mb-1" required data-validation-required-message="Category name is required" required>
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
               delete_cat:'delete_cat',
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
 function edit_cat(id)
{
    //alert('hey');
 //var title=document.getElementById("title"+id).innerHTML;
 var name=document.getElementById("name"+id).innerHTML;
 document.getElementById("name"+id).innerHTML="<input type='text' class='form-control' autofocus id='name_text"+id+"' value='"+name+"'>";
 document.getElementById("editBtn"+id).style.visibility="hidden";
 document.getElementById("saveBtn"+id).style.visibility="visible";
}

function save_cat(id)
{
 var name=document.getElementById("name_text"+id).value;;
    
 $.ajax
 ({
  type:'post',
  url:'function.php',
  data:{
   edit_cat:'edit_cat',
   row_id:id,
   name:name,
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("name"+id).innerHTML=name;

    document.getElementById("editBtn"+id).style.visibility="visible";
    document.getElementById("saveBtn"+id).style.visibility="hidden";
    alert('Record Updated Successfully');
   }
   else{
    alert('error Occured!!!');
   }
  }

 });
}

        </script>