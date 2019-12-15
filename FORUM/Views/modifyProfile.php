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
  		<title>Modification de Profile</title>
	</head>
	<body>
			
              <div class="w3-container w3-display-topmiddle" id="ModifyPost" style="width: 65%;margin-top: 6%;">
                   <!-- en cas d'erreur -->
      
              </div>
               <div class="w3-container w3-display-middle" style="width: 65%;">
                <div class="w3-container w3-indigo" style="width: 100%;height:6vh;"><p style="font-size: 27px;text-align: center;margin: auto;">Modifier Vos Infos</p></div>
                <div class="w3-container w3-light-gray" style="margin: auto;">
                  <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                       <div class="w3-section">

                         <label for="name">Nom Complet :*</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" id="name" name="name" oninput="validateForm()" required value="<?php echo $_SESSION['user'][0]['full_name'] ?>">

                         <label for="username">Nom d'Utilisateur :*</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" id="username" name="username" oninput="validateForm()" required value="<?php echo $_SESSION['user'][0]['username'] ?>">

                         <label for="avatar">Choisir un Avatar  :</label>
                         <input type="file" class="w3-input w3-border w3-margin-bottom" accept="image/*" name="avatar" id="avatar" >

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
            if( !(document.getElementById("username").value=="") && !(document.getElementById("name").value=="")  )
              document.getElementById("modify").disabled=false;
            else
              document.getElementById("modify").disabled=true;
              }
	    </script>	
	</body>
</html>
<?php

  require_once('../Class/Post.class.php');
  if (isset($_POST['modify'])) {
    $user = new User();
    $user->setUserId($_SESSION['user'][0]['id_user']);
    $user->setName($_POST['name']);
    $user->setUsername($_POST['username']);

    if ($_FILES['avatar']['name']!=null) {
        $user->setAvatar($_FILES['avatar']['name']);
        $file_tmp=$_FILES['avatar']['tmp_name'];
        move_uploaded_file($file_tmp, "../Avatars/".iconv("UTF-8", "ISO-8859-9//TRANSLIT",$user->getAvatar()));
      }

      else {
        $user->setAvatar($_SESSION['user'][0]['avatar']);
      }
    if ($user->ModifyInfo()==0) {

        $_SESSION['user'][0]['avatar'] = $user->getAvatar();
        $_SESSION['user'][0]['full_name'] = $user->getName();
        $_SESSION['user'][0]['username'] = $user->getUsername();
      ?>
      <script type="text/javascript"> 
        window.location="user.php?idUser=<?php echo $_SESSION['user'][0]['id_user']?>";
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


?>