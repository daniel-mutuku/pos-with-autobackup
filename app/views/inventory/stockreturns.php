<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 6 Nov 2021
 * Time: 09:54
 */
$sdate = $_GET['sdate'];
$edate = $_GET['edate'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <?php if(validation_errors()){ ?>
            <div class="alert alert-danger">
                <p><?php echo validation_errors();?></p>
            </div>
        <?php } ?>
        <?php $this->load->view('includes/flashmessages'); ?>
        <div class="col-sm-12">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
        </div>
        <form action="" method="get">
            <div class="row">
                <div class="col-sm-5 form-group">
                    <label>Start</label>
                    <input class="form-control <?php if ($sdate) {
                        echo 'bg-warning';
                    } ?>" type="date" value="<?= $sdate; ?>" name="sdate">
                </div>
                <div class="col-sm-5 form-group">
                    <label>End</label>
                    <input class="form-control <?php if ($edate) {
                        echo 'bg-warning';
                    } ?>" type="date" style="" value="<?= $edate; ?>" name="edate">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-outline-success" style="margin-top: 30px;">Filter</button>
                </div>
            </div>

        </form>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4 col-sm-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Stockreturns List</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($returns)){
                            $i = 0;
                            $start = 0;
                            $etart = 0;
                            foreach($returns as $one) {
                                $i++;
                                ?>
                                <?php if (isset($sdate)) {
                                }
                                $start = strtotime($sdate);
                                if (isset($edate))
                                    $etart = strtotime($edate) + 86400;
                                if ($start > 0 && $etart > 86400) {
                                    if (strtotime($one['created_at']) >= $start && strtotime($one['created_at']) <= $etart) {
                                        ?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?php echo $one['name'];?></td>
                                            <td><?php echo $one['amount'];?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?></td>
                                            <td>
                                                <button class="btn btn-danger delete" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                } elseif ($start > 0 && $etart == 86400) {
                                    if (strtotime($one['created_at']) >= $start) {
                                        ?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?php echo $one['name'];?></td>
                                            <td><?php echo $one['amount'];?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?></td>
                                            <td>
                                                <button class="btn btn-danger delete" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                } elseif ($etart > 86400 && $start == 0) {
                                    if (strtotime($one['created_at']) <= $etart) {
                                        ?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?php echo $one['name'];?></td>
                                            <td><?php echo $one['amount'];?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?></td>
                                            <td>
                                                <button class="btn btn-danger delete" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td><?php echo $one['name'];?></td>
                                        <td><?php echo $one['amount'];?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($one['created_at'])); ?></td>
                                        <td>
                                            <button class="btn btn-danger delete" data-id = "<?php echo $one['id'];?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>inventory/addreturn" method="post">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Product<small class="required">*</small></label>
                            <select class="form-control select2" name="product">
                                <option value="">--Choose product</option>
                                <?php foreach($products as $one){?>
                                    <option value="<?= $one['id'];?>"><?= $one['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Stock Qty<small class="required">*</small></label>
                            <input type="numbef" min="1" name="qty" class="form-control" placeholder="Qty..">
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
    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this Return? NB: All the associated data will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "inventory/deletereturn/" + id;
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
