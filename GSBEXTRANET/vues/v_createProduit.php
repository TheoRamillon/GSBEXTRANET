<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extrane</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/produit.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
    <body background="assets/img/laboratoire.jpg">
        
        
        
                <form method='post' action='index.php?uc=produits&action=createProduit'>
                <label>nom :</label>
                <input type='text' name='nom' value="Nom du produit">
                <br>
                <label>Objectif :</label>
                <input type='text' name='objectif' value="Objectif">
                <br>
                <label>Information :</label>
                <input type='text' name='information' value="Information">
                <br>
                <label>Effet indésirable :</label>
                <input type='text' name='effet' value="Effet indésirable">
                <br>
                <br>
                <input type='submit' name='btnCreate' value='Ajouter'>
                </form>
                

        
        
        
</html>

