<?php
require('connexion.php');
$bd=connect();
include('session.php');

$page="accueil";

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
                      <div class="header">
                        <h4 class="title">Bienvenu sur votre App IPD </h4>
                        <p class="category">blablablabla......</p>
                    </div>
                    <div class="content table-responsive table-full-width"></div>
                      <h1>Quelsque mots sur Ecole</h1>
                        <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.
                         </p>
                  </div>
                  <div class="col-md-12">
                    <div class="header">
                      <h4 class="title">Informations
                        <?php if ($_SESSION['titre']=='admin')
                        {?>
                          <a class="btn btn-primary pull-right" href="newInfo.php">Nouveau Info</a>
                        <?php
                        }
                      ?>

                      </h4>

                    </div>


                  <div class="content table-responsive table-full-width">
                      <table class="table table-hover table-striped">
                          <thead>
                            <thead>
                            <th>Titre</th>
                            <th>Details</th>
                            <th>Date</th>
                            <?php if ($_SESSION['titre']=='admin')
                            {?>
                              <th>Action</th>
                            <?php
                            }
                          ?>

                            </thead>
                          </thead>
                          <tbody>
                                <?php

                                  //var_dump($selectEtudiant);
                                  // code...
                                  if (isset($_POST['detail_info'],$_POST['titre_info']) && !empty($_POST['detail_info'] && $_POST['titre_info'])) {
                                    $detail_info=$_POST['detail_info'];
                                    $titre_info=$_POST['titre_info'];

                                    // code...
                                  }

                                $requete="SELECT * FROM `infos`";
                                $donnees=$bd->prepare($requete);
                                $donnees->execute();

                                while ($resultat=$donnees->fetchObject())
                                {
                                ?>
                                <tr>
                                  <td><strong><?=$resultat->titre_info?></strong></td>
                                  <td><?=$resultat->detail_info?></td>
                                  <td><?=$resultat->date_info?></td>
                                  <?php if ($_SESSION['titre']=='admin')
                                  {?>
                                    <td><a href="supprimer.php?suprimInfo=<?=$resultat->id_info?>">
                                      <i class="pe-7s-trash"></i>
                                      </a>
                                    </td>
                                  <?php
                                  }
                                ?>

                                </tr>
                                <?php
                               }
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


</html>
