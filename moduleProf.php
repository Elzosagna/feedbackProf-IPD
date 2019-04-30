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
		<?php include('navbar.php') ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Mes Modules </h4>
                                <p class="category">Liste des modules</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Nom Module</th>
                                    	<th>Classe</th>
                                      <th>Voloume horaire</th>
                                      <th>Date</th>
                                    </thead>
                                    <tbody>
																					<?php

																						//var_dump($selectEtudiant);
																						// code...
                                            $id_prof=$_SESSION['id_prof'];
								$requete="SELECT * FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN niveau ON Filiere.id_niveau=niveau.id_niveau WHERE matiere.id_prof=:id_prof";
																					$donnees=$bd->prepare($requete);
                                          $donnees->bindParam('id_prof',$id_prof);
																					$donnees->execute();
                                          $total=0;
																					while ($resultat=$donnees->fetchObject())
																					{
																								?>
																						<tr>
                                              <td><?=$resultat->lib_matiere?></td>
                                              <td><?=$resultat->code_classe." ( ".$resultat->code_niveau." )"?></td>
                                              <td><?=$resultat->v_horaire?></td>
                                              <td><?=$resultat->date_matiere?></td>
																						</tr>
																					<?php
                                          $total++;
                                        }
																					 ?>
                                          <tr>
                                            <td colspan="5"><h3>Total <?=$total?><h3></td>
                                          </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">



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
