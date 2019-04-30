<?php
session_name('test');
session_start();
session_unset();
session_destroy();
 ?>
 <!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">

    <title></title>
  </head>
  <body>
    <div class="">
      <form class="" action="traitement.php" method="post">


    <div class="form-structor">
    	<div class="signup">
    		<h2 class="form-title" id="signup"><span>ou</span>Se connecter</h2>
        <?php if (isset($erreure))
                {
                  ?>
                    <p class="danger"><?php echo $erreure ?></p>
                    <?php
                }
         ?>
        <div class="form-holder">
          <input type="text" class="input" name="login" placeholder="Utilisateur">
          <input type="password" class="input" name="mdp" placeholder="Mot de passe">
        </div>


    		<button class="submit-btn" name="submit" value="connecter">Se connecter </button>
    	</div>
    	<div class="login slide-up">
    		<div class="center">
    			<h2 class="form-title" id="login"><span>ou</span>Créer Compte</h2>
          <div class="form-holder">
            <input type="number" class="input" name="cni" placeholder="N°CNI">
            <input type="text" class="input" name="Nlogin" placeholder="Nom Utilisateur">
            <input type="password" class="input" name="Nmdp" placeholder="Mot de passe">
            <select name="titre" class="input">
              <option value="" selected>Selectionner le titre</option>
              <option value="etudiant">Etudiant</option>
              <option value="professeur">Professeur</option>
            </select>
      		</div>
    		 <button class="submit-btn" name="enregistrement" value="enregistrement">Enregistrer</button>
    		</div>
    	</div>
    </div>
  </form>
  </div>
  </body>
  <script type="text/javascript" src="js/script.js"></script>
</html>
