<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="formulaireNote";
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
                          <h4 class="title">Formulaire de note</h4>
                          <p class="category">noter le prof</p><br>
                          <form method="post" action="action.php">
                            <input type="hidden" name="action" value="noterProf">
                            <input type="hidden" name="id_matiere" value="<?=$_GET['noteForm']?>">
                            <div class="row form-row">
                              <div class="form-group col-md-12" style="background-color:#bebfc0; text-align:center;">
                                <label style="color:black;">
                                  prestation du professeur
                              </label>
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>Comment appreciez-vous la programation de ce cours?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="appreciation" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="appreciation" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="appreciation" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="appreciation" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>Comment appreciez-vous le planning du cours?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="emploi_temps" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="emploi_temps" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="emploi_temps" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="emploi_temps" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>Comment jugez vous l'organisation logistique <br>
                                  <span style="font-size:13px"><i>(la salle de cours, materiel de projection)
                                </i></span>?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="logistique" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="logistique" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="logistique" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="logistique" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-12" style="background-color:#bebfc0; text-align:center;">
                                <label style="color:black;">
                                  prestation du professeur
                              </label>
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Comment avez-vous apprecié les capacités pedagogiques du Professeur <br>
                                <span style="font-size:13px"><i>(annimation, explication, reponses aux questions des etudiants)
                              </i></span>?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="pedagogie" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="pedagogie" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="pedagogie" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="pedagogie" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Comment jugez vous la maitrise par le professeurs des themes devellopés dans ce cours ?
                              </p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="maitrise_prof" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="maitrise_prof" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="maitrise_prof" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="maitrise_prof" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>Comment appreciez-vous les methodes pedagogiques employés ?<br>
                                <span style="font-size:13px">
                                  <i>
                                    <strong>1. Adaptés au cours </strong> /
                                    <strong>2. Inadaptés au cours </strong>
                                  </i>
                                </span>
                                </p>
                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="methode_pedagogique" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="methode_pedagogique" value="2" required>&nbsp;&nbsp;2
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>Comment appreciez-vous la qualité des documents et supports de cours diffusé par le professeur ?</p>
                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="document_support" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="document_support" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="document_support" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="document_support" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Comment appreciez-vous la gestion du temps et du programme par le professeur <br>
                                <span style="font-size:13px"><i>(respect du syllabus et du programme,respect de l'emploi du temps)
                              <i></span>?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="gest_temps" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="gest_temps" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="gest_temps" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="gest_temps" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Que pensez-vous du comportement du professeur en classe<br><span style="font-size:13px"><i>
                                (ecoute, patience, rigueur, capacité à maintenir la discipline, capacité relationnelle, capacité à motivé l'interet des etudiant par son cours ect..)
                              <i></span>?</p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="comportement_prof" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="comportement_prof" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="comportement_prof" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="comportement_prof" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Comment appreciez-vous le deroulement du cour par rapport a vos attentes ?
                              </p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="deroulement_cour" value="1">&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="deroulement_cour" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="deroulement_cour" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="deroulement_cour" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Comment appreciez-vous l'assiduité du prof et la ponctualité du professeur?
                              </p>

                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="assiduite_ponctualite" value="1" required>&nbsp;&nbsp;
                                        1&nbsp;&nbsp; <input type="radio" class="form-check-input" name="assiduite_ponctualite" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="assiduite_ponctualite" value="3" required>&nbsp;&nbsp;
                                        3&nbsp;&nbsp; <input type="radio" class="form-check-input" name="assiduite_ponctualite" value="4" required>&nbsp;&nbsp;4
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                Globalement comment appreciez-vous la prestation du professeur ? <br>
                                <span style="font-size:13px"><i>
                                  <strong>1. Assidu et ponctuel </strong>(O-1 retard et/ou abscence)<br>
                                  <strong>2. Peut s'ameliorer </strong>(entre 2 et 4 retards et/ou abscences)<br>
                                  <strong>3. Absencteiste et retardataire </strong>(+4 abscences et/ou retards)
                                  <i></span></p>
                              </p>
                              </div>
                              <div class="form-group col-md-4">
                                        <input type="radio" class="form-check-input" name="prestation" value="1" required>&nbsp;&nbsp;1
                                        <input type="radio" class="form-check-input" name="prestation" value="2" required>&nbsp;&nbsp;
                                        2&nbsp;&nbsp; <input type="radio" class="form-check-input" name="prestation" value="3" required>&nbsp;&nbsp;3

                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                  Qu'avez-vous le plus apprecié dans ce cours ?
                                </p>
                              </p>
                              </div>
                              <div class="form-group col-md-4">
                                <textarea name="le_plus_apprecier" rows="8" cols="80" class="form-control">Mettez ici votre texte</textarea>
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                  Qu'avez-vous le moins apprecié dans ce cours ?
                                </p>
                              </p>
                              </div>
                              <div class="form-group col-md-4">
                                <textarea name="le_moin_apprecier" rows="8" cols="80" class="form-control">Mettez ici votre texte</textarea>
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="form-group col-md-8">
                                <p>
                                  Quelles sont vos suggestions pour ameliorer ce cours ?
                                </p>
                              </p>
                              </div>
                              <div class="form-group col-md-4">
                                <textarea name="suggestion" rows="8" cols="80" class="form-control">Mettez ici votre texte</textarea>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Noter</button>
                            </div>
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
