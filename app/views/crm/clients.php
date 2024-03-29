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
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add-new"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4 col-sm-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Total Shopped</th>
                            <th>Due</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Total Shopped</th>
                            <th>Due</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($clients)){
                            $i = 0;
                            foreach($clients as $one) {
                                $i++;
                                $totshopped = $this->crm_model->totalshopped($one['id']);
                                $totpaid = $this->crm_model->totalpaid($one['id']);
                                $due = $totshopped-$totpaid;
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php echo $one['name'];?></td>
                                    <td><?php echo $one['phone'];?></td>
                                    <td>Ksh. <?php echo number_format($totshopped,"2",".",",");?></td>
                                    <td style="font-weight: bold;<?php if($due > 0) {echo 'color: red;';}else{ echo 'color: green';}?>">Ksh. <?php echo number_format(abs($due),"2",".",",");?></td>
                                    <td>
                                        <button class="btn btn-success pay" data-id = "<?php echo $one['id'];?>"><i class="fab fa-amazon-pay"></i></button>
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
<div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="<?php echo base_url();?>crm/clients" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone no<small class="required">*</small></label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone no..">
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
<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pay Supplier</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>crm/payclients" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Amount.<small class="required">*</small></label>
                            <input type="hidden" id="client_id" name="client_id">
                            <input type="number" min="0" name="amount" class="form-control" placeholder="Amount..">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Mode<small class="required">*</small></label>
                            <select class="form-control select2" name="mode">
                                <option value="">--Choose warehouse</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="mpesa">M-Pesa</option>
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
<div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="<?php echo base_url();?>crm/clients" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone no<small class="required">*</small></label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone no..">
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
                <h5 class="modal-title" id="exampleModalLabel">Modify</h5>
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
                            <label>Phone no<small class="required">*</small></label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone no..">
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
        var url = "<?php echo base_url();?>" + "crm/viewclient/" + id;
        var editurl =  "<?php echo base_url();?>" + "crm/editclient/" + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response){
                var teacher = response;
                $('#name').val(teacher['name']);
                $('#phone').val(teacher['phone']);
                $('#branch_id').val(teacher['branch_id']).change();

                $('#editform').show();
                $('#viewloading').hide();
                $('#editform').attr("action",editurl);
            }

        });
    });
    $('.pay').click(function(){
        var id = $(this).attr("data-id");
        $('#client_id').val(id);
        $('#pay').modal('show');
    });
    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this Client? NB: All the associated data will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "crm/deleteclient/" + id;
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

