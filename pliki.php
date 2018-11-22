<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
$details = json_decode ($json);
return $details;
}
$details = ip_details($ipaddress);
$ip=$details -> ip;
    $dbhost="serwer1875919.home.pl"; $dbuser="28879712_chmura"; $dbpassword="admin 1234"; $dbname="28879712_chmura";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$polaczenie) {
            echo "Błąd połączenia z MySQL." . PHP_EOL;
            echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }    
        $idk=$_COOKIE['user'];
        if(IsSet($usr)){
      $query ="SELECT * FROM logs_fail WHERE idu=$idk order by datagodzina desc limit 1";
      $result = mysqli_query($polaczenie, $query); 
      $rekord1 = mysqli_fetch_array($result); 
      }
      ?>
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
<?php
$usr=$_COOKIE['user_n'];
if(IsSet($usr)){
    ?>
<hr>
<p align="center"><a href="wyloguj.php">Wyloguj</a></p>
<hr>
<?php
 echo "Zalogowany jako: <b>",$_COOKIE['user_n'],"</b>";
 ?>
<p><b><font color="red">
<?php
    if(!empty($rekord1)){
    echo "ostatnie niepoprawne logowanie: ",$rekord1['datagodzina']," <hr>";
   
    }
?>
</font></b></p>
<p> Lista plików oraz katalogów</p>
<?php

$dir= "/z7/users/$usr";
$files = scandir($dir);
$arrlength = count($files);
for($x = 2; $x < $arrlength; $x++) {
    
  if (is_file("/z7/users/$usr/$files[$x]")){
    echo "<a href='/z7/users/$usr/$files[$x]' download='$files[$x]'>$files[$x]</a><br>";
  }else{ 
      echo $files[$x],"<br>";
      $dir2= "/z7/users/$usr/$files[$x]";
      $files2 = scandir($dir2);
      $arrlength2 = count($files2);
        for($y = 2; $y < $arrlength2; $y++) {
        
        if (is_file("/z7/users/$usr/$files[$x]/$files2[$y]")){
        echo "&#8594<a href='/z7/users/$usr/$files[$x]/$files2[$y]' download='$files2[$y]'>$files2[$y]</a>";
        }else{ 
            echo "&#8594",$files2[$y];
        }
            echo "<br>";
            }
   }
  }
    echo "<br>";

?>
<hr>
<p>Jeśli chcesz zapisać plik w katalogu, wybierz go!</p>
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data">
<?php
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if(is_dir("/z7/users/$usr/$file") && $file != '.' && $file != '..'){
            echo "<input type=\"radio\" name=\"folder\" value =$file>$file<br>";
            }
        }
        closedir($dh);
    }
}
?>
 <input type="file" name="plik"/>
 <input type="submit" value="Wyślij plik"/>
 </form>
<hr>
<p>Stwórz katalog</p>
<form method="POST" action="tworzenie.php">
        Nazwa:<input type="text" name="n_kat">
        <input type="submit" value="Stwórz"/>
    </form>
    <?php
}else{
echo "<center>Musisz się zalogować!</center>";}
?>
</body>
</html>