<?php include "read.php"; ?>
<?php include "settings.php"; ?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Temperature Alarms</title>
</head>
<body>
    <!-- Header -->
    <div class="jumbotron jumbotron-fluid bg-light" style="margin-bottom: 0px; padding-bottom: 5px;">
        <h5 style="display: inline; float: right; padding-right: 15px;"><i class="fas fa-cog" data-toggle="modal" data-target="#settingsModal"></i></h5>
        <h1 style="text-align: center; margin-bottom: 0px;">Temperature Alarms</h1>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light bg-light" style="margin-top: 0px;">
    <div class="d-flex w-50 order-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse justify-content-center order-2" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link all" href="#">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link admin" href="#">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cps" href="#">CPS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ces" href="#">CES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link oes" href="#">OES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sgc" href="#">SGC</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cjh" href="#">CJH</a>
            </li>
            <li class="nav-item">
                <a class="nav-link chs" href="#">CHS</a>
            </li>
        </ul>
    </div>
    <span class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last"></span>
    </nav>
    
    <!-- Content -->
    <div class="container">
        <?php echo tempmod(); ?>
    </div>
    
    <!-- Footer -->
    <div class="footer bg-light" style="bottom: 0; width: 100%; text-align: center; margin-top: 10px;">
      <p>2018 &copy;</p>
    </div>
    
    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="label" style="text-align: center;">Settings</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <?php echo displayAlarms(); ?>
              <br>
              <hr>
              <br>
              <?php echo displayDevices(); ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Add Device Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="label" style="text-align: center;">Add Device</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <?php echo renderForm(); ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Add Alarm Modal -->
    <div class="modal fade" id="alarmModal" tabindex="-1" role="dialog" aria-labelledby="alarmModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="label" style="text-align: center;">Add Alarm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <?php echo renderAlarmForm(); ?>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Menu Script -->
    <script>
        $(document).ready(function(){
            $(".all").click(function(){
                $(".CS701").show();
                $(".CS041").show();
                $(".CS101").show();
                $(".CS103").show();
                $(".CS104").show();
                $(".CS043").show();
                $(".CS001").show();
            });
            $(".admin").click(function(){
                $(".CS701").show();
                $(".CS041").hide();
                $(".CS101").hide();
                $(".CS103").hide();
                $(".CS104").hide();
                $(".CS043").hide();
                $(".CS001").hide();
            });
            $(".cps").click(function(){
                $(".CS701").hide();
                $(".CS041").hide();
                $(".CS101").hide();
                $(".CS103").show();
                $(".CS104").hide();
                $(".CS043").hide();
                $(".CS001").hide();
            });
            $(".ces").click(function(){
                $(".CS701").hide();
                $(".CS041").hide();
                $(".CS101").show();
                $(".CS103").hide();
                $(".CS104").hide();
                $(".CS043").hide();
                $(".CS001").hide();
            });
            $(".oes").click(function(){
                $(".CS701").hide();
                $(".CS041").hide();
                $(".CS101").hide();
                $(".CS103").hide();
                $(".CS104").show();
                $(".CS043").hide();
                $(".CS001").hide();
            });
            $(".sgc").click(function(){
                $(".CS701").hide();
                $(".CS041").hide();
                $(".CS101").hide();
                $(".CS103").hide();
                $(".CS104").hide();
                $(".CS043").show();
                $(".CS001").hide();
            });
            $(".cjh").click(function(){
                $(".CS701").hide();
                $(".CS041").show();
                $(".CS101").hide();
                $(".CS103").hide();
                $(".CS104").hide();
                $(".CS043").hide();
                $(".CS001").hide();
            });
            $(".chs").click(function(){
                $(".CS701").hide();
                $(".CS041").hide();
                $(".CS101").hide();
                $(".CS103").hide();
                $(".CS104").hide();
                $(".CS043").hide();
                $(".CS001").show();
            });
        });
    </script>
</body>