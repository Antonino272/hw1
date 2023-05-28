<?php
  session_start();
     $errore=false;
   // verifica che le caselle del form non sono vuote
     if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["email"] && !empty($_POST["IDuser"])) && !empty($_POST["password"])&& !empty($_POST["ConfermaPassword"])){

     $conn=mysqli_connect("localhost","root","","utenti") or die(mysqli_connect_error());
   // cerchiamo su nome,cognome,iduser cio che è indicato come primo parametro di "preg_match", se non è cosi da errore
     if(!preg_match('/^[a-zA-Z ]*$/', $_POST['nome'])){
        $errore=true;
      }

     if(!preg_match('/^[a-zA-Z ]*$/', $_POST['cognome'])){ 
        $errore=true;
     }

    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['IDuser'])){ //
        $errore=true;
     }
   
    else{
    // se non entra negli if di verifica precedenti, controlliamo che non esista un utente con lo stesso userid

    $usernameID= mysqli_real_escape_string($conn,$_POST["IDuser"]);
    $query="SELECT userID FROM utenti where userID='".$usernameID."'";
    $res=mysqli_query($conn,$query);
    $num_rows=mysqli_num_rows($res);
    if($num_rows>0){
        $errore=true;
    }
    }
    //controllo che password e controlla password sono uguali e pass>8 caratteri
    if(strlen($_POST["password"])<8){
        $errore=true;
    }
    if(strcmp($_POST["password"],$_POST["ConfermaPassword"])!=0){
        $errore=true;
    }
    //controllo sull'email 
    if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        $errore=true;
        echo( "email non valida");
    }
    else{
        //controllo che l'email inserita non è gia registrata nel db

        //strtolower fa si che le lettere siano tutte minuscole

        $email= mysqli_real_escape_string($conn,strtoLower($_POST["email"]));

        $query="SELECT email FROM utenti where email='".$email."'";
        $res=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($res);

        if($num_rows>0){
            $errore=true;
        }
    }
    // se non vi è alcun errore dai controlli precedenti, avviene la registrazione nel db

    if( $errore==false){
                    
        $nome= mysqli_real_escape_string($conn,$_POST["nome"]);
        $cognome= mysqli_real_escape_string($conn,$_POST["cognome"]);
        $password= mysqli_real_escape_string($conn,$_POST["password"]);
        $password=password_hash($password,PASSWORD_BCRYPT);
        $email= mysqli_real_escape_string($conn,$_POST["email"]);
        $query="INSERT INTO  utenti values('".$nome."','".$cognome."','".$email."','".$usernameID."','".$password."')";
        if(mysqli_query($conn,$query)){
            $_SESSION['username']=$usernameID;
            header('Location:home.php');
            
            mysqli_close($conn);
            exit;
        }
    }

   }
     

?>



<!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
        <script src="registrazioneJs.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="loginCss.css"/>


    </head>

    <body>

        <section>
        
            <h1>Inserisci i tuoi dati:</h1>
            <form id="form" name="registrazione" method="post" >

                <label id="labelNome">Nome <input id="inputNome" type='text' name='nome'></label><div id="erroreNome"></div>

                <label >Cognome <input id="inputCognome"  type='text' name='cognome'></label><div id="erroreCognome"></div>

                <label>email <input id="inputEmail"type='text' name='email'></label><div id="erroreEmail"></div>

                <label >userID <input id="inputID" type='text' name='IDuser'></label><div id="erroreUser"></div>

                <label>Password <input id="inputPassword" type='password' name='password'></label><div id="errorePassword"></div>

                <label>Conferma Password <input id="inputConfermaPass"type='password' name='ConfermaPassword'></label><div id="erroreConferma"></div>


                <label id="ricerca">&nbsp;<input  id="submit"type='submit' value="Registrati"></label>
                
            
            </form>
            <a href="login.php">Torna al login</a>
            
        </section>

    

    </body>

 

</html>    




















