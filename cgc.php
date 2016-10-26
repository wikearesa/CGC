<!DOCTYPE html>
<html lang="en">
<head>
  <title>CGC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("form").submit(function(e){
        e.preventDefault();
        
        if ($("input[name=cif]").val()==='') {
          alert("Silakan masukkan CIF Anda !");
          return false;
        }
        if ($("#produk option:selected").text()===''){
          alert("Silakan Pilih produk !");
          return false;
        }

        $("#btnsubmit").hide();
        $("#LoadingImage").show();

        $.ajax({
          url: "output_cgc.php",
          dataType: "JSON",
          type: "POST",
          data: {
            cif: $("input[name=cif]").val(),
            //produk: $("select[name=produk]").val()
            produk: $("#produk option:selected").text()
            },
          success: function(response) {
            $("input[name=cif]").val('');
            $("#produk")[0].selectedIndex = -1;
            $("#btnsubmit").show();
            $("#LoadingImage").hide();
            for (var i=0; i<response.length; i++) {
              var tr_data = "<br><strong>Tgl_Kredit:</strong>"+
                response[i].TGL_KREDIT + "<br><strong>Berat Emas:</strong>" +
                response[i].GRAM + "<br><strong>Uang Pinjaman:</strong>" +
                response[i].UP + "<br><strong>Jumlah Angsuran:</strong>" +
                response[i].ANGSURAN_POKOK + "<br><strong>Tgl Jatuh Tempo:</strong>" +
                response[i].TGL_JATUH_TEMPO + "<br>";
              //$("#dataTable").empty().append(tr_data);
              $("#dataTable").html("");
              $("#dataTable").html(tr_data);
            }
          },
            error:function(xhr, ajaxOptions, thrownError){
              $("#btnsubmit").show();
              $("#LoadingImage").hide();
              alert(thrownError);
            }    
        });
        return false;
      });
    });

  </script>

</head>
<body>

<div class="container">
  <h2></h2>
  
  <form class="form-horizontal" method="POST" action="">
  <div class="form-group">
  <div id="formResponse" class="col-sm-offset-1 col-sm-4"></div>
  </div>
    <div class="form-group">
      <label for="usr" class="control-label col-sm-1">CIF:</label>
      <div class="col-sm-4">
      <input type="text" class="form-control" id="cif" value="" name="cif">
      </div>
    </div>
    <div class="form-group">
      <label for="produk" class="control-label col-sm-1">Produk:</label>
      <div class="col-sm-4">
      <select class="form-control" id="produk" name="produk">
        <option></option>
        <option>KCA</option>
        <option>RAHN</option>
        <option>KRASIDA</option>
        <option>KREASI</option>
        <option>ARRUM</option>
        <option>AMANAH</option>
        <option>ARRUM HAJI</option>
        <option>MULIA</option>
        <option>EMASKU</option>
        <option>TABUNGAN EMAS</option>
        <option>UANG KELEBIHAN LELANG</option>
      </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-1 col-sm-4">
        <button type="submit" id="btnsubmit" class="btn btn-default">Submit</button>
        <img src="hourglass.gif" id="LoadingImage" style="display:none" />
      </div>
    </div>
    <div class="form-group">
      <div id="dataTable">
        <!-- data hasil pencarian -->
      </div>
    </div>
  </form>
 
</div>

</body>
</html>

