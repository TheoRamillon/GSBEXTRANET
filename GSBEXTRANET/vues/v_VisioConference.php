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
					
						<legend>Selectionner une Visioconférence :</legend>
							<form method="post" action="index.php?uc=Visio&action=voirVisio">
                                                            <select id="nom" title="Veuillez choisir votre visio" name="visio">


                                                            <?php
                                                            $lePdo = PdoGsb::getPdoGsb();
                                                            $mesNoms = $lePdo->voirAllVisio();
                                                           

                                                            foreach ($mesNoms as $unNom)
                                                            {
                                                                echo '<option value="'.$unNom['id'].'">'.$unNom['nomVisio'].'</option>';
                                                            }
                                                            ?>
                                                            </select>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <input type="submit" name="btnVoirVisio" value="voir la visio">
                                                           <input type="submit" name="btnInscriptionVisio" value="S'inscrire à une visio">
                                                           <?php
                                                            
                                                            if($gradeMedecin === "1"){
                                                                echo'<br>';
                                                                echo "<input type='submit' value='Effacer' name='deleteVisio'>";
                                                              
                                                                echo "<input type='submit' value='Nouveau' name='createVisio'>";
                                                                
                                                            }
                                                            ?>
                                                          
                                                            <input type="submit" name="btnRetour" value="Retour">
                                                         
                                                            <br>
                                                
                                               
                                                
                                        </div>	
                                     
                                    
				</div>
			</div>
		</div>
	</div>
</div>
        
        
        
    </body>
</html>


