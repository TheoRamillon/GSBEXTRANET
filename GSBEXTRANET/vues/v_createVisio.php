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
        
         <div class="page-content container">
	              <div class="row">
		            <div class="col-md-4 col-md-offset-4">
			          <div class="login-wrapper">
				        <div class="box">
					   <div class="content-wrap">
						<legend>Ajouter une visioconférence </legend>
							<form method="post" action='index.php?uc=Visio&action=createVisio'>
                                                             <input type='text' name='nomVisio' value="Nom de la visioconférence">
                                                             <br>
                                                             <input type='text' name='objectif' value="Objectif">
                                                             <br>
                                                             <input type='text' name='url' value="url">
                                                             <br>
                                                             <input type='text' name='dateVisio' value="date de la visioconférence">
                                                               <br>
                                                              <br>
                                                              
                                                             <input type='submit' name='btnCreateVisio' value='Ajouter'>
                                                              <input type='submit' name='btnRetourVisio' value='Retour'>
                                                        </form>
                                                <br>
                                                
                                             </div>	
                                     
                                    
				        </div>
			            </div>
		            </div>
	                </div>
                    </div>
        
              
                

        </
        
        
</html>

