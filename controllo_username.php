<?php 

    header('Content-Type: application/json');
    $conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());
    $usernameID= mysqli_real_escape_string($conn,$_GET["q"]);
    //query nel db che mi torna delle righe se trova un username uguale a quello inserito dall'utente
    $query= "SELECT userID FROM utenti where userID='".$usernameID."'";
    $res=mysqli_query($conn,$query);
    $num_rows=mysqli_num_rows($res);

    //se lo trova, darà almeno una riga  e imposta presente su true, altrimenti su falso
    if($num_rows>0){
        $presente=array('presente'=>true);
        echo json_encode($presente);
    }else{
        $presente=array('presente'=>false);
        echo json_encode($presente);
    }
    mysqli_close($conn);
    
?>
