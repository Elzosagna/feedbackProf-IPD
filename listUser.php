<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="";

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
                          <h4 class="title">Liste des utilisateurs</h4>
                          <p class="category">Veillez renseigner le pseudo</p>
                          <center>
                          <form class="form-inline" action="#" method="post">
                            <div class="form-group">
                              <input type="text" class="form-control mb-2 mr-sm-2" name="selectPseudo" placeholder="tapez le pseudo">
                              <span>&nbsp;&nbsp;OU&nbsp;</span>
                              <input type="text" class="form-control mb-2 mr-sm-2" name="selectCni" placeholder="N°CNI">

                              
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
                                       <th>Nom utilisateurs</th>
                                    <th>Mot de passe</th>
                                    <th>Titres</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                          <?php

                         if (isset($_POST['selectPseudo']) && !empty($_POST['selectPseudo']) || isset($_POST['selectCni']) && !empty($_POST['selectCni']) || isset($_GET['selectPseudo']) && !empty($_GET['selectPseudo'])) {

                                            if (isset($_POST['selectPseudo']) && !empty($_POST['selectPseudo'])) {
                                              $recherche=$_POST['selectPseudo'];

                                            }
                                            elseif (isset($_POST['selectCni']) && !empty($_POST['selectCni'])) {
                                                 $recherche=$_POST['selectCni'];

                                            }
                                            else {
                                              $recherche=$_GET['selectPseudo'];

                                            }
                                            //var_dump($selectPseudo);
                                            // code...

                $requete="SELECT * FROM `utilisateur`WHERE utilisateur.login =:recherche || utilisateur.cni=:recherche";
                                          $donnees=$bd->prepare($requete);
                                          $donnees->bindParam('recherche',$recherche);
                                          $donnees->execute();

                                          while ($resultat=$donnees->fetchObject())
                                          {
                                                ?>
                                            <tr>
                                            <td><?=$resultat->login?></td>
                                            <td><?=md5($resultat->mdp)?></td>
                                            <td><?=$resultat->titre?></td>
                                            <td>
                                              <a href="user.php?viewUser=<?=$resultat->id_user?>&titreUser=<?=$resultat->titre?>">
                                                <i class="pe-7s-look"></i>
                                              </a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                              <a href="supprimer.php?suprimUser=<?=$resultat->id_user?>">
                                                <i class="pe-7s-trash"></i>
                                                </a>
                                              </td>
                                          </tr>
                                          <?php
                                        }
                                          } ?>
                                          
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Tous les Utilisateurs</h4>
                                <p class="category">La liste de tous les Utilisateurs</p>
                                <?php if (isset($_GET['erreure']) && !empty($_GET['erreure']))
                              {
                                      $erreure=$_GET['erreure'];
                                    if ($erreure=='-1')// suppression reussi
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert alert-success col-md-4">
                                        <label>
                                        <strong class="alert-link">L'utilisateur a été bien supprimé!</strong>
                                        </label>
                                      </div>
                                    <?php }
                                    if ($erreure=='1')//echec et pas de suppression
                                    {?>
                                      <div class="col-md-4"></div>
                                      <div class="btn alert alert-danger col-md-4">
                                        <strong class="alert-link">Echec!</strong>La suppression n'a pas reussi
                                      </div>
                                    <?php }
                                  }
                               ?>

                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                  <thead>
                                    <th>Nom utilisateurs</th>
                                    <th>Mot de passe</th>
                                    <th>Titres</th>
                                    <th>Actions</th>
                                  </thead>
                                  <tbody>
                                        <?php
                                        $totalUser=0;
                                          //var_dump($selectPseudo);
                                          // code...

                                        $requete="SELECT * FROM `utilisateur` ORDER BY `utilisateur`.`login` ASC, `utilisateur`.`login` ASC, `utilisateur`.`mdp` ASC";
                                        $donnees=$bd->prepare($requete);
                                        //$donnees->bindParam('selectPseudo',$selectPseudo);
                                        $donnees->execute();
                                        while ($resultat=$donnees->fetchObject())
                                        {
                                              ?>
                                          <tr>
                                            <td><?=$resultat->login?></td>
                                            <td><?=md5($resultat->mdp)?></td>
                                            <td><?=$resultat->titre?></td>
                                            <td>
                                              <a href="user.php?viewUser=<?=$resultat->id_user?>&titreUser=<?=$resultat->titre?>">
                                                <i class="pe-7s-look"></i>
                                              </a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                              <a href="supprimer.php?suprimUser=<?=$resultat->id_user?>">
                                                <i class="pe-7s-trash"></i>
                                                </a>
                                              </td>
                                          </tr>
                                        <?php
                                        $totalUser++;
                                      }
                                         ?>
                                        <tr>
                                          <td colspan="5"><h4>Total <?=$totalUser++?><h2></td>
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
