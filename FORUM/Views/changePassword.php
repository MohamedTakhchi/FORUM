<?php
  require_once('menu.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Changement du Mot de Passe</title>
	</head>
	<body>
			
              <div class="w3-container w3-display-topmiddle" id="ModifyPost" style="width: 65%;margin-top: 6%;">
                   <!-- en cas d'erreur -->
      
              </div>
               <div class="w3-container w3-display-middle" style="width: 65%;margin-top: 5%;">
                <div class="w3-container w3-indigo" style="width: 100%;height:6vh;"><p style="font-size: 27px;text-align: center;margin: auto;">Changer Mot de Passe</p></div>
                <div class="w3-container w3-light-gray" style="margin: auto;">
                  <form action="" method="post" style="width: 100%;" >
                       <div class="w3-section">

                         <label for="oldpassword">Ancien Mot de Passe :*</label>
                         <input type="password" class="w3-input w3-border w3-margin-bottom" id="oldpassword" name="oldpassword"  required>

                         <label for="newpassword">Nouveau Mot de Passe :*</label>
                         <input type="password" class="w3-input w3-border w3-margin-bottom" id="newpassword" name="newpassword"  required>

                         <label for="newpasswordconf">Confirmer nouveau Mot de Passe :*</label>
                         <input type="password" class="w3-input w3-border w3-margin-bottom" id="newpasswordconf" name="newpasswordconf" oninput="validateForm()" required >
                         <p id="newpasswordconfp" style="color: red;"></p>

                         <br/>

          				 <br/>
                         <button type="submit" id="modify" name="modify"  class="w3-button w3-block w3-indigo w3-section w3-padding" >Modifier</button>

                      </div>
                  </form> 
                </div>
              </div>
            </div>
    <script type="text/javascript" src="../Js/JQuery.js"></script>
		<script type="text/javascript">
		function validateForm(){
            if( (document.getElementById("newpassword").value!=document.getElementById("newpasswordconf").value)  ){
              document.getElementById("newpasswordconfp").innerHTML="Il n'y a pas de ressemblance";
              document.getElementById("modify").disabled=true;
                }
              else {
                document.getElementById("newpasswordconfp").innerHTML="";
                document.getElementById("modify").disabled=false;
              }
              }
	    </script>	
	</body>
</html>
<?php

  require_once('../Class/Post.class.php');
  if (isset($_POST['modify'])) {
    $user = new User();
    $user->setUserId($_SESSION['user'][0]['id_user']);

    
    if ($user->isPasswordCorrect($_POST['oldpassword'])==-1) {
      ?>
      <script type="text/javascript"> 
        var elem = "<div class='w3-panel w3-red w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>L'ancien Mot de Passe est Incorrecte</h2></div>";
          $(elem).appendTo($("#ModifyPost"));
      </script>
      <?php
    }
    else{
     if ($user->ChangePassword($_POST['newpassword'])==0) {
       ?>
        <script type="text/javascript">
          var elem = "<div class='w3-panel w3-green w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>Le Mot de Passe est bien Modifié</h2></div>";
          $(elem).appendTo($("#ModifyPost"));
        </script>
      <?php
     }
     else {
      ?>
        <script type="text/javascript">
          var elem = "<div class='w3-panel w3-red w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>Un Erreur est survenu. Merci de Réessayer</h2></div>";
          $(elem).appendTo($("#ModifyPost"));
        </script>
      <?php
     }
   }
  }


?>