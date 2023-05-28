<?php
session_start();

if (!isset($_SESSION['username'])) {
   header("Location: login.php");
   exit;
}

header('Content-Type: application/json');
$conn = mysqli_connect("localhost", "root", "", "utenti") or die(mysqli_connect_error());
$username = $_SESSION['username'];

$file = "./campioni.json";
$end_point = file_get_contents($file);

$json = json_decode($end_point, true);

$nuovoJson = array();

for ($i = 0; $i < count($json["results"]); $i++) {
   $pref = false;
   $nome = $json['results'][$i]['name'];

   $query = "SELECT * FROM preferiti WHERE binary userID = ? AND titolo = ?";
   $stmt = mysqli_prepare($conn, $query);
   mysqli_stmt_bind_param($stmt, "ss", $username, $nome);
   mysqli_stmt_execute($stmt);
   $res = mysqli_stmt_get_result($stmt);

   if (mysqli_num_rows($res) > 0) {
      $pref = true;
   } else {
      $pref = false;
   }

   $nuovoJson[] = array(
      "Nome" => $nome,
      "Titolo" => $json['results'][$i]['title'],
      "Copertina" => $json['results'][$i]['image'],
      "preferiti" => $pref
   );
}

echo json_encode($nuovoJson);
?>
