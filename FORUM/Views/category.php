<?php
	require_once('menu.php');
	require_once('../Class/Post.class.php');
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
  		<title>Liste des Categories</title>
	</head>
	<body>
		<div class="w3-display-topright" style="margin-top: 100px;">
			<?php echo "Dernière Connexion : ".$_SESSION['user'][0]['lastconnection']; ?>
		</div>	
		<div class="w3-container" style="width: 70%;max-width: 70%;margin-right: auto;margin-left: auto;margin-top: 5%;">
      <a href="addCategory.php"  class="w3-button w3-block w3-indigo" style="width: 20%;" >Ajouter</a>
			<table class="w3-table-all">
        <tr>
          <th>Nom de Categorie</th>
          <th>Description</th>
          <th>Date d'Ajout</th>
        </tr>
         <?php
                    for ($i = 0; $i < count($listCategories); ++$i) { 
                      ?>
                      <tr>
                        <td>
                          <?php echo $listCategories[$i]['name']?>
                        </td>
                        <td>
                          <?php echo $listCategories[$i]['description']?>
                        </td>
                        <td>
                          <?php echo $listCategories[$i]['created_at']?>
                        </td>
                      </tr>
                      <?php
                    }
         ?>
      </table>
		</div>

	</body>
</html>