<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Page de Connexion</title>
	</head>
	<body>
		<div class="w3-container w3-display-topmiddle" id="incorrect_login" style="width: 50%;">
			<!-- en cas d'erreur -->
			
		</div>
 		<div class="w3-container w3-display-middle" style="width:50%;">
    		<div class="w3-card-4">

      		<div class="w3-center"><br>
       			<img src="../Avatars/default.png" style="width: 20%;height: 20%;max-width: 20%;max-height: 20%;">
      		</div>

      		<form class="w3-container" method="post" action="" name="loginform">
        		<div class="w3-section">
          			<label><b>Email : </b></label>
          			<input class="w3-input w3-border w3-margin-bottom" type="text"   placeholder="Entrer Votre Email" oninput	="verifyForm()"  name="email"  >
          			<label><b>Mot de Passe : </b></label>
          			<input class="w3-input w3-border" type="password" placeholder="Entrer Votre Mot de Passe"  name="password" oninput="verifyForm()" >
          			<br/>
          			<label>Vous n'avez pas de compte ? <a href="signup.php" style="color: #0056b3;"> Créer un ici. </a> </label>
          			<button class="w3-button w3-block w3-indigo w3-section w3-padding" type="submit" name="connect" id="connect" disabled="true">Connexion </button>
        		</div>
      		</form>
      		</div>
		</div>

		<script type="text/javascript" src="../Js/JQuery.js"></script>
		<script type="text/javascript">
  			function verifyForm() {
  				var email = document.loginform.email.value;
  				var password = document.loginform.password.value;
  				if ((email=="") || (password=="")) 
  					document.getElementById('connect').disabled=true;		
  				else
  					document.getElementById('connect').disabled=false;
  			}
  </script>
	</body>
</html>
<?php
	require_once('../Class/User.class.php');
	if (isset($_POST['connect'])) {
		$user = new User();
		$user = $user->SignIn($_POST['email'],$_POST['password']);
		if ($user == null) {
			?>
				<script type="text/javascript">
					var elem = "<div class='w3-panel w3-red w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>Email ou Mot de Passe incorrecte</h2><p>Merci de Réessayer</p></div>";
					$(elem).appendTo($("#incorrect_login"));
				</script>
			<?php
		}
		else {
			
			$_SESSION['user'] = $user;
			?>
      			<script type="text/javascript"> 
        			window.location="dashboard.php";
      			</script>
      		<?php
		}
	}
?>