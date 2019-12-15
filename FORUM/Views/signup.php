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
  		<title>Challenge</title>
	</head>
	<body>
			
              <div class="w3-container w3-display-topmiddle" id="errorSignup" style="width: 65%;">
                   <!-- en cas d'erreur -->
      
              </div>
              <div class="w3-container w3-display-middle" style="width: 65%;">
                <div class="w3-container w3-indigo" style="width: 100%;height:6vh;"><p style="font-size: 27px;text-align: center;margin: auto;">Création d'un nouveau compte</p></div>
                <div class="w3-container w3-light-gray" style="margin: auto;">
                  <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                       <div class="w3-section">

                         <label for="name">Nom Complet :</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" id="name" name="name" oninput="validateForm('1')" required>
                          <p id="namep" style="color: red;"></p>
                       
                       
                         <label for="email">Email  :</label>
                         <input type="email" class="w3-input w3-border w3-margin-bottom" name="email" id="email" oninput="validateForm('2')" required>
                        <p id="emailp" style="color: red;"></p>
                       
                       
                         <label for="username">Nom d'utilisateur  :</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" name="username" id="username" oninput="validateForm('3')" required>
                         <p id="usernamep" style="color: red;"></p>
                       
                       
                         <label for="password">Mot De Passe  :</label>
                         <input type="password" class="w3-input w3-border w3-margin-bottom" name="password" id="password" oninput="validateForm('4')" required>
                         <p id="passwordp" style="color: red;"></p>

                         <label for="avatar">Choisir un Avatar  :</label>
                         <input type="file" class="w3-input w3-border w3-margin-bottom" accept="image/*" name="avatar" id="avatar" >

                         <br/>
          				 <label>Vous avez déjà un compte ? <a href="index.php" style="color: #0056b3;"> Se connecter ici. </a> </label>

          				 <br/>
                         <button type="submit" id="add" name="add"  class="w3-button w3-block w3-indigo w3-section w3-padding" disabled>Créer</button>

                      </div>
                  </form>
                </div>
              </div>
            </div>
    <script type="text/javascript" src="../Js/JQuery.js"></script>
		<script type="text/javascript">
		function validateForm(type){
         switch(type){
          case '1': var reg= new RegExp("^(([a-zA-Z])*( )([a-zA-Z])+(( )([a-zA-Z])*)*)$");
                    if(!reg.test(document.getElementById("name").value))
                        document.getElementById("namep").innerHTML="SVP entrer un Nom valide sans chiffres ou caractères spéciaux, exemple : Nom Prenom autre prenom(facultatif)";
                    else { 
                      document.getElementById("namep").innerHTML="";
                          }
                    break;
          case '2' :var reg= new RegExp("^([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+[.]{1,1}[a-zA-Z]{2,3})$");
                    if(!reg.test(document.getElementById("email").value))
                        document.getElementById("emailp").innerHTML="SVP entrer un Email valide, exemple : ahahah@gghhg.domain_name";
                    else { 
                      document.getElementById("emailp").innerHTML="";
                          }
                    break;
         }
         if( (document.getElementById("emailp").innerHTML=="") && (document.getElementById("namep").innerHTML=="") && (document.getElementById("usernamep").innerHTML=="") && (document.getElementById("passwordp").innerHTML=="") )
          if( !(document.getElementById("email").value=="") && !(document.getElementById("name").value=="") && !(document.getElementById("username").value=="") && !(document.getElementById("password").value=="") )
             document.getElementById("add").disabled=false;
      
         }
	    </script>	
	</body>
</html>
<?php

  require_once('../Class/User.class.php');
  if (isset($_POST['add'])) {
    $user = new User();
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setUsername($_POST['username']);

    if ($_FILES['avatar']['name']!=null) {
        $user->setAvatar($_FILES['avatar']['name']);
        $file_tmp=$_FILES['avatar']['tmp_name'];
        move_uploaded_file($file_tmp, "../Avatars/".iconv("UTF-8", "ISO-8859-9//TRANSLIT",$user->getAvatar()));
      }

      else {
        $user->setAvatar("default.png");
      }
    if ($user->SignUp($_POST['password'])==0) {
      $user1 = $user->SignIn($_POST['email'],$_POST['password']);
      $_SESSION['user'] = $user1;
      ?>
      <script type="text/javascript"> 
        window.location="dashboard.php";
      </script>
      <?php
    }
    else {
      ?>
        <script type="text/javascript">
          var elem = "<div class='w3-panel w3-red w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>Un Erreur est survenu. Merci de Réessayer</h2></div>";
          $(elem).appendTo($("#errorSignup"));
        </script>
      <?php
    }
  }


?>