<?php
  require_once('menu.php');
  require_once('../Class/Category.class.php');
  $listCategories = new Category();
  $listCategories = $listCategories->getAll();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Ajouter un nouveau Poste</title>
	</head>
	<body>
			
              <div class="w3-container w3-display-topmiddle" id="errorAddPost" style="width: 65%;">
                   <!-- en cas d'erreur -->
      
              </div>
               <div class="w3-container w3-display-middle" style="width: 65%;">
                <div class="w3-container w3-indigo" style="width: 100%;height:6vh;"><p style="font-size: 27px;text-align: center;margin: auto;">Ajout d'un nouveau Poste</p></div>
                <div class="w3-container w3-light-gray" style="margin: auto;">
                  <form action="" method="post" style="width: 100%;" enctype="multipart/form-data">
                       <div class="w3-section">

                         <label for="title">Titre :*</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" id="title" name="title" oninput="validateForm()" required>
                       
                       
                         <label for="category">Categorie  :*</label>
                         <select class="w3-select" name="category">
                          <?php
                            for ($i = 0; $i < count($listCategories); ++$i) { 
                              ?>
                              <option value="<?php echo $listCategories[$i]['id_category'] ?>" > <?php echo $listCategories[$i]['name'] ?> </option>
                              <?php
                            }?>
                         </select>
                       
                       
                         <label for="body">Description  :*</label>
                         <textarea rows="5" class="w3-input w3-border w3-margin-bottom" name="body" id="body" oninput="validateForm()" required>
                          </textarea>

                         <label for="photo">Ajouter une Image  :</label>
                         <input type="file" class="w3-input w3-border w3-margin-bottom" accept="image/*" name="photo" id="photo" >

                         <br/>

          				 <br/>
                         <button type="submit" id="add" name="add"  class="w3-button w3-block w3-indigo w3-section w3-padding" disabled>Créer</button>

                      </div>
                  </form> 
                </div>
              </div>
            </div>
    <script type="text/javascript" src="../Js/JQuery.js"></script>
		<script type="text/javascript">
		function validateForm(){
            if( !(document.getElementById("title").value=="") && !(document.getElementById("body").value=="")  )
              document.getElementById("add").disabled=false;
            else
              document.getElementById("add").disabled=true;
              }
	    </script>	
	</body>
</html>
<?php

  require_once('../Class/Post.class.php');
  if (isset($_POST['add'])) {
    $post = new Post();
    $post->setTitle($_POST['title']);
    $post->setBody($_POST['body']);
    $post->setCategoryId($_POST['category']);
    $post->setUserId($_SESSION['user'][0]['id_user']);

    if ($_FILES['photo']['name']!=null) {
        $post->setImage($_FILES['photo']['name']);
        $file_tmp=$_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp, "../PostsPics/".iconv("UTF-8", "ISO-8859-9//TRANSLIT",$post->getImage()));
      }

      else {
        $post->setImage(null);
      }
    if ($post->add($_POST['password'])==0) {
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
          $(elem).appendTo($("#errorAddPost"));
        </script>
      <?php
    }
  }


?>