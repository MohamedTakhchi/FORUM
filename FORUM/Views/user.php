<?php
	require_once('menu.php');
	require_once('../Class/Post.class.php');
  require_once('../Class/User.class.php');
  require_once('../Class/Comment.class.php');

  $postList = new Post();
  $postList = $postList->getAllByUser($_GET['idUser']);

  $user = new User();
  $user = $user->Find($_GET['idUser']);

  $post = new Post();
  $post = $post->getNumberPosts($_GET['idUser']);

  $comment = new Comment();
  $comment = $comment->getNumberComments($_GET['idUser']);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Profile</title>
	</head>
	<body>
		<div class="w3-display-topright" style="margin-top: 100px;">
			<?php echo "Dernière Connexion : ".$_SESSION['user'][0]['lastconnection']; ?>
		</div>	

		<div class="w3-container" style="width: 30%;max-width: 30%;margin-right: auto;margin-left: auto;margin-top: 2%;">
			<div class="w3-card-4">
             <img src="../Avatars/<?php echo $user[0]['avatar']; ?>" style="width: 100%;" >
            <div class="w3-container w3-center">
              <p><b>Nom Complet : <?php echo $user[0]['full_name']; ?></b></p>
              <p><b>Nom d'Utilisateur : <?php echo $user[0]['username']; ?></b></p>
              <p><b><?php echo $user[0]['email']; ?></b></p>
            </div>
      </div>
      <div class="w3-row">
        <div class="w3-col m5">
          <div class="w3-card-4">
            <p style="text-align: center;"><b>Nombre de Postes publiés : <?php echo $post[0]['numbre']; ?></b></p>
          </div>
        </div>
        <div class="w3-col m2">
          <p></p>
        </div>
        <div class="w3-col m5">
          <div class="w3-card-4">
            <p style="text-align: center;"><b>Nombre de Commentaires : <?php echo $comment[0]['numbre']; ?></b></p>
          </div>
        </div>
      </div>

		</div>

    <div class="w3-container" style="width: 40%;max-width: 40%;margin-right: auto;margin-left: auto;">
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