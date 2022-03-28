<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/profilcss/profil.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<!--     <form method="post" action="index.php?uc=modifDonnee&action=ValidationModification">
            <label>Nom :</label>
            <input name="nom" type="text" value="">
            <br>
            <label>Prenom :</label>
            <input type="texte" name="prenom" value="">
            <br>
            <input name="check" type="checkbox" value="value1">
            <label> Changer de mot de passe : </label>
            <br>
            <input type="submit" name="btnValidation" value="Valider">
                
                
            </form>-->
  </head>
             <body background="assets/img/laboratoire.jpg">
                   <div class="page-content container">
	              <div class="row">
		            <div class="col-md-4 col-md-offset-4">
			          <div class="login-wrapper">
				        <div class="box">
					   <div class="content-wrap">
						<legend>Modfication des données </legend>
							<form method="post" action="index.php?uc=modifDonnee&action=ValidationModification">
                                                            <input name="nom" class="form-control" type="text"  value="<?php echo $medecin['nom']; ?>">
								<input name="prenom" class="form-control" type="text" value="<?php echo $medecin['prenom']; ?>">
								</br>
                                                                <label><u> Changer de mot de passe : </u></label>
                                                                <br>
                                                                <input name="check" type="checkbox" value="value1">
                                                                <br>
                                                                <?php
                                                                var_dump($_POST['check']);
                                                                    if(isset($_POST['check'])){
                                                                        if($_POST['check'] === true){
                                                                            echo '<input name="mdp1" class="form-control" type="password" placeholder="Nouveau mot de passe">
                                                                                    <input name="mdp2" class="form-control" type="password" placeholder="Confirmation mot de passe">
                                                                                    </br>
                                                                                    <input type="submit" class="btn btn-primary signup" value="Valider">';
                                                                        }
                                                                    }
                                                                ?>
                                                                <br>
                                                               <input type="submit" name="btnValidation" value="Valider">
                                                        </form>
                                                <br>
                                                
                                             </div>	
                                     
                                    
				        </div>
			            </div>
		            </div>
	                </div>
                    </div>
            
            </body>
</html>

