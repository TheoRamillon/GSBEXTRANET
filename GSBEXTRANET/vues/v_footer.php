<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/footer.css"/>
        <link rel="stylesheet" href="../bootstrap/bootstrap.min.css"/>
    </head>
    <body>
        
        <footer id="pied">
            <h1><a href="vues/v_politiqueprotectiondonnees.html">
                    Page de politique de protections des données</a></h1>

            <br>
            
            <div id="backCookiesLog">
                <?php

                if(!isset($_COOKIE['logConscentement'])){
                    
                    echo "<p> Aimez-vous les cookies ? C'est une tuerie <3 !!!";
                    
                    echo '<form method="post" action="index.php?uc=cookies">';
                    echo "<input type='submit' name ='yesCookies' class='btn btn-primary signup' value='oui'>";
                    echo "<input type='submit' name ='nonCookies' class='btn btn-primary signup' value='non'>";
                }
                
                ?>
            </div>
            
        </footer> 
            
            
        
        <?php

        ?>
    </body>
</html>
