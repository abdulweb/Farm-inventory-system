<?php
include ('..\dbh.php');
include ('..\user.php');
include('header.php');
?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Manage Category</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="product.php">Manage Product</a>
                                </li>
                                <li class="breadcrumb-item active">Add Product
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Input Validation start -->
                <section class="input-validation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <?php
                                            if(isset($_POST['btn_save']))
                                            {
                                                $productName = $_POST['productName'];
                                                $productPrice = $_POST['productPrice'];
                                                $productQuantity = $_POST['productQuantity'];
                                                $productCategory = $_POST['productCategory'];
                                               $object->insertProduct($productName,$productPrice,$productQuantity,$productCategory);
                                            }
                                        ?>
                                        <form class="form-horizontal" action="" method="post" novalidate>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Product Name <span class="required">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="productName" class="form-control mb-1" required data-validation-required-message="Product name is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Product Price <span class="required">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="productPrice" class="form-control mb-1" maxlength="10" required data-validation-required-message="product Price is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Product Quantity <span class="required">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="productQuantity" class="form-control mb-1" maxlength="10" required data-validation-required-message="Product Quantity is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Product Category <span class="required">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control mb-1" name="productCategory" validation-required-message="Product Category is required" required>
                                                                <option value="">-- SELECT PRODUCT CATEGORY -- </option>

                                                                <?php $results = $object->productCategory(); foreach ($results as $result) {?>
                                                                    <option value="<?=$result['id']?>"><?=$result['name']?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="col-lg-6 col-md-12">
                                                    <div class="text-right">
                                                        <button type="submit" name="btn_save" class="btn btn-success">Submit <i class="la la-thumbs-o-up position-right"></i></button>
                                                        <a href="categories" class="btn btn-danger">Cancel <i class="la la-close position-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Input Validation end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <?php include 'footer.php'; ?>