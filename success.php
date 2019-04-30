<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php if ($_GET['success']==0){
  ?>
  <div class="container">
    <div class="text-center">
      <h5>Oups!</h5>
      <h5>connectez-vous d'abord <a href="index.php">ici</a> </h5><br>

    </div>

      <img src="img/oups.png" class=" mx-auto d-block" alt="smiley" width="290" height="300">
      </div>

  <?php
}
else {
  ?>
  <div class="container">
    <div class="text-center">
      <h5>Yup!</h5>
      <h5>inscrition reussie veillez vous connecter <a href="index.php">ici</a> </h5><br>

    </div>

      <img src="img/succes.png" class=" mx-auto d-block" alt="smiley" width="290" height="250">
      </div>

  <?php

} ?>



  </body>
</html>
