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
            <script src="ricerca.js"defer="true"></script>
            <script src="AggiungiRimuoviPreferiti.js" defer="true"></script>
            
        </head>

        <body>

            
                <header> 

                

                    <nav>
                    
                        <div id=intestazione>
                            
                            <img id="logo"   src="immagini/logo.png"/>
                            <h1 id="titolo"> oL Zone </h1>
                            
                            
                            <div id="menu">
                             <a id="ricercaEvoc"href=home.php>home</a>
                                <a id="preferiti" href=champPreferiti.php>Preferiti</a>
                                <a id="spotify"href=musica.php>Musica</a>
                                <a id="logout"href=logout.php>Logout</a>
                                    

                            </div>
                        
                        </div>
                       

                    </nav>

                    
                </header>

                <section id="search">

            <form autocomplete="off">
            <div class="search">
              <label for='search'>CERCA UN CAMPIONE<br> <p id="testo" >Con più di 140 campioni, troverai quello perfetto per il tuo stile di gioco.<br> Padroneggiane uno, o tutti..</p></label>
              
              <input type='text' name="search" class="searchBar" placeholder="Es. Jinx">
              <input type="submit" value="Cerca">
            </div>
            </form>

            </section>
             <section class="container">

             <div id="results">
                
             </div>
             </section>

                

                <footer>
                    <p>Caruso Antonino 1000016216<br/>A.A. 2022/2023</p>
                </footer>
                
            

        </body>

    </html>