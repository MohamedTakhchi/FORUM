<?php
	require_once('menu.php');
	require_once('../Class/Post.class.php');
	require_once('../Class/Category.class.php');
  	
  	$listCategories = new Category();
  	$listCategories = $listCategories->getAll();

  	$postList = new Post();
  	$postList = $postList->getSavedPost($_SESSION['user'][0]['id_user']);

  	if (isset($_POST['getpost'])) {
  		if ($_POST['category'] != 0) {
  			$postList = new Post();
  			$postList = $postList->getSavedByCategory($_SESSION['user'][0]['id_user'],$_POST['category']);
  		}
  	}

  	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Postes Enregistrés</title>
	</head>
	<body>
		<div class="w3-display-topright" style="margin-top: 100px;">
			<?php echo "Dernière Connexion : ".$_SESSION['user'][0]['lastconnection']; ?>
		</div>	
		<div class="w3-container" style="width: 70%;max-width: 70%;margin-right: auto;margin-left: auto;">
			<br>
			<br>
			<div class="w3-row" >
				<form action="" method="post">
					<div class="w3-col m3">
						<label for="category" class="w3-col">Filtrer par Categorie  :</label>
					</div>
					<div class="w3-col m6">
                   		<select class="w3-select" name="category">
                         	  <option value="0">Tous</option>
                            <?php
                            for ($i = 0; $i < count($listCategories); ++$i) { 
                              ?>
                              <option value="<?php echo $listCategories[$i]['id_category'] ?>" > <?php echo $listCategories[$i]['name'] ?> </option>
                              <?php
                            }?>
                    	</select>
                    </div>
                    <div class="w3-col m1"><p></p></div>
                    <div class="w3-col m2">
                    	<button type="submit" id="getpost" name="getpost"  class="w3-button w3-block w3-indigo " >Valider</button>
                    </div>
				</form>
			</div>
			<h1>Liste des Postes </h1>
			<br>
			<br>
			<?php
              if($postList != null)
                for ($i = 0; $i < count($postList); ++$i) { 
                  ?>
                  <div class="w3-card  w3-white" style="padding: 2rem;margin-bottom: 2rem;padding-left: 3rem; ">
                  	<h2><a href="post.php?idPost=<?php echo $postList[$i]['id_topic'] ?>"><?php echo $postList[$i]['title'] ?></a></h2>
                  	<p>par : <a href="user.php?idUser=<?php echo $postList[$i]['id_user'] ?>"><?php echo $postList[$i]['username'] ?></a></p>
                  	<p style="text-align: right;">le : <?php echo $postList[$i]['created_at'] ?></p>
                  </div>
                  <?php
                }
                ?>
		</div>
 		


		
	</body>
</html>