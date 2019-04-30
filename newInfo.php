<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="moduleProf";
 ?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>IPD</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <?php include('sidebar.php') ?>
    <div class="main-panel">
		<?php include('navbar.php')?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="header">
                          <h4 class="title">Nouvelle Information</h4>
                          <p class="category">Ajouter un nouveau Info</p><br>
                          <form method="post" action="action.php">
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <input type="hidden" name="action" value="newInfo">
                                <label>Titre </label>
                                <input type="text" class="form-control" placeholder="Titre de l'info" name="titre_info" required>
                                <br>
                                <label>Details</label>
                                <textarea name="detail_info" class="form-control" rows="8" cols="80"></textarea>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Poster</button>
                          </form>
                          <br><br>
                      </div>
                    </div>

                  </div>

                </div>
            </div>
        </div>

        <?php include('footer.php') ?>


    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>



</html>
