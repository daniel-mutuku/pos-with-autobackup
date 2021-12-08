<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 6 Nov 2021
 * Time: 09:54
 */?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <?php if(validation_errors()){ ?>
            <div class="alert alert-danger">
                <p><?php echo validation_errors();?></p>
            </div>
        <?php } ?>
        <?php $this->load->view('includes/flashmessages'); ?>
        <div class="row">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4 col-sm-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products List</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($products)){
                            $i = 0;
                            foreach($products as $one) {
                                $i++;
                                $stock = $this->inventory_model->getstock($one['id']);
                                if ($stock < 5){
                                    $color = "red";
                                }else{
                                    $color = "black";
                                }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php echo $one['name'];?></td>
                                    <td><?php echo $one['sku'];?></td>
                                    <td><?php echo $one['barcode'];?></td>
                                    <td><?php echo $one['buying_price'];?></td>
                                    <td><?php echo $one['selling_price'];?></td>
                                    <td style="color: <?= $color;?>"><?= $stock ; ?></td>
                                    <td>
                                        <button class="btn btn-outline-success add-stock" data-id = "<?php echo $one['id'];?>"><i class="fa fa-cart-plus"></i></button>
                                        <button class="btn btn-primary edit" data-id = "<?php echo $one['id'];?>"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger delete" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                            <?php   }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>inventory/listproducts" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>SKU<small class="required">*</small></label>
                            <input type="text" name="sku" class="form-control" placeholder="SKU..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Barcode<small class="required">*</small></label>
                            <input type="tel" maxlength="12" minlength="12" name="barcode" class="form-control" placeholder="Barcode..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Buying Price<small class="required">*</small></label>
                            <input type="number" min="1" name="buying_price" class="form-control" placeholder="BP..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Selling Price<small class="required">*</small></label>
                            <input type="number" min="1" name="selling_price" class="form-control" placeholder="SP..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Warehouse<small class="required">*</small></label>
                            <select class="form-control select2" name="branch_id">
                                <option value="">--Choose warehouse</option>
                                <?php foreach($warehouses as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Categories<small class="required">*</small></label>
                            <select class="form-control select2" name="cat_id">
                                <option value="">--Choose category</option>
                                <?php foreach($categories as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                    </div>

                    <input type="submit" class="btn btn-outline-success">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>inventory/addstock" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Stock Qty<small class="required">*</small></label>
                            <input type="number" min="1" name="qty" class="form-control" placeholder="Qty..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Total Price<small class="required">*</small></label>
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="number" min="1" name="price" class="form-control" placeholder="Total price..">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Supplier<small class="required">*</small></label>
                            <select class="form-control select2" name="supplier_id">
                                <option value="">--Choose supplier</option>
                                <?php foreach($suppliers as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                    </div>

                    <input type="submit" class="btn btn-outline-success">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="editform" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>SKU<small class="required">*</small></label>
                            <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Barcode<small class="required">*</small></label>
                            <input type="tel" maxlength="12" minlength="12" id="barcode" name="barcode" class="form-control" placeholder="Barcode..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Buying Price<small class="required">*</small></label>
                            <input type="number" id="buying_price" min="1" name="buying_price" class="form-control" placeholder="BP..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Selling Price<small class="required">*</small></label>
                            <input type="number" id="selling_price" min="1" name="selling_price" class="form-control" placeholder="SP..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Warehouse<small class="required">*</small></label>
                            <select class="form-control select2" id="branch_id" name="branch_id">
                                <option value="">--Choose warehouse</option>
                                <?php foreach($warehouses as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Categories<small class="required">*</small></label>
                            <select class="form-control select2" id="cat_id" name="cat_id">
                                <option value="">--Choose category</option>
                                <?php foreach($categories as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                    </div>

                    <input type="submit" class="btn btn-outline-success">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit').click(function(){
        $('#editform').hide();
        $('#edit').modal('show');
        $('#viewloading').show();

        var id = $(this).attr("data-id");
        var url = "<?php echo base_url();?>" + "inventory/viewproduct/" + id;
        var editurl =  "<?php echo base_url();?>" + "inventory/editproduct/" + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response){
                var teacher = response;
                $('#name').val(teacher['name']);
                $('#sku').val(teacher['sku']);
                $('#barcode').val(teacher['barcode']);
                $('#buying_price').val(teacher['buying_price']);
                $('#selling_price').val(teacher['selling_price']);
                $('#branch_id').val(teacher['branch_id']).change();
                $('#cat_id').val(teacher['cat_id']).change();

                $('#editform').show();
                $('#viewloading').hide();
                $('#editform').attr("action",editurl);
            }

        });
    });
    $('.add-stock').click(function(){
        var id = $(this).attr("data-id");
        $("#product_id").val(id);
        $('#add-stock').modal('show');
    });
    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this Product? NB: All the associated data will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "inventory/deleteproduct/" + id;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response){
                    window.location.reload();
                }
            });
        }
    });
</script>
