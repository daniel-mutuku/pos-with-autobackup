<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Receipt</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 12px;
            background-color: #fff;
        }

        #products {
            width: 100%;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        #products tr td {
            font-size: 12px;
        }

        #printbox {
            width: 2480px;
            margin: 5pt;
            padding: 5px;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 10pt;
        }

        .product_row {
            margin: 15pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color
        }

        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .bordered-cell{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body dir="<?= LTR ?>">

<div id='printbox'>
    <table style=" border-collapse: collapse;">
        <tr>
            <td colspan="9" style="text-align: center; text-decoration: underline;color: #42057B; font-weight: bold;font-size: 18px;">RECEIPT</td>
        </tr>
        <tr>
            <td><img src="<?php echo base_url();?>res/assets/images/logo.jpeg" style="height: 100px;"></td>
            <td style="padding-left: 20px;"></td>
            <td><h2 style="margin-top:0;font-size: 20px;color: #535354;" class="text-left"><span style="color: #043161;">Fort Sort Innovations Ltd</span><br><b style="font-size: 12px;">P.O BOX 24779 Nairobi Kenya<br>Mageso Chambers, Moi Avenue<br>Nairobi, Kenya.</b>
                        <br><b style="font-size: 12px;">Website: fortsortinnovations.co.ke<br>Email: info@fortsortinnovations.co.ke</b></h2></td>
            <td colspan="3" style="color: white; padding-left: 180px;"></td>
            <td style="background-color: #7B0510;padding-left: 5px;"></td>
            <td style="background-color: #055797;padding-left: 5px;"></td>
            <td style="background-color: #42057B;padding-left: 5px;"></td>
        </tr>
    </table>
    <hr>

    <table class="inv_info" style="border-collapse: collapse;">
        <tr class="product_row">
            <td style="width: 40%;"><b>Paid By: </b><br>
                <?php echo $invoice['name'];?><br>
                <?php echo $invoice['address'];?><br>
                Email: <?php echo $invoice['email'];?><br>
                Tel: <?php echo $invoice['contact'];?>
            </td>
            <td style="border: 1px solid #000000;"><b>Prep Date</b><br><?php echo date('d-m-Y',strtotime($invoice['created_at']));?></td>
            <td style="border: 1px solid #000000;"><b>Company VAT Reg </b><br>P05183920K</td>
            <td style="border: 1px solid #000000;"><b>Tax Date</b></td>
            <td style="border: 1px solid #000000;"><b>Invoice No</b><br><?php echo str_pad( $invoice['id'], 4, "0", STR_PAD_LEFT );?></td>
            
        </tr>
        
    </table>
    <table class="inv_info" style="margin-top: 10px;width: 100%; border-collapse: collapse;">
        <tr class="product_row">
            <td style="border: 1px solid #000000;"><b>PO No</b><br> Verbal</td>
            <td style="border: 1px solid #000000;"><b>Terms</b><br>On Delivery</td>
            <td style="border: 1px solid #000000;"><b>Currency</b><BR>Shillings</td>
            <td style="border: 1px solid #000000;"><b>Date Submitted</b><br><?php echo date('d-m-Y',strtotime($invoice['submitted']));?></td>
            <td style="border: 1px solid #000000;"><b>Contract Name</b><br><?php echo $invoice['contract'];?></td>
            <td style="border: 1px solid #000000;"><b>Project</b><br><?php echo $invoice['project'];?></td>
            
        </tr>
        
    </table>
    
    <table id="products" style="border-collapse: collapse;">
        <tr class="product_row" style="background-color: #D6D4D7;">
            <td class="bordered-cell" style="color: #000000;width: 5%;"><b>NO</b></td>
            <td class="bordered-cell" style="color: #000000;"><b>AMOUNT</b></td>
            <td class="bordered-cell" style="color: #000000;"><b>MODE</b></td>
            <td class="bordered-cell" style="color: #000000;"><b>DATE</b></td>
        </tr>
        <?php $id = 0;$grandtot = 0; foreach($invoice_pmts as $one){ $grandtot += $one['amount'];$id++;?>
            <tr class="product_row">
                <td class="bordered-cell"><?php echo $id;?></td>
                <td class="bordered-cell"><?php echo number_format($one['amount'], 2, '.', ',');?></td>
                <td class="bordered-cell"><?php echo $one['mode'];?></td>
                <td class="bordered-cell"><?php echo date('d-m-Y',strtotime($one['created_at']));?></td>
            </tr>
                                                
        <?php } ?>

       
        
        <tr class="product_row">
            <td class="bordered-cell"></td>
            <td class="bordered-cell"></td>
            <td class="bordered-cell"><b>TOTAL</b></td>
            <td class="bordered-cell"><b><?php echo number_format($invoice['total'], 2, '.', ',');?></b></td>
        </tr>
        <tr class="product_row">
            <td class="bordered-cell"></td>
            <td class="bordered-cell"></td>
            <td class="bordered-cell"><b>PAID</b></td>
            <td class="bordered-cell"><b><?php echo number_format($grandtot, 2, '.', ',');?></b></td>
        </tr>
        <tr class="product_row">
            <td class="bordered-cell"></td>
            <td class="bordered-cell"></td>
            <td class="bordered-cell"><b>BALANCE</b></td>
            <td class="bordered-cell"><b><?php echo number_format($invoice['total']-$grandtot, 2, '.', ',');?></b></td>
        </tr>
        
        <tr class="product_row">
            <td class="bordered-cell" colspan="4" style="text-align: center;border-bottom: 0px;"><b>Bank A/C Name: Fort Sort Innovations Ltd.</b></td>
        </tr>
        <tr class="product_row" style="border-top: 0px;">
            <td class="bordered-cell" colspan="4" style="text-align: center; border-top: 0px;"><b>Thank you for your business.</b></td>

        </tr>
        
    </table>
    
</div>
</body>
</html>
