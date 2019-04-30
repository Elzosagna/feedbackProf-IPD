<?php
require('connexion.php');
$bd=connect();
include('session.php');
$page="user";
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

      <?php
      //view informations utilisateurs actifs
        $id=$_SESSION['id_user'];
        $prenom=$_SESSION['prenom_user'];
        $nom=$_SESSION['nom_user'];
        $login=$_SESSION['login'];
        $mdp=$_SESSION['mdp'];
        $titre=$_SESSION['titre'];

        if (isset($_GET['viewUser'], $_GET['titreUser']) && !empty($_GET['viewUser'] && $_GET['titreUser'])) {
          // infos renvoyer au Profile Rechercher
          $titre=$_GET['titreUser'];
          $id_user=$_GET['viewUser'];
          if ($titre=='etudiant') {
            $req="SELECT * FROM utilisateur LEFT JOIN etudiant ON utilisateur.id_etudiant=etudiant.id_etudiant WHERE id_user=:id_user";
            $donnees=$bd->prepare($req);
            $donnees->bindParam('id_user',$id_user);
            $donnees->execute();
            $verifUser=$donnees->fetchObject();

            $id=$verifUser->id_user;
            $prenom=$verifUser->prenom_etudiant;
            $nom=$verifUser->nom_etudiant;
            $login=$verifUser->login;
            $mdp=$verifUser->mdp;
          }
          if ($titre=='professeur') {
            $req="SELECT * FROM utilisateur LEFT JOIN professeur ON utilisateur.id_prof=professeur.id_prof WHERE id_user=:id_user";
            $donnees=$bd->prepare($req);
            $donnees->bindParam('id_user',$id_user);
            $donnees->execute();
            $verifUser=$donnees->fetchObject();

            $id=$verifUser->id_user;
            $prenom=$verifUser->prenom_prof;
            $nom=$verifUser->nom_prof;
            $login=$verifUser->login;
            $mdp=$verifUser->mdp;
          }
        }
       ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Modifier mes informations</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="action.php">
                                  <input type="hidden" name="action" value="modifUser">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Prénom</label>
                                              <input type="text" disabled class="form-control" value="<?=$prenom?>">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Nom</label>
                                              <input type="text" disabled class="form-control" value="<?=$nom?>">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Nom d'utilisateur</label>
                                              <input type="text" class="form-control" name="login" value="<?=$login?>">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Mot de passe</label>
                                              <input type="text" class="form-control" name="mdp" value="<?=$mdp?>">
                                          </div>
                                      </div>
                                  </div>
                                    <?php
                                       if (isset($_GET['viewUser'], $_GET['titreUser']) && !empty($_GET['viewUser'] && $_GET['titreUser'])) {?>
                                           <button type="submit" class="btn btn-info btn-fill pull-right" disabled>Modifier</button>
                                           <?php
                                         }
                                         else
                                          {?> <button type="submit" class="btn btn-info btn-fill pull-right">Modifier</button>
                                           <?php
                                         }
                                    ?>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user" >
                            <div class="image" style="background-color:purple;opacity:0.8;" >
                                 <img src="assets/img/sidebar-5.jpg" style="opacity:0.8;">
                            </div>
                            <div class="content">
                                <div class="author">
                                    <img class="avatar border-gray" src="assets/img/faces/logo_IPD.png" alt="ipd"/>

                                      <h4 class="title"><?=$prenom." ".$nom?><br>
                                         <small><?=$login?></small>
                                      </h4>
                                </div>
                                <p class="description text-center"><?=$titre?></p>
                            </div>
                            <hr>
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
