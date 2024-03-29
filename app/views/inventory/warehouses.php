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
                <h6 class="m-0 font-weight-bold text-primary">Branches List</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Store No</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Store No</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($warehouses)){
                            $i = 0;
                            foreach($warehouses as $one) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $one['name'];?></td>
                                    <td><?= $one['location'];?></td>
                                    <td><?= $one['store_no'];?></td>
                                    <td><?= $one['branch_phone'];?></td>
                                    <td><?= $one['branch_email'];?></td>
                                    <td>
                                        <button class="btn btn-primary edit" data-id = "<?= $one['id'];?>"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger delete" data-id = "<?= $one['id'];?>"><i class="fa fa-trash"></i></button>

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
                <form action="<?php echo base_url();?>inventory/warehouses" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Location<small class="required">*</small></label>
                            <input type="text" name="location" class="form-control" placeholder="Location..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Store No<small class="required">*</small></label>
                            <input type="text" name="store_no" class="form-control" placeholder="Store no...">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Phone number<small class="required">*</small></label>
                            <input type="text" name="branch_phone" class="form-control" placeholder="Phone number">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Branch Email<small class="required">*</small></label>
                            <input type="email" name="branch_email" class="form-control" placeholder="Branch  email...">
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
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" id="viewloading">
                    <img src="<?php echo base_url();?>res/img/loading.gif" style="width: 30px;">
                </div>
                <form action="" method="post" id="editform">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name<small class="required">*</small></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Location<small class="required">*</small></label>
                            <input type="text"id="location" name="location" class="form-control" placeholder="Location..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Store No<small class="required">*</small></label>
                            <input type="text"id="store_no" name="store_no" class="form-control" placeholder="Store no...">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Phone number<small class="required">*</small></label>
                            <input type="text"id="branch_phone" name="branch_phone" class="form-control" placeholder="Phone number">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Branch Email<small class="required">*</small></label>
                            <input type="email"id="branch_email" name="branch_email" class="form-control" placeholder="Branch  email...">
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
        var url = "<?php echo base_url();?>" + "inventory/viewwarehouse/" + id;
        var editurl =  "<?php echo base_url();?>" + "inventory/editwarehouse/" + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response){
                var teacher = response;
                $('#name').val(teacher['name']);
                $('#location').val(teacher['location']);
                $('#store_no').val(teacher['store_no']);
                $('#branch_phone').val(teacher['branch_phone']);
                $('#branch_email').val(teacher['branch_email']);

                $('#editform').show();
                $('#viewloading').hide();
                $('#editform').attr("action",editurl);
            }

        });
    });
    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this Warehouse? NB: All the associated data i.e products, staff, invoices etc will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "inventory/deletewarehouse/" + id;
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