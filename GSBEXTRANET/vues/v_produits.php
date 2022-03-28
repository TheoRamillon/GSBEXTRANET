<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extrane</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <<link rel="stylesheet" href="css/produit.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
    <body background="assets/img/laboratoire.jpg">
        
        <div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
					<div class="content-wrap">
						<legend>Selectionner un produit :</legend>
							<form method="post" action="index.php?uc=produits&action=voirProduit">
                                                            <select id="nom" title="Veuillez choisir votre produit" name="produit">


                                                            <?php

                                                            $mesNoms = $pdo->recupAllProduits();

                                                            foreach ($mesNoms as $unNom)
                                                            {
                                                                echo '<option value="'.$unNom['id'].'">'.$unNom['nom'].'</option>';
                                                            }
                                                            ?>
                                                            </select>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <input type="submit" name="btnVoirProduit" value="voir le Produit">
                                                            <br>
                                                            
                                                            <?php
                                                            
                                                            if($gradeMedecin === "1"){
                                                            
                                                                echo "<input type='submit' value='Effacer' name='deleteProduit'>";
                                                                echo "<input type='submit' value='Nouveau' name='createProduit'>";
                                                                
                                                            }
                                                            ?>

								
                                                        </form>
                                                
                                               
                                                
                                        </div>	
                                     
                                    
				</div>
			</div>
		</div>
	</div>
</div>
        
        <form method="post" action="index.php?uc=retourSommaire">
            <input type="submit" name="btnModifProduit" value="Retour" class="btnModifierProduit">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
