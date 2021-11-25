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
                <h6 class="m-0 font-weight-bold text-primary">Departments</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>ID No</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>ID No</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($staff)){
                            $i=0;
                            foreach($staff as $one) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php echo $one['fname']." ".$one['lname'];?></td>
                                    <td><?php echo $one['email'];?></td>
                                    <td><?php echo $one['username'];?></td>
                                    <td><?php echo $one['phone_no'];?></td>
                                    <td><?php echo $one['id_no'];?></td>
                                    <td>
                                        <button class="btn btn-warning reset" data-id = "<?php echo $one['id'];?>"><i class="fa fa-key"></i></button>
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
                <form action="<?php echo base_url();?>hrm/employees" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>First Name<small class="required">*</small></label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Last Name<small class="required">*</small></label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email<small class="required">*</small></label>
                            <input type="email" name="email" class="form-control" placeholder="Email..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Username<small class="required">*</small></label>
                            <input type="text" name="username" class="form-control" placeholder="Username..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone<small class="required">*</small></label>
                            <input type="tel" name="phone_no" class="form-control" placeholder="Phone no..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" placeholder="DOB..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>ID No<small class="required">*</small></label>
                            <input type="number" name="id_no" class="form-control" placeholder="ID No..">
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
                            <label>Role<small class="required">*</small></label>
                            <select class="form-control select2" name="role_id">
                                <option value="">--Choose role</option>
                                <?php foreach($roles as $one){?>
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
                            <label>First Name<small class="required">*</small></label>
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Last Name<small class="required">*</small></label>
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email<small class="required">*</small></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Username<small class="required">*</small></label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone<small class="required">*</small></label>
                            <input type="tel" id="phone_no" name="phone_no" class="form-control" placeholder="Phone no..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>DOB</label>
                            <input type="date" id="dob" name="dob" class="form-control" placeholder="DOB..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>ID No<small class="required">*</small></label>
                            <input type="number" id="id_no" name="id_no" class="form-control" placeholder="ID No..">
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
                            <label>Role<small class="required">*</small></label>
                            <select class="form-control select2" id="role_id" name="role_id">
                                <option value="">--Choose role</option>
                                <?php foreach($roles as $one){?>
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
<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="" id="resetform" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Password<small class="required">*</small></label>
                            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password..">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirm<small class="required">*</small></label>
                            <input type="password" id="pconf" name="pconf" class="form-control" placeholder="Confirm..">
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
    $('.reset').click(function() {
        var id = $(this).attr("data-id");
        var url = "<?php echo base_url();?>" + "hrm/resetpass/" + id;
        $('#resetform').attr("action",url);
        $('#reset').modal('show');
    });
    $('.edit').click(function(){
        $('#editform').hide();
        $('#edit').modal('show');
        $('#viewloading').show();

        var id = $(this).attr("data-id");
        var url = "<?php echo base_url();?>" + "hrm/viewstaff/" + id;
        var editurl =  "<?php echo base_url();?>" + "hrm/editstaff/" + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response){
                var teacher = response;
                $('#fname').val(teacher['fname']);
                $('#lname').val(teacher['lname']);
                $('#email').val(teacher['email']);
                $('#username').val(teacher['username']);
                $('#phone_no').val(teacher['phone_no']);
                $('#dob').val(teacher['dob']);
                $('#id_no').val(teacher['id_no']);
                $('#branch_id').val(teacher['branch_id']).change();
                $('#role_id').val(teacher['role_id']).change();

                $('#editform').show();
                $('#viewloading').hide();
                $('#editform').attr("action",editurl);
            }

        });
    });

    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this Role? NB: All the associated data will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "hrm/deletestaff/" + id;
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


