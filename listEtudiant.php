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

<div class="wrapper">
    <?php include('sidebar.php') ?>
    <div class="main-panel">
		<?php include('navbar.php') ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                       <div class="card card-plain">
                        <a class="btn btn-primary pull-right" href="newEtudiant.php">
                          Ajouter Nouveau
                        </a>
                            <br>
                       </div>
                     </div>
                  <div class="col-md-12">
                    <div class="card">
                      <div class="header">
                          <h4 class="title">Liste des etudiants</h4>
                          <p class="category">Veillez renseigner la classe </p><br>
													<center>
													<form class="form-inline" action="#" method="post">
    												<div class="form-group">
                              <div class="form-group">
                                <input type="text" class="form-control mb-2 mr-sm-2" name="selectNom_Etudiant" placeholder="Nom de l'étudiant">
                                <span>&nbsp;&nbsp;ET&nbsp;</span>
                                <input type="text" class="form-control mb-2 mr-sm-2" name="selectPrenom_Etudiant" placeholder="Prenom de l'étudiant">
                                <span>&nbsp;&nbsp;OU&nbsp;</span>



                              </div>
      												<select class="form-control mb-2 mr-sm-2" name="selectEtudiant">
																<option value="">Choisir la classe</option>

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
                                        <th>Prenom</th>
                                    	<th>Nom</th>
                                      <th>Date de naissance</th>
                                      <th>Lieu de naissance</th>
                                      <th>classe</th>
                                      <th>Action</th>
                                    </thead>
                                    <tbody>
																					<?php
                                          $totaletudiant=0;

                                          //selectNom_Etudiant    selectPrenom_Etudiant

																					if (isset($_POST['selectEtudiant']) && !empty($_POST['selectEtudiant']) || isset($_POST['selectNom_Etudiant'],$_POST['selectPrenom_Etudiant']) && !empty($_POST['selectNom_Etudiant'] && $_POST['selectPrenom_Etudiant'])  || isset($_GET['classe']) && !empty($_GET['classe'])) {

                                              // recherche par classe
                                            if (isset($_POST['selectEtudiant']) && !empty($_POST['selectEtudiant'])) {
                                              $selectEtudiant=$_POST['selectEtudiant'];
                                              //var_dump($_POST['selectEtudiant']);

                                              //var_dump($selectEtudiant."    ".$selectEtudiant);

                                            }
                                            //recherche par nom et prénom
                                            elseif (isset($_POST['selectNom_Etudiant'],$_POST['selectPrenom_Etudiant']) && !empty($_POST['selectNom_Etudiant'] && $_POST['selectPrenom_Etudiant'])) {

                                              $nom_etudiant=$_POST['selectNom_Etudiant'];
                                              $prenom_etudiant=$_POST['selectPrenom_Etudiant'];

                                            }
                                            //retour de modification et affichage directe des derniers resultat avant modification
                                            else {
                                              $selectEtudiant=$_GET['classe'];
                                            }

                                            $requete="SELECT * FROM `etudiant` LEFT JOIN Filiere on etudiant.id_classe=Filiere.id_classe LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau WHERE etudiant.nom_etudiant =:nom_etudiant AND etudiant.prenom_etudiant =:prenom_etudiant || etudiant.id_classe =:selectEtudiant ORDER BY `Filiere`.`code_classe` ASC, `etudiant`.`nom_etudiant` ASC, `etudiant`.`prenom_etudiant` ASC";
                                              $donnees=$bd->prepare($requete);
                                              $donnees->bindParam('nom_etudiant',$nom_etudiant);
                                              $donnees->bindParam('prenom_etudiant',$prenom_etudiant);
                                              $donnees->bindParam('selectEtudiant',$selectEtudiant);
                                              $donnees->execute();
                                            $totaletudiant=0;

																						//var_dump($selectEtudiant);
																						// code...
																					while ($resultat=$donnees->fetchObject())
																					{
																								?>
																						<tr>
                                              <td><?=$resultat->prenom_etudiant?></td>
																							<td><?=$resultat->nom_etudiant?></td>
                                              <td><?=$resultat->date_naissance_et?></td>
                                              <td><?=$resultat->lieu_naissance?></td>
																							<td><?=$resultat->code_classe." ( ".$resultat->code_niveau." )"?></td>
                                              <td><a class="" href="modifEtudiant.php?Etudiant=<?=$resultat->id_etudiant?>" style="width:5%">
                                                  <i class="pe-7s-note"></i></a>&nbsp;&nbsp; / &nbsp;&nbsp;
                                                  <a href="supprimer.php?suprimEtudiant=<?=$resultat->id_etudiant?>&cni=<?=$resultat->cni_etudiant?>&classe=<?=$resultat->id_classe?>">
                                                      <i class="pe-7s-trash"></i></a>
                                                </td>

																						</tr>
																					<?php
                                          $totaletudiant++;
                                        }
																					} ?>
                                          <tr>
                                            <td colspan="6"><h3>Total <?=$totaletudiant++?><h3></td>
                                          </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Tous les Etudiants</h4>
                                <p class="category">La liste de tous les etudiants</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                  <thead>
                                      <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Date de naissance</th>
                                    <th>Lieu de naissance</th>
                                    <th>classe</th>



                                  </thead>
                                  <tbody>
                                        <?php
                                        $totaletudiant=0;

                                          //var_dump($selectEtudiant);
                                          // code...

              $requete="SELECT * FROM `etudiant` LEFT JOIN Filiere on etudiant.id_classe=Filiere.id_classe LEFT JOIN niveau on Filiere.id_niveau=niveau.id_niveau ORDER BY `Filiere`.`code_classe` ASC, `etudiant`.`nom_etudiant` ASC, `etudiant`.`prenom_etudiant` ASC";
                                        $donnees=$bd->prepare($requete);
                                        //$donnees->bindParam('selectEtudiant',$selectEtudiant);
                                        $donnees->execute();
                                        $totaletudiant=0;

                                        while ($resultat=$donnees->fetchObject())
                                        {
                                              ?>
                                          <tr>
                                            <td><?=$resultat->prenom_etudiant?></td>
                                            <td><?=$resultat->nom_etudiant?></td>
                                            <td><?=$resultat->date_naissance_et?></td>
                                            <td><?=$resultat->lieu_naissance?></td>
                                            <td><?=$resultat->code_classe." ( ".$resultat->code_niveau." )"?></td>
                                          </tr>
                                        <?php
                                        $totaletudiant++;
                                      }
                                         ?>
                                        <tr>
                                          <td colspan="5"><h4>Effectif <?=$totaletudiant++?><h2></td>
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
