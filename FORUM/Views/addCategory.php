<?php
  require_once('menu.php');
  require_once('../Class/Category.class.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Ajouter une Categorie</title>
	</head>
	<body>
			
              <div class="w3-container w3-display-topmiddle" id="errorAddCategory" style="width: 65%;margin-top: 5%;">
                   <!-- en cas d'erreur -->
      
              </div>
               <div class="w3-container w3-display-middle" style="width: 65%;">
                <div class="w3-container w3-indigo" style="width: 100%;height:6vh;"><p style="font-size: 27px;text-align: center;margin: auto;">Ajout d'une nouvelle Categorie</p></div>
                <div class="w3-container w3-light-gray" style="margin: auto;">
                  <form action="" method="post" style="width: 100%;">
                       <div class="w3-section">

                         <label for="name">Nom :*</label>
                         <input type="text" class="w3-input w3-border w3-margin-bottom" id="name" name="name" required>
                       
                       
                         <label for="desc">Description  :</label>
                         <textarea rows="5" class="w3-input w3-border w3-margin-bottom" name="desc" id="desc">
                          </textarea>

                         <br/>

          				 <br/>
                         <button type="submit" id="add" name="add"  class="w3-button w3-block w3-indigo w3-section w3-padding">Créer</button>

                      </div>
                  </form> 
                </div>
              </div>
            </div>
	</body>
</html>
<?php
  if (isset($_POST['add'])) {
    $category = new Category();
    $category->setName($_POST['name']);
    $category->setMore($_POST['desc']);

    if ($category->add()==0) {
      ?>
      <script type="text/javascript"> 
        window.location="category.php";
      </script>
      <?php
    }
    else {
      ?>
        <script type="text/javascript">
          var elem = "<div class='w3-panel w3-red w3-display-container'><span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-large w3-display-topright'>&times;</span><h2>Un Erreur est survenu. Merci de Réessayer</h2></div>";
          $(elem).appendTo($("#errorAddCategory"));
        </script>
      <?php
    }
  }


?>