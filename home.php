<?php
//verifico che l'utente sia già loggato
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
        <html>
            <head>
                <title >LOL ZONE </title>
                
            
        

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="homepage.css"/>
            <script src="ApiHome.js" defer="true"></script>
            <script src="AggiungiRimuoviPreferiti.js" defer="true"></script>
            
        </head>

        <body>

            
                <header> 

                

                    <nav>
                    
                        <div id=intestazione>
                            
                            <img id="logo"   src="immagini/logo.png"/>
                            <h1 id="titolo">oL Zone </h1>
                            
                            
                            <div id="menu">
                                    
                                <a id="preferiti" href=champPreferiti.php>Preferiti</a>
                                <a id="ricercaChamp"href=ricerca.php>Ricerca</a>
                                <a id="spotify"href=musica.php>Musica</a>
                                    <a id="logout"href=logout.php>Logout</a>
                                
                                    

                            </div>
                        
                        </div>
                       

                    </nav>

                    
                </header>


            

                <section>
                    <div id="titolo1">
                        <h1>ECCO LA TUA ROTAZIONE CASUALE DI CAMPIONI  <?php echo$_SESSION['username']?> </h1>
                    </div>

                    <div id="mostra_champ"> </div>
                    
                   

                </section>

                

                <footer>
                    <p>Caruso Antonino 1000016216<br/>A.A. 2022/2023</p>
                </footer>
                
            

        </body>

    </html>