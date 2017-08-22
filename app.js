var now = new Date();
var today = now.toISOString().slice(0,10).replace(/-/g,"");
console.log(today);

report(today);

$(document).ready(function(){
    function tgl(){
      var tanggal_pilih = document.getElementById("tanggal").value;
      console.log(tanggal_pilih);

      var date = tanggal_pilih.split("-");
      var tgl_pilih = date[0]+date[1]+date[2];
      console.log(tgl_pilih);

      report(tgl_pilih);
    }
    $("#tanggal").on("change", tgl);
});

function report(tanggalPilih) {
  database = firebase.database();

  var ref = database.ref('BNI/'+tanggalPilih);
  ref.once('value', gotData, errData);

  function gotData(data) {
    //console.log(data.val());
    var raw_data = data.val();
    console.log("Raw Data");
    console.log(raw_data);
    var list_id_laporan = Object.keys(raw_data);
    console.log("List ID Laporan");
    console.log(list_id_laporan);
    for(i = 0; i < list_id_laporan.length; i++){
      var id_laporan = list_id_laporan[i];
      console.log("ID Laporan "+i);
      console.log(id_laporan);
      var ref = database.ref('BNI/'+tanggalPilih+'/'+id_laporan);
      ref.once('value', olahData, errData);
    }
    $("#table_body").empty();
  }

  function olahData(data) {
    var data_laporan = data.val();
    console.log(data_laporan);
    nama = data_laporan.lokasi;
    tanggal = data_laporan.tanggal;
    jam_mulai = data_laporan.jam_mulai;
    foto_sebelum = data_laporan.foto_sebelum;
    jam_selesai = data_laporan.jam_selesai;
    foto_sesudah = data_laporan.foto_sesudah;
    petugas = data_laporan.petugas;

    console.log(nama);

    $("#table_body").append("<tr><td>"+nama+"</td><td align='right'>"+tanggal+"</td><td align='right'>"+jam_mulai+"</td><td align='center'><img src='"+foto_sebelum+"' class='style_prevu_kit'></td><td align='right'>"+jam_selesai+"</td><td align='center'><img src='"+foto_sesudah+"' class='style_prevu_kit'></td><td>"+petugas+"</td><td align='center'><input type='button' value='Hasil Pekerjaan' onClick=\"detail('"+nama+"','"+tanggalPilih+"','"+jam_mulai+"')\"></td></tr>");
  }

  function errData(err) {
      console.log(err);
  }
}

function foto(foto) {
  //console.log(foto);

  var left = (screen.width/2)-(800/2);
  var top = (screen.height/2)-(500/2);
  return window.open('foto.php?url='+foto+'', 'print_popup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=800, height=500, top='+top+', left='+left);
}

function detail(nama, tanggalPilih, jamMulai) {
  //console.log(nama);
  //console.log(tanggalPilih);

  var jam = jamMulai.split(":");
  var jam_mulai = jam[0]+jam[1]+jam[2];
  //console.log(jam_mulai);

  var left = (screen.width/2)-(800/2);
  var top = (screen.height/2)-(500/2);
  return window.open('hasil_pekerjaan.php?lokasi='+nama+'&tanggalpilih='+tanggalPilih+'&jammulai='+jam_mulai+'', 'print_popup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=800, height=500, top='+top+', left='+left);
}