<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

<!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


  <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
              FEEDBACK'PROF
            </a>
        </div>

        <ul class="nav">
            <li  <?php if (isset($page) && $page=="accueil") {echo "class='active'";} ?>>
                <a href="accueil.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li  <?php if (isset($page) && $page=="user") {echo "class='active'";} ?>>
                <a href="user.php">
                    <i class="pe-7s-user"></i>
                    <p>Profile</p>
                </a>
            </li>
            <?php if ($_SESSION['titre']=='admin') {?>
              <li  <?php if (isset($page) && $page=="listEtudiant") {echo "class='active'";} ?>>
                  <a href="listEtudiant.php">
                      <i class="pe-7s-id"></i>
                      <p>Etudiants</p>
                  </a>
              </li>
              <?php
            } ?>
            <?php if ($_SESSION['titre']=='admin') {?>
              <li  <?php if (isset($page) && $page=="listProfesseur") {echo "class='active'";} ?>>
                  <a href="listProfesseur.php">
                      <i class="pe-7s-note2"></i>
                      <p>Proffesseurs</p>
                  </a>
              </li>

              <?php
            } ?>
            <?php if ($_SESSION['titre']=='etudiant') {?>
              <li <?php if (isset($page) && $page=="noter") {echo "class='active'";} ?>>
                  <a href="noter.php">
                      <i class="pe-7s-note"></i>
                      <p>Noter</p>
                  </a>
              </li>

              <li <?php if (isset($page) && $page=="moduleEtudiant") {echo "class='active'";} ?>>
                  <a href="moduleEtudiant.php">
                      <i class="pe-7s-notebook"></i>
                      <p>Mes modules</p>
                  </a>
              </li>

              <?php
            } ?>

            <?php if ($_SESSION['titre']=='admin') {?>
              <li  <?php if (isset($page) && $page=="formulaire") {echo "class='active'";} ?>>
                  <a href="formulaire.php">
                      <i class="pe-7s-ribbon"></i>
                      <p>Formulaires</p>
                  </a>
              </li>

              <?php
            } ?>
            <?php if ($_SESSION['titre']=='professeur') {?>
              <li  <?php if (isset($page) && $page=="scoreProf") {echo "class='active'";} ?>>
                  <a href="scoreProf.php">
                      <i class="pe-7s-ribbon"></i>
                      <p>Mes Scores</p>
                  </a>
              </li>

              <li  <?php if (isset($page) && $page=="moduleProf") {echo "class='active'";} ?>>
                  <a href="moduleProf.php">
                      <i class="pe-7s-notebook"></i>
                      <p>Mes Modules</p>
                  </a>
              </li>
              <?php
            } ?>
            <?php if ($_SESSION['titre']=='admin') {?>
              <li  <?php if (isset($page) && $page=="module") {echo "class='active'";} ?>>
                  <a href="listModule.php">
                      <i class="pe-7s-notebook"></i>
                      <p>Modules</p>
                  </a>
              </li>

              <?php
            } ?>


        </ul>
  </div>
</div>
