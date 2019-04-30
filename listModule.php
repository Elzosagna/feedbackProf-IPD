<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="listModule";

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
                       <div class="card card-plain">
                        <a class="btn btn-primary pull-right" href="newModule.php">
                          Ajouter Nouveau
                        </a>
                            <br>
                       </div>
                     </div>
                  <div class="col-md-12">
                    <div class="card">
                      <div class="header">
                          <h4 class="title">Liste des Modules</h4>
                          <p class="category">Veillez renseigner la classe </p>
													<center>
													<form class="form-inline" action="#" method="post">
    												<div class="form-group">
      												<select class="form-control mb-2 mr-sm-2" name="selectModule">
																<option></option>

																<?php
																	// code...SELECT * FROM `Filiere` LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `niveau`.`code_niveau` ASC

																$requete="SELECT * FROM `Filiere` LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `niveau`.`code_niveau` ASC";
																$donnees=$bd->prepare($requete);
																$donnees->execute();
																//$resultat=$donnees->fetchObject();
																while ($resultat=$donnees->fetchObject())
																	{
																			?>

																			<option value="<?php echo $resultat->id_classe; ?>"><?php echo $resultat->code_niveau." ".$resultat->code_classe;?></option>
																<?php }
																 ?>
      												</select>
    												</div>
    													<button type="submit" class="btn btn-primary" name="recherche">Rechercher</button>
  												</form><br>
												</center>

                      </div>
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Resultats de votre recherche </h4>
                                <p class="category">informations des etudiants</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <th>Nom modules</th>
                                    	<th>Voloumes horaires</th>
                                      <th>Classe</th>
                                      <th>date</th>
                                      <th>semestre</th>
                                      <th>professeur</th>
                                      <th>Action</th>

                                    </thead>
                                    <tbody>
																					<?php
                                          $totaletudiant=0;

																					if (isset($_POST['selectModule']) && !empty($_POST['selectModule']) || isset($_GET['selectModule']) && !empty($_GET['selectModule'])) {

                                            if (isset($_POST['selectModule']) && !empty($_POST['selectModule'])) {
                                              $selectModule=$_POST['selectModule'];

                                            }
                                            else {
                                              $selectModule=$_GET['selectModule'];
                                            }
                                          $requete="SELECT * FROM `matiere` LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe LEFT JOIN niveau ON Filiere.id_niveau=niveau.id_niveau LEFT JOIN professeur on matiere.id_prof=professeur.id_prof WHERE matiere.id_classe=:selectModule";
                                          $donnees=$bd->prepare($requete);
                                          $donnees->bindParam('selectModule',$selectModule);
																					$donnees->execute();
                                          $totaletudiant=0;

																					while ($resultat=$donnees->fetchObject())
																					{
																								?>
																						<tr>
                                              <td><?=$resultat->lib_matiere?></td>
																							<td><?=$resultat->v_horaire?></td>
                                              <td><?=$resultat->code_classe." ( ".$resultat->code_niveau." )"?></td>
                                              <td><?=$resultat->date_matiere?></td>
                                              <td><?=$resultat->semestre_matiere?></td>
                                              <td><?=$resultat->prenom_prof." ".$resultat->nom_prof?></td>


                                              <td><a class="" href="modifModule.php?Module=<?=$resultat->id_matiere?>" style="width:5%">
                                                  <i class="pe-7s-note"></i></a>&nbsp;&nbsp; / &nbsp;&nbsp;
                                                  <a href="supprimer.php?suprimModule=<?=$resultat->id_matiere?>">
                                                      <i class="pe-7s-trash"></i></a>
                                                </td>

																						</tr>
																					<?php
                                          $totaletudiant++;
                                        }
																					} ?>
                                          <tr>
                                            <td colspan="7"><h3>Total <?=$totaletudiant++?><h3></td>
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

	<script>
function informations() {
	var elementtableau;
	elementtableau = "<tr><td>1</td><td>NDIAYE</td><td>TOTO</td><td>10-01-2000</td><td>DAKAR</a></td><td>STI 3</td><td><a href='#' class='pe-7s-note'></a> / <a href='#' class='pe-7s-trash'></a></td><td></td></tr>";

  document.getElementById("info").innerHTML = elementtableau;
}
</script>



</html>
