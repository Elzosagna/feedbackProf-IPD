<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="listEtudiant";
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
  <?php
  if ( isset($_GET['Etudiant']) && !empty($_GET['Etudiant'])) {
    $id_etudiant=$_GET['Etudiant'];

  }
  $requete="SELECT * FROM `etudiant` LEFT JOIN Filiere ON etudiant.id_classe=Filiere.id_classe LEFT JOIN niveau ON Filiere.id_niveau=niveau.id_niveau WHERE id_etudiant=:id_etudiant";
  $donnees=$bd->prepare($requete);
  $donnees->bindParam('id_etudiant',$id_etudiant);
  $donnees->execute();
  //$resultat=$donnees->fetchObject();
  $resultat=$donnees->fetchObject();
   ?>

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
                          <h4 class="title">Nouvel Etudiant</h4>
                          <p class="category">Ajouter un vouvel etudiant </p><br>
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
                                        <strong class="alert-link">Reussi!</strong> Modifiaction Enregistrée</a>
                                        </label>
                                      </div>
                                    <?php }
                                    if ($erreure=='-1')// enregistrement de meme etudiant dans la base de données
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert alert-danger col-md-4">
                                        <strong class="alert-link">Echec!</strong> Revoir les information de l'etudiant</a>
                                      </div>
                                    <?php }

                                    if ($erreure=='2')// variable manquant donc echec
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert-Danger col-md-4">
                                        <strong class="alert-link">Echec!</strong> Veillez remplir tous les champs</a>
                                      </div>
                                    <?php }
                                  }
                               ?>


                            </div><br>
                            <div class="form-row">

                              <div class="form-group col-md-6">
                                <input type="hidden" name="action" value="modifEtudiant">
                                <input type="hidden" name="id_etudiant" value="<?=$id_etudiant?>">

                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Nom de l'etudiant" name="nom_etudiant" value="<?=$resultat->nom_etudiant?>" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Prénom</label>
                                <input type="text" class="form-control" placeholder="Prénom de l'etudiant" name="prenom_etudiant" value="<?=$resultat->prenom_etudiant?>" required>
                              </div>
                            </div>
                            <div class="form-row">

                            <div class="form-group col-md-6">
                              <label>Date de naissance</label>
                              <input type="date" class="form-control" placeholder="2000-01-18" name="date_naiss" value="<?=$resultat->date_naissance_et?>" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Lieu de naissance</label>
                              <input type="text" class="form-control" placeholder="ex:Dakar" name="lieu_naissance" value="<?=$resultat->lieu_naissance?>" required>
                            </div>
                          </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label>N°CNI</label>
                                <input type="number" class="form-control" placeholder="ex:123XXXXXXXX" name="cni_etudiant" value="<?=$resultat->cni_etudiant?>" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label>Classe</label>
                                <select class="form-control" name="classe_etudiant" required>
                                  <option>Coisir la Filiére</option>
                                  <option value="<?=$resultat->id_classe?>" selected required><?= $resultat->lib_classe." ( ".$resultat->code_niveau." )"?></option>
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
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
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
