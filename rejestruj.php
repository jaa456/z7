<html>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
     <title>Bożejewicz</title>
</head>

<body>
<center>
    <p><b>Programowanie aplikacji sieciowych - zadanie 7</b></p>
</center>
<p align=right><a href="../index.html">Strona główna</a></p>
<p align=right><a href="index.php">Zadanie 7</a></p>
<hr>
<p align="center"><a href="index.php">Zaloguj się</a></p>
<hr>
<center>
<form method="POST">
<p>Rejestracja</p>
<p>Podaj swoj login:</p>
<input type="text" name="nick" maxlength="25" size="25"><br>
<p>Podaj hasło:</p>
<input type="password" name="haslo" maxlength="25" size="25"><br>
<p>Powtórz hasło:</p>
<input type="password" name="haslo1" maxlength="25" size="25"><br><br>

<input type="submit" value="Rejestruj"/>
</form>
</center>
<?php
    $dbhost="serwer1875919.home.pl"; $dbuser="28879712_chmura"; $dbpassword="admin 1234"; $dbname="28879712_chmura";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$polaczenie) {
            echo "Błąd połączenia z MySQL." . PHP_EOL;
            echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }    
if (IsSet($_POST['nick'])) {
    if($_POST['haslo'] == $_POST['haslo1']){
    $n=$_POST['nick'];
    $h=$_POST['haslo'];
    $dodaj="INSERT INTO users VALUES (NULL,'$n', '$h')";
    mysqli_query($polaczenie, $dodaj);
    mysqli_close($polaczenie);
    mkdir ("users/$n", 0777);
    echo "<script>alert('Poprawnie dodano użytkownika')</script>";
  // echo $dodaj;
    }else {
         echo "<script>alert('Hasła muszą byś takie same!')</script>";
        }
}
?>
<hr>
</body>
</html>
</html>




