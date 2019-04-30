<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="scoreProf";

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
                          <h4 class="title">Consulter le score</h4>
                          <p class="category">Veillez choisir le nom du module </p>
													<center>
													<form class="form-inline" action="#" method="post">
    												<div class="form-group">
      												<select class="form-control mb-2 mr-sm-2" name="selectMatiere" onchange="informations()">
																<option></option>

                                <?php

                                  //var_dump($selectEtudiant);
                                  // code...
                                  if (isset($_GET['Professeur']) && !empty($_GET['Professeur'])) {
                                    $id_prof=$_GET['Professeur'];
                                  }
                                  else {
                                    $id_prof=$_SESSION['id_prof'];
                                  }
                                $requete="SELECT * FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN niveau ON Filiere.id_niveau=niveau.id_niveau WHERE matiere.id_prof=:id_prof";
                                $donnees=$bd->prepare($requete);
                                $donnees->bindParam('id_prof',$id_prof);
                                $donnees->execute();

                                while ($resultat=$donnees->fetchObject())
                                {
                                      ?>
                                      <option value="<?=$resultat->id_matiere?>"><?=$resultat->lib_matiere." - ".$resultat->code_classe." ( ".$resultat->code_niveau." ) - ".$resultat->date_matiere."  ".$resultat->semestre_matiere?></option>

                                <?php
                                }
                                 ?>
      												</select>
    												</div>
    													<button type="submit" class="btn btn-primary" name="recherche">Consulter</button>
  												</form><br>
												</center>

                      </div>
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Score </h4>
                                <p class="category">Details scores</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>

                                    </thead>
                                    <tbody>
																					<?php
                                          $totaletudiant=0;

																						//var_dump($selectEtudiant);
																						// code...
                                            if (isset($_POST['selectMatiere']) && !empty($_POST['selectMatiere'])) {
                                              $id_matiere=$_POST['selectMatiere'];
                                              // code...
                                            }

								                          $requete="SELECT * FROM `question` WHERE question.id_matiere=:id_matiere";
																					$donnees=$bd->prepare($requete);
                                          $donnees->bindParam('id_matiere',$id_matiere);
																					$donnees->execute();

                                          $appreciation=0;
                                          $emploi_temps=0;
                                          $logistique=0;
                                          $pedagogie=0;
                                          $maitrise_prof=0;
                                          $methode_pedagogique=0;
                                          $document_support=0;
                                          $gest_temps=0;
                                          $comportement_prof=0;
                                          $deroulement_cour=0;
                                          $assiduite_ponctualite=0;
                                          $prestation=0;
                                          //$le_plus_apprecier=0;
                                          //$le_moin_apprecier=0;
                                          //$suggestion=0;

                                          $total=0;

																					while ($resultat=$donnees->fetchObject())
																					{
                                            $appreciation=$appreciation+$resultat->appreciation;
                                            $emploi_temps=$emploi_temps+$resultat->emploi_temps;
                                            $logistique=$logistique+$resultat->logistique;
                                            $pedagogie=$pedagogie+$resultat->pedagogie;
                                            $maitrise_prof=$maitrise_prof+$resultat->maitrise_prof;
                                            $methode_pedagogique=$methode_pedagogique+$resultat->methode_pedagogique;
                                            $document_support=$document_support+$resultat->document_support;
                                            $gest_temps=$gest_temps+$resultat->gest_temps;
                                            $comportement_prof=$comportement_prof+$resultat->comportement_prof;
                                            $deroulement_cour=$deroulement_cour+$resultat->deroulement_cour;
                                            $assiduite_ponctualite=$assiduite_ponctualite+$resultat->assiduite_ponctualite;
                                            $prestation=$prestation+$resultat->prestation;
                                            //$le_plus_apprecier=$le_plus_apprecier+$resultat->le_plus_apprecier;
                                            //$le_moin_apprecier=$le_moin_apprecier+$resultat->le_moin_apprecier;
                                            //$suggestion=$suggestion+$resultat->suggestion;

                                          $total++;
                                         }
          $score=$appreciation+$emploi_temps+$logistique+$pedagogie+$maitrise_prof+$methode_pedagogique+$document_support+$gest_temps+$comportement_prof+$deroulement_cour+$assiduite_ponctualite+$prestation;


                                          ?>
                                          <tr>
                                            <td><h4>Nombre Votans <strong>( <?=$total?> )</strong><h4></td>
                                              <?php if ($total==0) {
                                                $total=1;
                                                } ?>
                                            <td><h4>Score: <strong><?=$score." / ".$total*42?> (points)</strong><h4></td>
                                          </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                      <div class="card">
                        <div class="header">
                            <h4 class="title">Details </h4>
                            <p class="category">Details scores</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>

                                </thead>
                                <tbody>

                                      <tr>
                                        <td colspan="2" class="text-center" style="background-color:#bebfc0;"><h6>Organisation du cours</h6> </td>
                                      </tr>

                                      <tr>
                                        <td>Appreciation de la programation du cours * 4</td>
                                        <td style="width:40%;">
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($appreciation*100)/($total*4)?>%"></div>
                                        </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Appreciation du planning (emploi du temps) * 4</td>
                                        <td>
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($emploi_temps*100)/($total*4)?>%"></div>
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>Organisation Logistique * 4</td>
                                      <td>
                                        <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($logistique*100)/($total*4)?>%"></div>
                                        </div>
                                      </td>
                                    </tr>

                                      <tr>
                                        <td colspan="2" class="text-center" style="background-color:#bebfc0;"><h6>prestation du Professeur</h6></td>
                                      </tr>

                                      <tr>
                                        <td>Capacite pedagogique du prof * 4</td>
                                        <td>
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($pedagogie*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Maitrise du theme devellopé dans le cours * 4</td>
                                        <td>
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($maitrise_prof*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Methode pédagogique * 2</td>
                                        <td>
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($methode_pedagogique*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Qualités documents et support de cours * 4</td>
                                        <td>
                                          <div class="progress">
                                            <div class="progress-bar bg-success" style="width:<?=($document_support*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Gestion du temps et programme * 4</td>
                                        <td>
                                          <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($gest_temps*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Comportement</td>
                                        <td>
                                          <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($comportement_prof*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Deroument par rapport à l'étudiant * 4</td>
                                        <td>
                                          <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($deroulement_cour*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Assuduite et Ponctualité * 4</td>
                                        <td>
                                          <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($assiduite_ponctualite*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>Appréciation de l'étudiant * 4</td>
                                        <td>
                                          <div class="progress">
                                          <div class="progress-bar bg-success" style="width:<?=($appreciation*100)/($total*4)?>%"></div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <a class="btn btn-primary" href="feedback.php?matiere=<?=$id_matiere?>">Voir feedback(s)</a>
                                        </td>
                                      </tr>
                                </tbody>
                            </table>

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
