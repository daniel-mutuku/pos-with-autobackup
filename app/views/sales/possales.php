<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 6 Nov 2021
 * Time: 21:02
 */
?>
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

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4 col-sm-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">POS Sales</h6><br>
                <?php $this->load->view('includes/tablebuttons'); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sale ID</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Sale ID</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php if(!empty($sales)){
                            $i = 0;
                            foreach($sales as $one) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php echo $one['id'];?></td>
                                    <td><?php echo $one['name'];?></td>
                                    <td><?php echo number_format($one['invoice_amt'],"2",".",",");?></td>
                                    <td><?php echo number_format($one['discount'],"2",".",",");?></td>
                                    <td><?php echo $one['type'];?></td>
                                    <td><?php echo date('d/m/Y H:i',strtotime($one['created_at']));?></td>
                                    <td>
                                        <button class="btn btn-info view" data-string = '<?php echo $one['particulars'];?>'><i class="fa fa-eye"></i></button>
                                        <a href="<?=base_url();?>sales/printinvoice/<?=$one['id'];?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
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
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Products</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-sm-6">Product</div>
                   <div class="col-sm-3">Qty</div>
                   <div class="col-sm-3">Cost</div>
               </div>
                <hr>
                <div id="prods">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.view').click(function(){
        $("#prods").html("");
        var prods = $(this).attr("data-string");
        var prodsArr = JSON.parse(prods);
        html = "";
        for (var i= 0;i<prodsArr.length; i++){
            var oneprod = prodsArr[i];
            html += "<div class='row'><div class='col-sm-6'>" + oneprod['prodName'] + "</div><div class='col-sm-3'>" + oneprod['prodQty'] + "</div><div class='col-sm-3'> " + oneprod['prodCost'] + "</div></div><hr>";
        }
        $("#prods").append(html);
        $('#view').modal('show');
    });

    $('.delete').click(function(){
        var del = confirm("Are you sure you want to delete this record? NB: All the associated data will be deleted too!");
        if (del == true) {
            var id = $(this).attr("data-id");
            var url = "<?php echo base_url();?>" + "sales/deleteinvoice/" + id;
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

    var print = "<?= $print; ?>";
    if(print > 0)
        window.location.href = "<?= base_url();?>sales/printinvoice/" + print;
</script>

