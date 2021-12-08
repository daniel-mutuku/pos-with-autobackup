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
 */ ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('success-msg')) { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
            <?php } ?>
            <?php if ($this->session->flashdata('error-msg')) { ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
            <?php } ?>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-content" id="mainbody" style="display:none">

                        <div id="invoice-template" class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <select class="form-control select2" id="cName" name="cName"
                                                    style="width: 100%;">
                                                <option value="">Choose customer here</option>
                                                <?php if ($clients) {
                                                    foreach ($clients as $client) {
                                                        ?>
                                                        <option value="<?php echo $client['id'] ?>" <?php if ($client['is_walkin'] == 1) {
                                                            echo "selected";
                                                        } ?>
                                                                data-string="<?php echo $client['is_walkin']; ?>"><?php echo $client['name']; ?></option>
                                                        <?php
                                                    }
                                                } ?>
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group col-sm-4"><a
                                                    href="<?php echo base_url(); ?>crm/clients"
                                                    class="btn btn-info">ADD NEW</a></div>


                                    </div>

                                    <div class="form-bordered"
                                         style="min-height: 350px; max-height: 350px;overflow-y: auto;">
                                        <table class="table table-striped table-bordered zero-configuration"
                                               cellspacing="0"
                                               width="100%" id="cartTable">
                                            <div class="row">
                                                <div class="col-sm-3"><b>Name</b></div>
                                                <div class="col-sm-2"><b>Qty</b></div>
                                                <div class="col-sm-2"><b>Cost</b></div>
                                                <div class="col-sm-2"><b>Total</b></div>
                                                <div class="col-sm-1"><b>*</b></div>
                                            </div>
                                            <form id="cartform">
                                                <input type="hidden"
                                                       name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                <div class="row" id="prodrow">
                                                </div>
                                            </form>
                                        </table>
                                        <div class="row">
                                            <div class="col-sm-4"><h5><b>Total: </b></h5></div>
                                            <div class="col-sm-4"><h5 style="color: green;"><span
                                                            id="grandTotal"><?php echo $grandTot; ?></span></h5></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4"><h5><b>Discount: </b></h5></div>
                                            <div class="col-sm-4"><h5 style="color: green;"><input type="number"
                                                                                                   class="form-control"
                                                                                                   id="granddiscount"
                                                                                                   value="0"><span
                                                            id="grandDisc"><?php echo $grandDisc; ?></span></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"><h5><b>Grand Total: </b></h5></div>
                                            <div class="col-sm-4"><h5 style="color: green;"><span id="tot"></span></h5>
                                            </div>
                                        </div>
                                        <div class="row" hidden>
                                            <div class="col-sm-4"><h5><b>VAT: </b></h5></div>
                                            <div class="col-sm-4"><h5 style="color: green;"><span
                                                            id="grandTax"><?php echo $grandTax; ?></span></h5></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" id="btnNow" onclick="readTable(1)">PAY NOW</button>
                                    <button class="btn btn-danger" id="btnCredit" onclick="readTable(2)">CREDIT
                                        PAYMENT
                                    </button>
                                </div>
                                <div class="col-sm-4" style="min-height: 350px; max-height: 350px;overflow-y: auto;">
                                    <div class="row" style="margin: 10px;">
                                        <input type="text" id="searchbox" class="form-control"
                                               placeholder="Search name,barcode or sku">
                                    </div>
                                    <div class="row">

                                        <?php

                                        foreach ($products as $oneProd) {
                                            $stock = $oneProd['qty'];
                                            ?>
                                            <div class="col-sm-6 single-prod" style="line-height: 15px;margin-top: 10px;"
                                                 data-string="<?php echo $oneProd['name'] . " " . $oneProd['sku'] . " " . $oneProd['barcode']; ?>">
                                                <div class="card card-block" style="border: 1px solid grey;">
                                                    <div class="card-body">
                                                        <h5 class="card-title"
                                                            style="font-size: 15px"><?php echo $oneProd['name']; ?></h5>
                                                        <h6 class="card-text" style="margin-top: 5px">
                                                            Ksh <?php echo $oneProd['selling_price']; ?></h6>
                                                        <i style="color: <?php if ($stock < 0) {
                                                            echo 'red';
                                                        } else {
                                                            echo 'blue';
                                                        } ?>;">Stock: <?php echo $stock; ?></i>
                                                        <?php if ($stock > 0) { ?>
                                                            <button id="add_<?php echo $oneProd['id']; ?>"
                                                                    data-value="<?php echo $oneProd['id']; ?>"
                                                                    class="btn btn-success"
                                                                    onclick="addToCart(this.id)"><i
                                                                        class="fas fa-plus"></i></button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        if (sizeof($products) <= 0) {
                                            ?>
                                            <div class="card-body">
                                                <div class="alert alert-danger">You do not have products to sell</div>
                                                <a href="#" class="btn btn-primary" role="button">
                                                    ADD PRODUCTS
                                                </a>
                                            </div> <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- The Modal -->
    <div class="modal fade" id="fullPayment">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align: center">SELL</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('sales/possell/1') ?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="clName">Client name:</label>
                            <select class="form-control" id="cNameFl" name="cName" readonly
                                    style="pointer-events: none">
                                <option value=""></option>
                                <?php if ($clients) {
                                    foreach ($clients as $client) {
                                        ?>
                                        <option value="<?php echo $client['id'] ?>"><?php echo $client['name'] . " " . $client['lname'] ?></option>
                                        <?php
                                    }
                                } ?>
                                ?>
                            </select>

                            <input type="text" id="ordDetails" name="ordDetails" class="form-control" hidden required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="amtPaid">Amount to be paid:</label>
                                <input type="number" name="amtPaid" id="amtPaid" class="form-control" readonly required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="clName">Total Billed:</label>
                                <input type="text" name="totAmt" id="totAmt" class="form-control"
                                       value="<?php echo $grandTot; ?>" readonly required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="clName">Previous Due:</label>
                                <input type="text" name="prevDue" id="amtDue" class="form-control" readonly
                                       style="color: red">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6" hidden>
                                <label for="amtPaid">Vat:</label>
                                <input type="text" name="vat" id="vat" class="form-control" readonly required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="clName">Discount:</label>
                                <input type="text" name="discount" readonly id="discount" class="form-control" required>
                            </div>
                            <div class="form-group col-sm-6" hidden>
                                <label for="clName">Received by:</label>
                                <input type="text" name="rBy" value="<?php echo $clNm; ?>" class="form-control">
                            </div>
                            <div class="form-group col-sm-6" hidden>
                                <label for="clName">Recepient phone:</label>
                                <input type="text" name="rPhone" value="<?php echo $clPhn; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clName">Payment Methods:</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="clName">MPESA: </label>
                                    <input type="radio" id="mpesa" name="pmtType" value="mpesa" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="clName">Cash:</label>
                                    <input type="radio" id="cash" name="pmtType" value="cash" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="clName">FAMILY BANK:</label>
                                    <input type="radio" id="cheque" name="pmtType" value="Family Bank" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <input type="text" id="mpsNumber" name="mpsNumber" class="form-control"
                                           placeholder="Mpesa number" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" id="tID" name="tID" class="form-control"
                                           placeholder="Transaction ID" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" id="chequeNo" name="chequeNo" class="form-control"
                                           placeholder="Transaction" disabled>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <input type="submit" value="CONFIRM SALE" class="btn btn-success btn-block">&nbsp;
                                <input type="submit" value="CONFIRM & PRINT"
                                       formaction="<?php echo base_url('sales/possellprint/1') ?>"
                                       class="btn btn-warning btn-block">
                            </div>
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="creditPayment">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align: center">SELL</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('sales/possell/2') ?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="clName">Client name:</label>
                            <select class="form-control" id="cNameCrL" name="cName" readonly
                                    style="pointer-events: none">
                                <option value=""></option>
                                <?php if ($clients) {
                                    foreach ($clients as $client) {
                                        ?>
                                        <option value="<?php echo $client['id'] ?>"><?php echo $client['name'] . " " . $client['lname'] ?></option>
                                        <?php
                                    }
                                } ?>
                                ?>
                            </select>
                            <input type="text" id="ordDetailsCr" name="ordDetails" class="form-control" hidden required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="amtPaid">Amount Paid:</label>
                                <input type="number" name="amtPaid" id="amtPaidCr" onkeyup="computeDueUpCr()"
                                       onkeydown="computeDueDownCr()" class="form-control" value="0" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="clName">Total Billed:</label>
                                <input type="text" name="totAmt" id="totAmtCr" class="form-control" readonly required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="clName">Previous Due:</label>
                                <input type="text" name="prevDue" id="prevDueCr" class="form-control" readonly
                                       style="color: red">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="clName">Total Due :</label>
                                <input type="text" name="amtDue" id="amtDueCr" class="form-control" readonly
                                       style="color: red">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6" hidden>
                                <label for="amtPaid">Vat:</label>
                                <input type="text" name="vat" id="vatCr" class="form-control" readonly required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="clName">Discount:</label>
                                <input type="text" name="discount" readonly id="discountCr" class="form-control"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clName">Payment Methods:</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="clName">NONE: </label>
                                    <input type="radio" id="noneCr" name="pmtType" value="none" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="clName">MPESA: </label>
                                    <input type="radio" id="mpesaCr" name="pmtType" value="mpesa" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="clName">Cash:</label>
                                    <input type="radio" id="cashCr" name="pmtType" value="cash" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="clName">FAMILY BANK:</label>
                                    <input type="radio" id="chequeCr" name="pmtType" value="Family Bank" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <input type="text" id="mpsNumberCr" name="mpsNumber" class="form-control"
                                           placeholder="Mpesa number" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" id="tIDCr" name="tID" class="form-control"
                                           placeholder="Transaction ID" disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" id="chequeNoCr" name="chequeNo" class="form-control"
                                           placeholder="Transaction" disabled>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <input type="submit" value="CONFIRM SALE" class="btn btn-success btn-block">
                                <input type="submit" value="CONFIRM & PRINT"
                                       formaction="<?php echo base_url('sales/possellprint/2') ?>"
                                       class="btn btn-warning btn-block">
                            </div>
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>
    <script>
        var allItems = [];
        $(document).ready(function () {
            $('#mainbody').fadeIn();
            $(document).on("wheel", "input[type=number]", function (e) {
                $(this).blur();
            });
            $("#granddiscount").bind('keyup input', function () {
                computediscount();
            });
            $('#btnCredit').hide();
        });

        $('#cName').on('change', function () {
            if ($(this).val() == "") {
                $('#btnCredit').hide();
                $('#btnNow').hide();
            }
            var is_walkin = $(this).find(':selected').data('string');
            if (is_walkin == 1) {
                $('#btnCredit').hide();
                $('#btnNow').show();
            } else if (is_walkin == 0) {
                $('#btnCredit').show();
                $('#btnNow').show();
            }
        });

        $("#searchbox").on("keyup", function () {
            var input = $(this).val().toUpperCase();

            $(".single-prod").each(function () {
                if ($(this).data("string").toUpperCase().indexOf(input) < 0) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            })
        });

        var client = $("#cName").val();
        var origDue;
        function readTable(id) {
            var client = $("#cName").val();

            $('#cNameFl').val(client);
            $('#cNameCrL').val(client);

            $("#ordDetails").val(JSON.stringify(allItems));
            $("#totAmt").val($("#grandTotal").text());
            $("#vatCr").val("0");
            $("#discountCr").val($("#granddiscount").val());

            $("#ordDetailsCr").val(JSON.stringify(allItems));
            $("#totAmtCr").val($("#grandTotal").text());
            $("#vat").val("0");
            $("#discount").val($("#granddiscount").val());
            clientDue(client, id);

        }
        $('#mpesa').click(function () {
            $('#mpsNumber').prop('disabled', false);
            // $('#mpsNumber').prop('required', true);
            // $('#tID').prop('required', true);
            $('#chequeNo').prop('required', false);
            $('#tID').prop('disabled', false);
            $('#chequeNo').prop('disabled', true);
        });

        $('#mpesaCr').click(function () {
            $('#mpsNumberCr').prop('disabled', false);
            // $('#mpsNumberCr').prop('required', true);
            // $('#tIDCr').prop('required', true);
            $('#chequeNoCr').prop('required', false);
            $('#tIDCr').prop('disabled', false);
            $('#chequeNoCr').prop('disabled', true);
        });

        $('#cheque').click(function () {
            $('#mpsNumber').prop('disabled', true);
            $('#tID').prop('disabled', true);
            $('#chequeNo').prop('disabled', false);

            $('#mpsNumber').prop('required', false);
            $('#tID').prop('required', false);
            // $('#chequeNo').prop('required', true);
        });
        $('#eqty').click(function () {
            $('#mpsNumber').prop('disabled', true);
            $('#tID').prop('disabled', true);
            $('#chequeNo').prop('disabled', false);

            $('#mpsNumber').prop('required', false);
            $('#tID').prop('required', false);
            // $('#chequeNo').prop('required', true);
        });

        $('#chequeCr').click(function () {
            $('#mpsNumberCr').prop('disabled', true);
            $('#tIDCr').prop('disabled', true);
            $('#chequeNoCr').prop('disabled', false);

            $('#mpsNumberCr').prop('required', false);
            $('#tIDCr').prop('required', false);
            // $('#chequeNoCr').prop('required', true);
        });

        $('#eqtyCr').click(function () {
            $('#mpsNumberCr').prop('disabled', true);
            $('#tIDCr').prop('disabled', true);
            $('#chequeNoCr').prop('disabled', false);

            $('#mpsNumberCr').prop('required', false);
            $('#tIDCr').prop('required', false);
            // $('#chequeNoCr').prop('required', true);
        });

        $('#cash').click(function () {
            $('#mpsNumber').prop('disabled', true);
            $('#tID').prop('disabled', true);
            $('#chequeNo').prop('disabled', true);

            $('#mpsNumber').prop('required', false);
            $('#tID').prop('required', false);
            $('#chequeNo').prop('required', false);
        });

        $('#cashCr').click(function () {
            $('#mpsNumberCr').prop('disabled', true);
            $('#tIDCr').prop('disabled', true);
            $('#chequeNoCr').prop('disabled', true);

            $('#mpsNumberCr').prop('required', false);
            $('#tIDCr').prop('required', false);
            $('#chequeNoCr').prop('required', false);
        });

        $('#noneCr').click(function () {
            $('#mpsNumberCr').prop('disabled', true);
            $('#tIDCr').prop('disabled', true);
            $('#chequeNoCr').prop('disabled', true);

            $('#mpsNumberCr').prop('required', false);
            $('#tIDCr').prop('required', false);
            $('#chequeNoCr').prop('required', false);
        });


        function computeDueUpCr() {
            var originalDue = getDue($('#cName').val());
            var amtPaid = $('#amtPaidCr').val();
            var remPay = amtPaid - $("#totAmtCr").val() + parseFloat($("#discountCr").val());

            var newAmtDue = originalDue - remPay;

            $('#amtDueCr').val(newAmtDue);

        }


        function computeDueDownCr() {
            var originalDue = getDue($('#cName').val());
            var amtPaid = $('#amtPaidCr').val();
            var remPay = amtPaid - $("#totAmtCr").val() + parseFloat($("#discountCr").val());

            var newAmtDue = originalDue - remPay;

            $('#amtDueCr').val(newAmtDue);

        }
        function clientDue(id, type) {

            if (type == '2') {
                clientDueCr(id);
            } else {
                $("#cName").val(id);
                $("#cNameCr").val(id);
                var allDues = '<?php echo json_encode($dueArr); ?>';
                var dueArr = JSON.parse(allDues);

                for (var i = 0; i < dueArr.length; i++) {
                    var oneDue = dueArr[i];
                    if (oneDue['client_id'] == id) {
                        origDue = oneDue['due']
                        $('#amtDue').val(oneDue['due']);
                        break;
                    } else {
                        $('#amtDue').val(0);
                    }
                }
                var tot = parseFloat($("#totAmt").val()) + parseFloat($("#amtDue").val()) - parseFloat($("#discount").val());
                $("#amtPaid").val(tot);

                $('#fullPayment').modal('show');
            }


        }

        function getDue(user) {
            var allDues = '<?php echo json_encode($dueArr); ?>';
            var dueArr = JSON.parse(allDues);

            for (var i = 0; i < dueArr.length; i++) {
                var oneDue = dueArr[i];
                if (oneDue['client_id'] == user) {
                    var thisDue = oneDue['due'];
                    break;
                } else {
                    var thisDue = 0;
                }
            }
            return thisDue;
        }

        function clientDueCr(id) {
            var allDues = '<?php echo json_encode($dueArr); ?>';
            var dueArr = JSON.parse(allDues);

            for (var i = 0; i < dueArr.length; i++) {
                var oneDue = dueArr[i];
                if (oneDue['client_id'] == id) {
                    origDue = oneDue['due'];
                    $('#prevDueCr').val(oneDue['due']);
                    var tot = parseFloat($("#totAmtCr").val()) + parseFloat($("#prevDueCr").val()) - $("#discountCr").val();
                    $('#amtDueCr').val(tot);
                    break;
                } else {
                    $('#amtDueCr').val($("#totAmtCr").val() - $("#discountCr").val());
                    $('#prevDueCr').val(0);
                }
            }

            $('#creditPayment').modal('show');


        }

        function addToCart(id) {
            var clicked = "#" + id;
            $(clicked).hide();
            //  console.log();

            var prodid = $(clicked).data("value");

            var prod = '<?php echo json_encode($products, true)?>';
            var prodArr = JSON.parse(prod);

            var result = $.grep(prodArr, function (e) {
                return e.id == prodid;
            });

            var thisprod = result[0];
            tot = thisprod['selling_price'];

            var oneItem = {
                'prodId': thisprod['id'],
                "prodName": thisprod['name'],
                "prodQty": 1,
                "prodCost": thisprod['selling_price'],
                "prodTax": 0,
                "prodTot": thisprod['selling_price'],
                "avQty": thisprod['qty']
            };
            // console.log(oneItem);
            allItems.push(oneItem);

            var html = "<div class='row' id='onerow' style='margin-top: 5px;'>";

            html += "<div class='col-sm-3'><input style='width: 100%' type='hidden' name='prodid[]' id='prodid_" + thisprod['id'] + "' class='form-control' required value='" + thisprod['id'] + "' readonly><input style='width: 100%' type='text' name='prodname[]' id='prodname_" + thisprod['id'] + "' class='form-control' required value='" + thisprod['name'] + "' readonly></div>";

            html += "<div class='col-sm-2'><input type='number' name='prodqty[]' id='prodqty_" + thisprod['id'] + "' data-value='" + thisprod['id'] + "' onkeyup='computetotal(this.id)'  class='form-control' required value='1'></div>";

            html += "<div class='col-sm-2'><input type='text' name='prodprice[]' class='form-control' required id='prodprice_" + thisprod['id'] + "' value='" + thisprod['selling_price'] + "' readonly></div>";

            html += "<div class='col-sm-2'><input type='text' name='prodtot[]' id='prodtot_" + thisprod['id'] + "'  class='form-control totalprice' required value='" + thisprod['selling_price'] + "' readonly></div>";

            html += "<div class='col-sm-1'><a class='btn btn-danger' id='removeRow'><span class='fa fa-trash'></span></a></div></div>";

            $("#prodrow").append(html);

            computegrandtot();
            computediscount();
        }

        $(document).on('click', '#removeRow', function () {
            $(this).closest('#onerow').remove();
            computegrandtot();
            computediscount();
        });

        function computetotaldisc(thisid) {

            var res = thisid.split("_");
            var id = res[1];
            var percinput = "#percdisc_" + id;
            var qtyinput = "#prodqty_" + id;
            var totinput = "#prodtot_" + id;
            var discinput = "#proddisc_" + id;
            var priceinput = "#prodprice_" + id;

            var prodquantity = $(qtyinput).val();
            if (prodquantity == "") {
                prodquantity = 0;
            }

            var proddisc = $(percinput).val();
            if (proddisc == "") {
                proddisc = 0;
            }

            discperc = 0;
            disc = 0;

            for (i = 0; i < allItems.length; i++) {
                var thisitem = allItems[i];
                if (thisitem['prodId'] == id) {
                    tot = prodquantity * thisitem['prodCost'];
                    disc = Math.round(tot * proddisc / 100)
                    $(discinput).val(disc);

                    var newItem = {
                        'prodId': thisitem['prodId'],
                        "prodName": thisitem['prodName'],
                        "prodQty": prodquantity,
                        "prodCost": thisitem['prodCost'],
                        "prodTax": 0,
                        "prodDisc": proddisc,
                        "prodTot": tot,
                        "prodDiscTot": disc,
                        "avQty": thisitem['avQty']
                    };
                    allItems.splice(i, 1);
                    allItems.push(newItem);
                }
            }

            var prodprice = $(priceinput).val();
            var totprice = prodprice * prodquantity;
            // var totdisc = prodprice * prodquantity /
            $(totinput).val(totprice);

            computegrandtot();
            computediscount();
        }

        function computetotal(thisid) {

            var res = thisid.split("_");
            var id = res[1];
            var qtyinput = "#prodqty_" + id;
            var totinput = "#prodtot_" + id;
            var discinput = "#proddisc_" + id;
            var priceinput = "#prodprice_" + id;

            var prodquantity = $(qtyinput).val();
            if (prodquantity == "") {
                prodquantity = 0;
            }

            discperc = 0;
            disc = 0;

            for (i = 0; i < allItems.length; i++) {
                var extra = 0;
                var thisitem = allItems[i];
                if (thisitem['prodId'] == id) {
                    if (parseInt(prodquantity) > parseInt(thisitem['avQty'])) {
                        prodquantity = thisitem['avQty'];
                        extra = 1;
                    }
                    tot = prodquantity * thisitem['prodCost'];
                    disc = Math.round(tot * thisitem['prodDisc'] / 100);
                    $(discinput).val(disc);

                    var newItem = {
                        'prodId': thisitem['prodId'],
                        "prodName": thisitem['prodName'],
                        "prodQty": prodquantity,
                        "prodCost": thisitem['prodCost'],
                        "prodTax": 0,
                        "prodDisc": thisitem['prodDisc'],
                        "prodTot": tot,
                        "prodDiscTot": disc,
                        "avQty": thisitem['avQty']
                    };
                    allItems.splice(i, 1);
                    allItems.push(newItem);
                    if (extra == 1) {
                        $(qtyinput).val(prodquantity);
                        var alertmsg = "You can't sell more than the remaining in stock!";
                        window.alert(alertmsg);
                        extra = 0;
                    }
                }
            }

            var prodprice = $(priceinput).val();
            var totprice = prodprice * prodquantity;
            // var totdisc = prodprice * prodquantity /
            $(totinput).val(totprice);

            computegrandtot();
            computediscount();
        }

        function computediscount() {
            grandisc = $("#granddiscount").val();

            var grandtot = $("#grandTotal").text();
            var tot = grandtot - grandisc;
            //   console.log(tot);
            $("#tot").text(tot);
        }

        function computegrandtot() {
            var grandtot = 0;
            $('.totalprice').each(function () {
                grandtot += parseFloat(this.value);
            });

            $("#grandTotal").text(grandtot);
        }

    </script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

