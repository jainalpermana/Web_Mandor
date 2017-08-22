<html>
<head>
	<title>Report Mandor - Hasil Pekerjaan</title>
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
	<script type="text/javascript">
		function getParameterByName(name, url) {
		    if (!url) url = window.location.href;
		    name = name.replace(/[\[\]]/g, "\\$&");
		    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		        results = regex.exec(url);
		    if (!results) return null;
		    if (!results[2]) return '';
		    return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		var lokasi = getParameterByName('lokasi');
		var tanggal = getParameterByName('tanggalpilih');
		var jam_mulai = getParameterByName('jammulai');
		//console.log(lokasi);
		//console.log(tanggal);
		//console.log(jam_mulai);

		database = firebase.database();

		var ref = database.ref("BNI/"+tanggal);
		ref.orderByChild("lokasi").equalTo(lokasi).on("child_added", function(snapshot) {
			//console.log(snapshot.key);

			var db = snapshot.key.split("-");
			var dtbase = db[1];
			//console.log(dtbase);

			if(dtbase == jam_mulai){
				//console.log(snapshot.key);
				var ref = database.ref('BNI/'+tanggal+'/'+snapshot.key);
				ref.once('value', gotData, errData);

				var daftar_laporan = database.ref('BNI/daftar_laporan/0');
				daftar_laporan.orderByChild("nama").on("child_added", function(data) {
					//console.log(data.val().nama);
					var nama_laporan = data.val().nama;
					$("#table_laporan").append("<b>"+nama_laporan+":</b> ");

					var hasil_laporan = database.ref('BNI/'+tanggal+'/'+snapshot.key+'/hasil_laporan/'+data.key);
					hasil_laporan.orderByValue().on("value", function(data) {
						//console.log(data.val());
					   	var hasil = data.val();
						$("#table_laporan").append(hasil+"<br>");
					});
				});

				var daftar_pekerjaan = database.ref('BNI/daftar_pekerjaan/0');
				daftar_pekerjaan.orderByChild("nama").on("child_added", function(data) {
					console.log(data.val());
					var hasil_pekerjaan = data.val();
					$("#table_pekerjaan").append("<b>"+hasil_pekerjaan+":</b> ");

					var hasil_kerja = database.ref('BNI/'+tanggal+'/'+snapshot.key+'/hasil_pekerjaan/'+data.key);
					hasil_kerja.orderByValue().on("value", function(data) {
						//console.log(data.val());
					   	var hasilKerja = data.val();
						$("#table_pekerjaan").append(hasilKerja+"<br>");
					});
				});

				function gotData(data) {
					//console.log(data.val());
					var data_laporan = data.val();
					console.log(data_laporan);
					nama = data_laporan.lokasi;

					document.getElementById("lokasi").innerHTML = nama;
				}

				function errData(err) {
				  	console.log(err);
				}
			}
		});
	</script>
</head>
<body>
	<div id="content">
		<center>
			<h2>HASIL PEKERJAAN</h2><hr /><br />
			<span id="lokasi" style="font-weight:bold;"></span><hr><br>
		</center>
		
		<u>Laporan</u><br><br>
		<table border="0" style="font-size:13px;">
			<tr>
				<td id="table_laporan"></td>
			</td>
		</table><br>
		<u>Pekerjaan</u><br><br>
		<table borer="0" style="font-size:13px;">
			<tr>
				<td id="table_pekerjaan"></td>
			</td>
		</table>
	</div>
</body>
</html>