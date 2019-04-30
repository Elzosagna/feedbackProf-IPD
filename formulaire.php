<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="formulaire";

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

    <?php
    //mise a jour de l'etat des formulaires
    if (isset($_GET['activeForm']) && !empty($_GET['activeForm'])) {
      $activeForm=$_GET['activeForm'];
      //UPDATE `matiere` SET `etat_note` = '2' WHERE `matiere`.`id_matiere` = 4;
      $requete="UPDATE `matiere` SET `etat_note` = '2' WHERE `matiere`.`id_matiere` =:activeForm";
      $donnees=$bd->prepare($requete);
      $donnees->bindParam('activeForm',$activeForm);
      $donnees->execute();
    }
    if (isset($_GET['closeForm']) && !empty($_GET['closeForm'])) {
      $closeForm=$_GET['closeForm'];
      //UPDATE `matiere` SET `etat_note` = '2' WHERE `matiere`.`id_matiere` = 4;
      $requete="UPDATE `matiere` SET `etat_note` = '3' WHERE `matiere`.`id_matiere` =:closeForm";
      $donnees=$bd->prepare($requete);
      $donnees->bindParam('closeForm',$closeForm);
      $donnees->execute();
    }
    // requete pour savoir le nombre de formulaire (statistique des formulaire ativés,en cours et cloturés)
    /*
    etat des formaulaires
    si 1=non active (l'admin doit l'activer pour qu'il soit visible par les etudiant)
    si 2=Active (le formulaire est visible par les etudiants concernés)
    si 3=cloturé (le formulaire est cloturé on peut pas noter)
    */
            $requete="SELECT * FROM `matiere`";
            $donnees=$bd->prepare($requete);
            $donnees->execute();
            $totalFormulaire=0;
            $totalNonActive=0;
            $totalActive=0;
            $totalClose=0;
            while ($resultat=$donnees->fetchObject())
                {
                  $resultat->etat_note;
                  if ($resultat->etat_note==1) {
                    $totalNonActive++;
                  }
                  if ($resultat->etat_note==2) {
                    $totalActive++;
                  }
                  if ($resultat->etat_note==3) {
                    $totalClose++;
                  }

                  $totalFormulaire ++;

                }

              ?>
        <div class="content">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-3">
                    <div class="card">
                      <div class="header btn-light">
                      <h5 class="title"><strong>Nombre de Formulaires </strong><h1 style="color:black;"><?=$totalFormulaire?></h1></h5>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="header btn-info">
                      <h5 class="title dark"><strong>Formulaires Non Activés </strong><h1 style="color:black;"><?=$totalNonActive?></h1></h5>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="header btn-success">
                      <h5 class="title dark"><strong>Formulaires Activés </strong><h1 style="color:black;"><?=$totalActive?></h1></h5>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="header btn-danger">
                      <h5 class="title"><strong>Formulaires Cloturés </strong><h1 style="color:black;"><?=$totalClose?></h1></h5>
                    </div>
                    </div>
                  </div>
              </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Liste des Formulaires </h4>
                                <p class="category">Details</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Module</th>
                                      <th>Volume Horaire</th>
                                    	<th>Classe</th>
																			<th>Professeur</th>
                                      <th>Date</th>
                                      <th>Action</th>
                                    </thead>
                                    <tbody>
																					<?php

								                          $requete="SELECT * FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN professeur on matiere.id_prof=professeur.id_prof LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `matiere`.`etat_note` ASC";
																					$donnees=$bd->prepare($requete);
																					$donnees->execute();

																					while ($resultat=$donnees->fetchObject())
																					{
																								?>
																						<tr>
																							<td><?=$resultat->lib_matiere?></td>
																							<td><?=$resultat->v_horaire?></td>
																							<td><?=$resultat->lib_classe." ".$resultat->code_niveau?></td>
                                              <td><?=$resultat->prenom_prof." ".$resultat->nom_prof?></td>
                                              <td><?=$resultat->date_matiere?></td>
                                              <td><?php
                                              if ($resultat->etat_note==1) {
                                                ?><a type="button" class="btn btn-outline btn-info" href="formulaire.php?activeForm=<?=$resultat->id_matiere?>">
                                                    Activer&nbsp;&nbsp;<i class="pe-7s-switch"></i>
                                                </a>
                                                <?php
                                              }
                                              elseif ($resultat->etat_note==2) {
                                                ?><a type="button" class="btn btn-outline btn-success" href="formulaire.php?closeForm=<?=$resultat->id_matiere?>">
                                                    Desactiver&nbsp;&nbsp;<i class="pe-7s-close"></i>
                                                </a>
                                                <?php
                                              }
                                              else{
                                                ?><span class="btn btn-outline btn-danger disabled">Close&nbsp;&nbsp;&nbsp;&nbsp;<i class="pe-7s-lock"></i><span>
                                                <?php
                                              }
                                              ?>
                                            </td>

																						</tr>
																					<?php }
																				   ?>

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
