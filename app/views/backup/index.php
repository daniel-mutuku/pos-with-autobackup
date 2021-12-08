<!DOCTYPE html>
<html lang="en">
<head>
	<title>Back up in Progress</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url();?>res/backup/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>res/backup/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background-image: url('images/bg01.jpg');">
		<div class="wsize1 bor1 bg1 p-t-175 p-b-45 p-l-15 p-r-15 respon1">
			<div class="wrappic1">
				<h1>Back up in Progress</h1>
			</div>

			<p class="txt-center m1-txt1 p-t-33 p-b-68">
				The application is uploading data, come back after 5 minutes. Upon completion, you will be notified via SMS.
			</p>
			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="<?= base_url();?>res/backup/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>res/backup/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url();?>res/backup/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>res/backup/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>res/backup/vendor/countdowntime/moment.min.js"></script>
	<script src="<?= base_url();?>res/backup/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="<?= base_url();?>res/backup/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="<?= base_url();?>res/backup/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>res/backup/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>res/backup/js/main.js"></script>

</body>
</html>