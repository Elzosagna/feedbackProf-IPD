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
                          <h4 class="title">Nouveau Module</h4>
                          <p class="category">Ajouter un nouveau Module</p><br>
                          <form method="post" action="action.php">
                            <div class="row">
                              <?php if (isset($_GET['erreure']) && !empty($_GET['erreure']))
                              {
                                      $erreure=$_GET['erreure'];
                                    if ($erreure=='1')// enregistrement reussi
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert alert-success col-md-4">
                                        <label>
                                        <strong class="alert-link">Enregistrement Reussi!</strong>
                                        </label>
                                      </div>
                                    <?php }
                                    if ($erreure=='-1')// enregistrement de meme etudiant dans la base de données
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert alert-danger col-md-4">
                                        <strong class="alert-link">Echec!</strong> Module est déja inscrit
                                      </div>
                                    <?php }

                                    if ($erreure=='2')// variable manquant donc echec
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert-Danger col-md-4">
                                        <strong class="alert-link">Echec!</strong> Veillez remplir tous les champs
                                      </div>
                                    <?php }
                                  }
                               ?>


                            </div><br>
                            <div class="form-row">

                              <div class="form-group col-md-6">
                                <input type="hidden" name="action" value="newModule">

                                <label>Libelle </label>
                                <input type="text" class="form-control" placeholder="Nom du Module" name="lib_matiere" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Volume horaire (h)</label>
                                <input type="number" class="form-control" placeholder="Volume horaire" name="v_horaire" required>
                              </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label>Classe</label>
                                <select class="form-control" name="id_classe" required>
                                  <option selected required>Choisir la Filiére</option>
                                  <?php
                                    // code...SELECT * FROM `Filiere` LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `niveau`.`code_niveau` ASC

                                  $requete="SELECT * FROM `Filiere` LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY Filiere.lib_classe ASC,`Filiere`.`id_niveau` ASC";
                                  $donnees=$bd->prepare($requete);
                                  $donnees->execute();
                                  //$resultat=$donnees->fetchObject();
                                  while ($resultat=$donnees->fetchObject())
                                    {
                                        ?>

                                        <option value="<?php echo $resultat->id_classe;?>" required><?php echo $resultat->lib_classe." ( ".$resultat->code_niveau." )";?></option>
                                  <?php }
                                   ?>
                                 </select>
                              </div>

                              <div class="form-group col-md-3">
                                <label>Professeur</label>
                                <select class="form-control" name="id_prof" required>
                                  <option selected required>Choisir le Prof</option>
                                  <?php
                                    // code...SELECT * FROM `Filiere` LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `niveau`.`code_niveau` ASC

                                  $requete="SELECT * FROM `professeur` ORDER BY professeur.nom_prof ASC,`professeur`.`prenom_prof` ASC";
                                  $donnees=$bd->prepare($requete);
                                  $donnees->execute();
                                  //$resultat=$donnees->fetchObject();
                                  while ($resultat=$donnees->fetchObject())
                                    {
                                        ?>

                                        <option value="<?php echo $resultat->id_prof;?>" required><?php echo $resultat->prenom_prof." ( ".$resultat->matiere_prof." )";?></option>
                                  <?php }
                                   ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-3">
                                <label>Semestre</label>
                                <select class="form-control" name="semestre_matiere" required>
                                  <option value="" selected>choisir le Semestre</option>
                                  <option value="Semestre 1">Semestre 1</option>
                                  <option value="Semestre 2">Semestre 2</option>
                                </select>

                              </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Ajouter</button>
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
