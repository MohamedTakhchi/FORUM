<?php
	require_once('../Class/User.class.php');
	session_start();
	if (!isset($_SESSION['user'])) {
      ?>
      <script type="text/javascript"> 
        window.location="index.php";
      </script>
      <?php
      exit();
  }


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
	</head>
	<body style="background-color: #e1e1e1">
 		<header class="w3-container w3-indigo w3-display-container" style="height:100px;white-space: nowrap;overflow: inherit;">
			<div class="w3-container w3-display-left w3-bar" style="margin-left: 10%;max-width: 50%;">
  				<a href="dashboard.php" class="w3-bar-item w3-hover-white">Postes</a>
  				<a href="addPost.php" class="w3-bar-item w3-hover-white">Ajouter un Poste</a>
  				<a href="savedPost.php" class="w3-bar-item w3-hover-white">Postes Enregistrés</a>
          <?php 
            // si l'utilisateur est un admin ==> id d'utilisateur = 1
            if ($_SESSION['user'][0]['id_user']==1) {
              ?>
                <a href="category.php" class="w3-bar-item w3-hover-white">Categories</a>
              <?php
            }
          ?>
			</div>
			<div class="w3-container w3-display-right " style="max-width: 30%;margin-right: 15%;">

        <div class="w3-dropdown-hover">
  				<a href="" class="w3-hover-white w3-button w3-indigo"><img class="w3-circle" width="40px" height="40px" style="margin-right: 10px;" src="../Avatars/<?php echo $_SESSION['user'][0]['avatar']; ?>"><span style="text-decoration: underline;"><?php echo $_SESSION['user'][0]['username']; ?></span></a>
            <div class="w3-dropdown-content w3-bar-block w3-card-4" style="z-index: 7;">
              <a href="user.php?idUser=<?php echo $_SESSION['user'][0]['id_user']; ?>" class="w3-bar-item w3-button">Voir le Profile</a>
              <a href="modifyProfile.php" class="w3-bar-item w3-button">Modifier Vos Infos</a>
              <a href="changePassword.php" class="w3-bar-item w3-button">Changer le Mot de Passe</a>
            </div>
        </div>

  				<a href="signout.php" class="w3-bar-item" style="margin-top: 7px;margin-right: 20px;">Déconnexion</a>
			</div>
		</header>
	</body>
</html>

