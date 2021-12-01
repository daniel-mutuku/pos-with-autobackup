<?php //echo $total;die;?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Invoice</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 12px;
            background-color: #fff;
        }

        #products {
            width: 100%;
        }

        #products tr td {
            font-size: 12px;
        }

        #printbox {
            width: 280px;
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
    </style>
</head>
<body  dir="<?= LTR ?>">

<div id='printbox'>
   <h2 style="margin-top:0" class="text-center">Gardens Medical Care<br><b style="font-size: 10px;">Gardens Arcade,Kikuru(1<sup>st</sup> floor)</b>
        <br><b style="font-size: 10px;">TEL: 0100-000008/ 0100-000009<br>Email: info@gardensmedicare.co.ke</b></h2>

    <table class="inv_info">
        <tr>
            <td>Client:</td>
            <td><?php echo $pmts['name']; ?> <?php echo $pmts['lname']; ?></td>
        </tr>
        <tr>
            <td>Receipt no:</td>
            <td>#<?php echo str_pad( $pmts['id'], 4, "0", STR_PAD_LEFT ); ?></td>
        </tr>
        <tr>
            <td>Receipt Date: </td>
            <td><?php echo date('d/m/Y H:s', strtotime($pmts['created_at']))?><br></td>
        </tr>
    </table>
    <hr>
    <table id="products" >
        <tr class="product_row">
            <td colspan="2"><b> Mode</b></td>
            <td><b>Amount&nbsp;</b></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
        <?php
        $this->pheight = 0;

        $this->pheight = $this->pheight + 8;
        echo '<tr>
            <td colspan="2"><b>' . $pmts['mode'] . '</b></td>
             <td><b> Ksh ' . $pmts['amount']. '</b></td>
            
        </tr>';
        ?>
    </table>
    <hr>
   
    <table class="inv_info">
        <tr>
            <td><b>Total</b></td>
            <td><b>Ksh. <?php echo $pmts['amount'] ?></b></td>
        </tr>
        

    </table>
    <hr>
    <table>

        <tr>
            <td colspan="3">
                &nbsp;
            </td>
        </tr>

        <tr>
            <td>Served by: </td>
            <td><?php echo $this->session->userdata('user_aob')->name;?></td>
        </tr>
    </table>
    <hr>
    <div class="text-center">  ** Powered by: fortsortinnovations.co.ke **</div>


</div>
</body>
</html>
