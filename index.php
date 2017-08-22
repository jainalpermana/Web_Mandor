<html>
<head>
	<title>Report Mandor</title>
	<link href="style.css" rel="stylesheet" type="text/css">

	<script src="http://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
	<script>
	  // Initialize Firebase
	  var config = {
	    apiKey: "AIzaSyD1u6ADjTGsfn8biYVZ9myMYKCUhBccLXo",
	    authDomain: "mandor-1b6f7.firebaseapp.com",
	    databaseURL: "https://mandor-1b6f7.firebaseio.com",
	    projectId: "mandor-1b6f7",
	    storageBucket: "mandor-1b6f7.appspot.com",
	    messagingSenderId: "532187045860"
	  };
	  firebase.initializeApp(config);
	</script>

	<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="app.js"></script>
</head>
<body>
	<div id="content">
		<center>
			<h2>REPORT</h2><hr /><br />
			<table style="font-size:13px;">
				<tr>
		          	<td>Tanggal <input class="input" id="tanggal" type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" style="height:30px;" onChange="tgl()"></td>
				</tr>
			</table>
			<br>
			<table class="datatable" style="font-size:13px;">
				<thead>
					<tr>
						<th>LOKASI</th><th>TANGGAL</th><th>JAM MULAI</th><th>FOTO SEBELUM</th><th>JAM SELESAI</th><th>FOTO SESUDAH</th><th>PETUGAS</th><th>PEKERJAAN</th>
					</tr>
				</thead>
				<tbody id="table_body">
				</tbody>
			</table>
		</center>
	</div>
	<div id="footer" style="cursor:default;">&copy; 2017 | NEWTRONIC SOLUTION</div>
</body>
</html>