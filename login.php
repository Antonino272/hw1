<?php
session_start();
//verifica esistenza di una  sessione

if(isset($_SESSION['username'])){

    //se esiste, vai alla home
    header("Location: home.php");
    exit;
}

// controllo  l'esistenza di dati post

if(!empty($_POST["user"]) && !empty($_POST["password"]) ){

//connetto il database
$conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());

//escape dei dati input
$username=mysqli_real_escape_string($conn,$_POST["user"]);

$password=mysqli_real_escape_string($conn,$_POST["password"]);

//cerca utenti con quelle credenziali
$query="SELECT userId,pass from utenti where userId='".$username."'";

$res=mysqli_query($conn,$query)or die(mysqli_error($conn));

//verifica correttezza delle credenziali
if(mysqli_num_rows($res)>0){

    $entry=mysqli_fetch_assoc($res);

    if(password_verify($_POST['password'],$entry['pass']) && $_POST['user']==$entry['userId']){

        $_SESSION["username"]=$_POST["user"];
        header("Location: home.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;

    }else{
        $errore=true;
    }

}
else{
    $errore=true;
}

}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <script src="loginJs.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="loginCss.css"/>
        
</head>

<body>
        
        <section> 
            
                <h1>LOGIN</h1>
                <form id="form" name="login" method="post" >


                
                

                    <label>Username: <input type='text' name='user'></label>
                    

                    <label>Password:<input type='password' name='password'></label>

                    

                    <label id="ricerca"> <input  id="submit"type='submit' value="Login"></label>

                <div id=errore>

                <?php 
                    if(isset($errore))
                        echo "<h1>Credenziali errate</h1>";
                    
                ?>
            </div>
                
                </form>
            <a href=registrazione.php>Registrati qui</a>
                

        </section>



    </body>

    </html>   