<?php
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");
  // membaca ID terakhir
  $sql_ID = mysqli_query($connection, "SELECT MAX(ID) FROM kebun");

  $data_ID = mysqli_fetch_array($sql_ID);

  $ID_akhir = $data_ID['MAX(ID)'];
  $ID_awal = $ID_akhir - 4;

  // Memanggil variabel pembacaan suhu dan kelembaban
  $tanggal = mysqli_query($connection, "SELECT tanggal FROM kebun WHERE ID>='$ID_awal' AND ID<='$ID_akhir' ORDER BY ID ASC");

  $suhu = mysqli_query($connection, "SELECT temperatur FROM kebun WHERE ID>='$ID_awal' AND ID<='$ID_akhir' ORDER BY ID ASC");

  $kelembaban = mysqli_query($connection, "SELECT humidity FROM kebun WHERE ID>='$ID_awal' AND ID<='$ID_akhir' ORDER BY ID ASC");

  
  
?>

<!-- TAMPILAN GRAFIK -->
<div class="card card-primary">
  <div class="card-heading text-white py-2" style="background-color: rgb(83,186,142);letter-spacing: 1px;">
    Grafik Sensor DHT22
  </div>

  <div class="card-body">
    <!-- CANVAS UNTUK GRAFIS -->
    <canvas id="myChart"></canvas>

    <!-- GAMBAR GRAFIK -->
    <script type="text/javascript">
      // BACA ID CANVAS
      var canvas = document.getElementById("myChart");
      // SIAPKAN DATA UNTUK GRAFIK
      var data = {
        labels : [
          <?php
            while ($data_tanggal = mysqli_fetch_array($tanggal))
            {
              echo '"'.$data_tanggal['tanggal'].'",';
            }  
          ?>
        ], 
        datasets : [
        {
          label : "Suhu",
          fill : true,
          backgroundColor : "rgba(83, 186, 142, 0.6)",
          borderColor : "rgba(83, 186, 142, .3)",
          lineTension : 0.5,
          pointRadius : 4, 
          data : [
            <?php
              while ($data_suhu = mysqli_fetch_array($suhu))
              {
                echo $data_suhu['temperatur'].',';
              }  
            ?>
          ]
        },
        {
          label : "Kelembaban",
          fill : true,
          backgroundColor : "rgba(40, 143, 222, 0.3)",
          borderColor : "rgba(40, 143, 222, .3)",
          lineTension : 0.5,
          pointRadius : 4, 
          data : [
            <?php
              while ($data_kelembaban = mysqli_fetch_array($kelembaban))
              {
                echo $data_kelembaban['humidity'].',';
              }  
            ?>
          ]
        }
        ]
      };

      // OPTION GRAFIK
      var option = {
        showLines : true,
        animation : {duration : 0}
      };

      // CETAK KE DALAM CANVAS
      var myLineChart = Chart.Line(canvas, {
        data : data,
        options : option
      });
    </script>
  </div>
</div>