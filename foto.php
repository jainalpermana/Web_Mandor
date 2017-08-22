<html>
<head>
	<title>Report Mandor - Foto</title>
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

		function load(){
			var url_foto = getParameterByName('url');
			console.log(url_foto);

			//$("#foto").append("<img src='"+url_foto+"' width='350'>");
			document.getElementById("foto").src = url_foto;
			document.getElementById("x").value = url_foto;
		}
	</script>
</head>
<body onLoad="load()">
	<div id="content">
		<center>
			<img id="foto" src="" width="350">
			<input type="text" id="x">
		</center>
	</div>
</body>
</html>