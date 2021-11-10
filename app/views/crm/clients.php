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
                        <?php if(!empty($students)){
                            foreach($students as $one) {
                                if($one['status'] == 1){
                                    $class = "success";
                                    $status = "active";
                                }else{
                                    $class = "danger";
                                    $status = "expired";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $one['fname']." ".$one['lname'];?></td>
                                    <td><?php echo $one['adm'];?></td>
                                    <td><?php echo $one['cname'];?></td>
                                    <td><?php if($one['last_seen']) echo date('d/m/Y H:i',strtotime($one['last_seen']));?></td>
                                    <td><span class="badge badge-<?php echo $class;?>"><?php echo $status;?></span></td>
                                    <td>
                                        <button class="btn btn-info view-student" data-id = "<?php echo $one['id'];?>"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-primary edit-student" data-id = "<?php echo $one['id'];?>"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger delete-subject" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                        <?php if($one['status'] == 1){?>
                                            <button class="btn btn-warning ban-student" data-id = "<?php echo $one['id'];?>"><i class="fas fa-ban"></i></button>
                                        <?php }else{ ?>
                                            <button class="btn btn-success allow-student" data-id = "<?php echo $one['id'];?>"><i class="fas fa-chevron-circle-right"></i></button>
                                        <?php  }?>

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

