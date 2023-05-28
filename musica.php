<?php
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
                <script src="apispotify.js" defer="true"></script>
                <link rel="stylesheet" href="homepage.css"/>

                <meta name="viewport" content="width=device-width, initial-scale=1">
                
            </head>

            <body>

                <article>
                    <header> 
                            
                        
                        <nav>
                        
                            <div id="intestazione">
                                
                                <img id="logo" src="./immagini/logo.png"/>
                                <h1 id="titolo">oL Zone </h1>
                                
                                
                                <div id="menu">
                                    <a id="home"href=home.php>Home</a>
                                    <a id="preferiti" href=champPreferiti.php>Preferiti</a>
                                    <a id="ricercaChamp"href=ricerca.php>Ricerca</a>
                                    <a id="logout"href=logout.php>Logout</a>
                                   
                                        
                                </div>
                            </div>
                        
                            

                        </nav>


                    </header>
                          <div id="contenitorePlaylist">
                    <div id="ricerca_playlist">
                    <h1>Genera delle playlist di spotify suggerite mentre giochi a LoL </h1>
                    <button>Genera playlist</button>
                     </div>
                    <section id="playlist"> </section>
                            </div>

                    <footer>
                     <p>Caruso Antonino 1000016216<br/>A.A. 2022/2023</p>
                    </footer>

                </article>
            </body>
    </html>