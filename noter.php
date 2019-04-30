<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="noter";

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
    si 2=Active (ole formulaire est visible par les etudiants concernés)
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
                  <?php if (isset($_GET['success']) && !empty($_GET['success']) && $_GET['success']==1) {
                    ?><div class="col-md-12">


                              <div class="col-md-4"></div>
                              <div class="btn alert alert-success col-md-4">
                                <label>
                                <strong class="alert-link">Reussi!</strong> <span style="color:black">Les notes ont bien été enregistrées</span>
                                </label>
                              </div>


                        </div>
                    <?php
                  }
                   ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Liste des Formulaires Activés</h4>
                                <p class="category">Details</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>N°F</th>
                                    	<th>Module</th>
                                      <th>Volume Horaire</th>
                                    	<th>Classe</th>
																			<th>Professeur</th>
                                      <th>Date</th>
                                      <th>Action</th>
                                    </thead>
                                    <tbody>
																					<?php
                                          $id_user=$_SESSION['id_user'];
                                          $id_classe=$_SESSION['classe_etudiant'];
//SELECT * FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN professeur on matiere.id_prof=professeur.id_prof LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau LEFT JOIN question ON question.id_matiere=matiere.id_matiere WHERE matiere.etat_note=2 AND question.id_user=3

  $requete="SELECT matiere.id_matiere, matiere.v_horaire, matiere.lib_matiere, Filiere.code_classe, professeur.nom_prof, professeur.prenom_prof, matiere.date_matiere, niveau.code_niveau, question.id_user";
  $requete.=" FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN professeur on matiere.id_prof=professeur.id_prof";
  $requete.=" LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau LEFT JOIN question ON question.id_user=:id_user && question.id_matiere=matiere.id_matiere";
  $requete.=" WHERE matiere.id_classe=:id_classe && matiere.etat_note=2";
																					$donnees=$bd->prepare($requete);
                                          $donnees->bindParam('id_user',$id_user);
                                          $donnees->bindParam('id_classe',$id_classe);

																					$donnees->execute();

																					while ($resultat=$donnees->fetchObject())
																					{
                                            $id_matiere=$resultat->id_matiere;
                                            $requete2="SELECT * FROM question where id_user=:id_user AND id_matiere=:id_matiere";
                                          		  $donnees2=$bd->prepare($requete2);
                                                $donnees2->bindParam('id_user',$id_user);
                                                $donnees2->bindParam('id_matiere',$id_matiere);
                                          		  $donnees2->execute();
                                                $resultat2=$donnees2->fetchObject();
                                                if ($resultat2==false) {
                                                  ?>
                                                  <tr>
      																							<td><?=$resultat->id_matiere?></td>
      																							<td><?=$resultat->lib_matiere?></td>
      																							<td><?=$resultat->v_horaire?></td>
      																							<td><?=$resultat->code_classe." ".$resultat->code_niveau?></td>
                                                    <td><?=$resultat->prenom_prof." ".$resultat->nom_prof?></td>
                                                    <td><?=$resultat->date_matiere?></td>
                                                    <td><a type="button" class="btn btn-outline btn-info" href="formulaireNote.php?noteForm=<?=$resultat->id_matiere?>">
                                                        Noter&nbsp;&nbsp;<i class="pe-7s-note"></i></a></td>
      																						</tr>
                                                  <?php
                                                }
																								?>

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
