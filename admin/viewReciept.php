<?php
include ('..\dbh.php');
include ('..\user.php');
include('header.php');

?>
<style type="text/css">
    h5{
        font-weight: bold;
    }
    .printBtn{
        margin-bottom: 10px;
    }
</style>
<style type="text/css">
@media print
{
body * { visibility: hidden; }
.div2 * { visibility: visible; }
.div2 { position: absolute; top: 40px; left: 30px; }
}
</style>
<?php if ($_GET['id'] == '' || empty($_GET['id']) || $_GET['id'] == null) {
   header('location:salesReport.php');
}
else{
    $getId = $_GET['id'];
     ?>
<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Sales</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="product.php">product</a>
                                </li>
                                <li class="breadcrumb-item active">sales
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
                                <div class="card-content collapse show div2" id="printMe">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Farm Management System</h4>
                                                <small></small>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="pull-right m-r-10 font-bold">Invoice Number <br><small class="font-bold"><?=$getId;?></small></h4>

                                            </div><br>

                                            <div class="col-md-12" style="border: 1px solid #ccc; margin-bottom: 20px;"></div>

                                            <div class="col-md-3">
                                                <h5 >Address</h5>
                                                <p>Back of Sohun stadium Ogbomoso, Oyo State</p>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <h5>Customer Details</h5>
                                                <?php 
                                                    $res = $object->getParticularCustomer($getId);
                                                    if (!empty($res)) {
                                                    ?>
                                                <h5 class="text-italic">Name: <small><?=$res['customerName']?></small></h5>
                                                <h5 class="text-italic">Contact: <small><?=$res['customerNumber']?></small></h5>
                                                <h5 class="text-italic">Address: <small><?=$res['customerAddress']?></small></h5>
                                                
                                                </div>

                                            <!-- </div> -->
                                            <div class="col-md-3 ">
                                                <h5 class="pull-right">ordered date: <br> <small><?=$res['date_add']?> </small> </h5> 
                                            </div>
                                            <?php 
                                                }  ?>

                                            <!-- <div class="col-md-12"> -->
                                        <div class="table-responsive">
                                        <?php
                                        
                                          ?>
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>
                                                <?php
                                                      $total = 0; $counter =1;
                                                       $productCarts = $object->getCustomerdeatils($getId);
                                                      foreach ($productCarts as $productCart) {
                                                      ?>
                                                    <tr>
                                                        <td><?=$counter?></td>
                                                        <td><?php echo $productCart['prdID']; ?></td>
                                                        <td><?php echo $productCart['quantity']; ?></td>
                                                        <td><?php echo $object->getProductPrice($productCart['prdID']); ?></td>
                                                        <td><?php echo number_format($productCart['quantity'] *$object->getProductPrice($productCart['prdID']) , 2); ?></td>
                                                    </tr>
                                                    <?php
                                                      $total = $total + ($productCart['quantity'] *$object->getProductPrice($productCart['prdID']));
                                                    $counter++;}
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                        <hr>
                                        <h3 class="text-right"> <strong>Total Price</strong> : #<?php echo number_format($total , 2);?></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light printBtn"><i class="la la-print"> </i> Print</a>
                                    </div>
                                </div>


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
    <?php } ?>
   
<?php include 'footer.php';
//unset($_SESSION['shopping_cart']);unset($_SESSION['customer']); ?>
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>