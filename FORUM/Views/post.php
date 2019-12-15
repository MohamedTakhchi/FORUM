<?php
	require_once('menu.php');
	require_once('../Class/Post.class.php');
	require_once('../Class/Category.class.php');
  require_once('../Class/Comment.class.php');
 

  	$post = new Post();
    $isSaved = $post->isSaved($_GET['idPost'],$_SESSION['user'][0]['id_user']);
  	$post = $post->Find($_GET['idPost']);

    $comments = new Comment ();
    $comments = $comments->getAllByPost($_GET['idPost']);

  	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="X-UA-Compatible" content="ie=edge">
  		<link rel="stylesheet" href="../Css/W3style.css">
  		<title>Dashboard</title>
	</head>
	<body>
		<div class="w3-display-topright" style="margin-top: 100px;">
			<?php echo "Dernière Connexion : ".$_SESSION['user'][0]['lastconnection']; ?>
		</div>	
		<div class="w3-container" style="width: 70%;max-width: 70%;margin-right: auto;margin-left: auto;">
			<br>
			<br>
			<h1> <?php echo $post[0]['title'] ?> </h1>
			<br>
			<br>

      
      <a href="user.php?idUser=<?php echo $post[0]['id_user'] ?>">
          <img src="../Avatars/<?php echo $post[0]['avatar'] ?>" width="50px" height="50px" class="w3-circle" style="margin-top: 0;">
          <?php echo $post[0]['username'] ?>
      </a>
       <br>
       <br>
      <p>
        <?php echo $post[0]['body'] ?>
      </p>
			<?php
              if($post[0]['image'] != null) { 
                 ?>
                  <img src="../PostsPics/<?php echo $post[0]['image'] ?>" style="max-width: 70%;margin-right: auto;margin-left: auto;" >
                <?php
                }
      ?>
      <br>
        <form method="post" action="">
          <?php if($isSaved == 0){ ?>
          <button type="submit" id="save" name="save"  class="w3-button w3-block w3-indigo w3-section w3-padding" style="margin-left:auto;margin-right: auto;width: 20%;">Enregistrer le Poste</button>
          <?php } else{ ?>
          <button type="submit" id="save" name="save"  class="w3-button w3-block w3-indigo w3-section w3-padding" style="margin-left:auto;margin-right: auto;width: 20%;" disabled="">Déjà Enregistré</button>
          <?php } ?>
        </form>
      <hr>
      <br>
      <h1>Commentaires </h1>
      <br>
      <br>
        <form method="post" action="">
          <div class="w3-row">
            <div class="w3-col m8">
              <textarea rows="3" class="w3-input w3-border w3-margin-bottom" name="comment" id="comment" oninput="validateForm()">
                
              </textarea>
            </div>
            <div class="w3-col m2">
              <button type="submit" id="add" name="add"  class="w3-button w3-block w3-indigo w3-section w3-padding" disabled style="margin-left: 15px;">Commenter</button>
            </div>
          </div>
        </form>

        <br>
        <ul class="w3-ul w3-border w3-panel">
        <?php
            if($comments != null)
                for ($i = 0; $i < count($comments); ++$i) { 
                  ?>
                  <li>
                    <a href="user.php?idUser=<?php echo $comments[$i]['id_user'] ?>">
                       <img src="../Avatars/<?php echo $comments[$i]['avatar'] ?>" width="25px" height="25px" class="w3-circle" style="margin-top: 0;">
                       <?php echo $comments[$i]['username'] ?>
                    </a>
                    <p> <?php echo $comments[$i]['body'] ?> </p>
                    <p style="text-align: right;">le : <?php echo $comments[$i]['created_at'] ?></p>
                  </li>
                  <?php
                }
                ?>
          </ul>

		</div>


    <script type="text/javascript">
    function validateForm(){
            if( !(document.getElementById("comment").value=="")  )
              document.getElementById("add").disabled=false;
            else
              document.getElementById("add").disabled=true;
              }
      </script>
	</body>
</html>
<?php
  if (isset($_POST['add'])) {
    $comment = new Comment ();
    $comment->setBody($_POST['comment']);
    $comment->setUserId($_SESSION['user'][0]['id_user']);
    $comment->setPostId($_GET['idPost']);
    $comment->add();
    ?>
      <script type="text/javascript"> 
        window.location="post.php?idPost=<?php echo $_GET['idPost'] ?>";
      </script>
      <?php
  }

  if (isset($_POST['save'])) {
    $postToSave = new Post();
    $postToSave->savePost($_GET['idPost'],$_SESSION['user'][0]['id_user'])
    ?>
      <script type="text/javascript"> 
        window.location="post.php?idPost=<?php echo $_GET['idPost'] ?>";
      </script>
      <?php
  }
?>