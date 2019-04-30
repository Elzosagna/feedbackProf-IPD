<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="listProfesseur";

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
                        <a class="btn btn-primary pull-right" href="newProfesseur.php">
                          Ajouter Nouveau
                        </a>
                            <br>
                       </div>
                     </div>
                     <div class="col-md-12">
                       <div class="card">
                         <div class="header">
                             <h4 class="title">Liste des professeurs</h4>
                             <p class="category">Selection le prof à chercher </p><br>
   													<center>
   													<form class="form-inline" action="#" method="post">
       												<div class="form-group">
                                  <input type="text" class="form-control mb-2 mr-sm-2" name="selectNom_Prof" placeholder="Nom du professeur">
                                  <span>&nbsp;&nbsp;ET&nbsp;</span>
                                  <input type="text" class="form-control mb-2 mr-sm-2" name="selectPrenom_Prof" placeholder="Prenom du professeur">
                                  <span>&nbsp;&nbsp;OU&nbsp;</span>
         												<select class="form-control mb-2 mr-sm-2" name="selectProfesseur">
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
                                    	<th>Nom</th>
                                    	<th>Prenom</th>
                                      <th>Module</th>
																			<th>classe</th>
                                      <th>Action</th>
                                      <th>Voir scores</th>

                                    </thead>
                                    <tbody>
																					<?php
                                          if (isset($_POST['selectProfesseur']) && !empty($_POST['selectProfesseur']) || isset($_POST['selectNom_Prof'],$_POST['selectPrenom_Prof']) && !empty($_POST['selectNom_Prof'] && $_POST['selectPrenom_Prof'])  || isset($_GET['classe']) && !empty($_GET['classe'])) {

                                              // recherche par classe
                                            if (isset($_POST['selectProfesseur']) && !empty($_POST['selectProfesseur'])) {
                                              $selectProfesseur=$_POST['selectProfesseur'];
                                              //var_dump($_POST['selectProfesseur']);

                                              //var_dump($selectProfesseur."    ".$selectProfesseur);
                                            }
                                            //recherche par nom et prénom
                                            elseif (isset($_POST['selectNom_Prof'],$_POST['selectPrenom_Prof']) && !empty($_POST['selectNom_Prof'] && $_POST['selectPrenom_Prof'])) {

                                              $nom_prof=$_POST['selectNom_Prof'];
                                              $prenom_prof=$_POST['selectPrenom_Prof'];
                                              //var_dump($prenom_Prof."    ".$nom_Prof);
                                            }
                                            //retour de modification et affichage directe des derniers resultat avant modification
                                            else {
                                              $selectProfesseur=$_GET['classe'];
                                            }
																						//var_dump($selectProfesseur);
																						// code...


                $requete="SELECT * FROM `professeur` LEFT JOIN matiere on professeur.id_prof=matiere.id_prof LEFT JOIN Filiere on matiere.id_classe=Filiere.id_classe WHERE professeur.nom_prof=:nom_prof AND professeur.prenom_prof=:prenom_prof || Filiere.id_classe =:selectProfesseur";
																					$donnees=$bd->prepare($requete);
                                          $donnees->bindParam('selectProfesseur',$selectProfesseur);
                                          $donnees->bindParam('nom_prof',$nom_prof);
                                          $donnees->bindParam('prenom_prof',$prenom_prof);
																					$donnees->execute();
                                        //var_dump($prenom_Prof."    ".$nom_Prof);


																					while ($resultat=$donnees->fetchObject())
																					{
																								?>
																						<tr>
																							<td><?=$resultat->prenom_prof?></td>
																							<td><?=$resultat->nom_prof?></td>
                                              <td><?=$resultat->lib_matiere?></td>
																							<td><?=$resultat->lib_classe?></td>
                                              <td><a class="" href="modifProfesseur.php?Professeur=<?=$resultat->id_prof?>&classe=<?=$resultat->id_classe?>" style="width:5%">
                                                  <i class="pe-7s-note"></i></a>&nbsp;&nbsp; / &nbsp;&nbsp;
                                                  <?php //Pour la suppression on recupert l'id et cni du prof a suprimer
                                                        //en plus l'id de sa classe pour la redirection apres supression d'afficher la liste des prof qui sont dans cette classe?>
                                                  <a href="supprimer.php?suprimProfesseur=<?=$resultat->id_prof?>&cni=<?=$resultat->cni_prof?>&classe=<?=$resultat->id_classe?>">
                                                      <i class="pe-7s-trash"></i></a>
                                                </td>
                                                <td><a href="scoreProf.php?Professeur=<?=$resultat->id_prof?>">
                                                  <i class="pe-7s-look"></i></a>
                                                </td>

																						</tr>
																					<?php }
																					} ?>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Tous les Profs</h4>
                                <p class="category">La liste de tous les professeurs</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Domaine</th>
                                    <th>Matiere Enseignée</th>
                                    <th>Classe</th>
                                    <th>Date</th>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $requete="SELECT * FROM `matiere`RIGHT JOIN professeur ON matiere.id_prof=professeur.id_prof LEFT JOIN Filiere ON matiere.id_classe=Filiere.id_classe ORDER BY `professeur`.`nom_prof` ASC,`matiere`.`id_matiere` ASC, `professeur`.`prenom_prof` ASC";
                                      $donnees=$bd->prepare($requete);
                                      $donnees->execute();

                                      while ($resultat=$donnees->fetchObject())
                                      {
                                            ?>
                                        <tr>
                                          <td><?=$resultat->prenom_prof?></td>
                                          <td><?=$resultat->nom_prof?></td>
                                          <td><?=$resultat->matiere_prof?></td>
                                          <td><?php echo $resultat->lib_matiere; if (!$resultat->lib_matiere) {
                                            echo "Pas encore";
                                          }?></td>
                                          <td><?php echo $resultat->code_classe; if (!$resultat->lib_matiere) {
                                            echo "Pas encore";
                                          }?></td>
                                          <td><?php echo $resultat->date_matiere; if (!$resultat->lib_matiere) {
                                            echo "Pas encore";
                                          }?></td>
                                        </tr>
                                      <?php }
                                       ?>


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
