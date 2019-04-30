<nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $_SESSION['prenom_user']." ".$_SESSION['nom_user']; ?></a>
            </div>
            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if ($_SESSION['titre']=='admin') { ?>
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-info" data-toggle="dropdown">
                                  <p class="pe-7s-tools"><b class="caret"></b></p>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="listUser.php">Utilisateurs</a></li>

                              <li class="divider"></li>
                                <li><a href="newAdmin.php">Nouveau admin</a></li>


                            </ul>
                      </li>
                    <?php }

                     ?>
                    <li>
                        <a class="btn btn-danger" href="logout.php" style="color:black">
                            <p class="pe-7s-power"></p>
                        </a>
                    </li>
        <li class="separator hidden-lg hidden-md"></li>
                </ul>
            </div>
        </div>
    </nav>
