<?php
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");
  $sql = mysqli_query($connection, "SELECT * FROM kebun");
  $data = mysqli_fetch_array($sql);

  $relay = $data['relay'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dhauralink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
  <div class="page">
    <!-- sidebar -->
    <div class="sidebar sidebar-nav">
      <div class="sidebar-header">
        <div class="sidebar-logo-wrapper">
          <div class="logo-wrapper">
            <a href="#" class="navbar-brand text-uppercase fw-light">
              <span>DHAURA</span>LINK
            </a>
          </div>
        </div>
      </div>
    
      <div class="sidebar-body">
        <ul class="nav-list">
          <li class="nav-list-items">
            <a class="dashboard" href="#">
              <i class="fa-solid fa-table-columns me-2"></i>Dashboard
            </a>
          </li>
          <li class="nav-list-items">
            <a class="navigation-link" href="#">
              <i class="fa-solid fa-house-signal me-2"></i>Rumah
            </a>
          </li>
          <li class="nav-list-items">
            <a class="navigation-link" href="#">
              <i class="fa-solid fa-leaf me-2"></i>Kebun
            </a>
          </li>
          <li class="nav-list-items">
            <a class="navigation-link" href="#">
              <i class="fa-solid fa-warehouse me-2"></i>Garasi
            </a>
          </li>
        </ul>
        <hr style="margin-top: 30px;color: white;">
      </div>
    </div>
    <!-- end of sidebar -->


    <div class="content">
      <div class="navigationBar">
        <button id="sidebarToggle" class="btn sidebarToggle">
          <i class="fa-solid fa-bars-staggered"></i>
        </button>
      </div>
      <main id="main" class="mt-1 pt-3 main-content">
      <div class="container-fluid">
        <div class="row mt-5 m-3">
          <div class="col-md-4 mb-3">
            <div class="card bg-white text-dark h-100">
              <div class="card-body p-5 mx-auto">
                <h1><i class="icon fa-solid fa-temperature-half me-1" style="font-size: 40px;color: #d6d538;"></i><span id="suhu"> 0</span>*C</h1>
              </div>
              <div class="card-footer d-flex text-white" style="background-color: rgb(83,186,142);">
                Temperature
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card bg-white text-dark h-100">
              <div class="card-body p-5 mx-auto">
                <h1><i class="fa-solid fa-water me-1" style="font-size: 40px;color: #288fde;"></i><span id="kelembaban"> 0 </span> %</h1>
              </div>
              <div class="card-footer d-flex text-white" style="background-color: rgb(83,186,142);">
                Humidity
              </div>
            </div>
          </div>
        </div>

        <!-- Untuk grafik temperature -->
        <div class="row m-3">
          <div class="col-md-8">
            <div class="card text-dark h-100 text-center" id="responsecontainer">
              
            </div>
          </div>
        </div>
        <!-- closing grafik temperature -->

        <div class="row m-3">
          <div class="col-md-4 mb-3">
            <div class="card text-dark h-100">
              <div class="card-body py-5">
                <!-- switch -->
                <div class="form-check form-switch" style="font-size: 40px">
                  <input type="checkbox" class="form-check-input" id="flexSwitchCheckDefault" role="switch" onchange="ubahstatus(this.checked)" <?php if($relay == 1) echo "checked"; ?> >
                  <label for="flexSwitchCheckDefault" class="form-check-label">
                    <h1 id="status"> <?php if($relay == 1) echo "ON"; else echo "OFF"; ?></h1>
                  </label>
                </div>
                <!-- akhir switch -->
                <!-- <h1><span id="kondisi">OFF</span></h1> -->
              </div>
              <div class="card-footer d-flex">
                Water Pump
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card text-dark h-100">
              <div class="card-body py-5 mx-auto">
                <h1><i class="fa-solid fa-seedling me-1" style="color: #34eb77;"></i><span id="soil"> 0 </span> %</h1>
              </div>
              <div class="card-footer d-flex text-white" style="background-color: rgb(83,186,142);">
                Soil Moisture
              </div>
            </div>
          </div>
        </div> 
      </div>
    </main>
    </div>
  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5b1466e197.js" crossorigin="anonymous"></script>
    <script src="js/JS.js"></script>
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="multisensor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function() {
        setInterval( function() {
          $("#suhu").load("suhu.php"); // ganti value yang ada pada id=suhu dengan file suhu.php
          $("#kelembaban").load("kelembaban.php"); // ganti value yang ada pada id=suhu dengan file kelembaban.php
          $("#soil").load("soil.php"); // ganti value yang ada pada id=suhu dengan file soil.php
        }, 2000);
      });

      var refreshid = setInterval(function(){
        $('#responsecontainer').load('data.php');
      }, 2000); 

      // untuk fungsi saklar relay
      function ubahstatus (status) {
        if (status == true) {
          status = "ON";
        } else {
          status = "OFF";
        }
        document.getElementById("status").innerHTML = status;
      }

      // ajax untuk merubah nilai relay ON / OFF
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
          // ambil respon dari web
          document.getElementById("status").innerHTML = xmlhttp.responseText;
        }
      }

      // eksekusi file PHP untuk merubah nilai di database
      xmlhttp.open("GET", "relay.php?stat=" + status, true);

      // kirim data
      xmlhttp.send();

      var myModal = document.getElementById('myModal')
      var myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
      })
    </script>
  </body>
</html>