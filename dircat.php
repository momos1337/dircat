<?php
/* 
    * - DIRECTORY CAT ! -
    * Simple Brute Directory
    * Coded By 4LM05TH3V!L
    * Github : github.com/momos1337
    * Date 24 Februari 2021
    * Made With Love
    * Note : Error all 302,200? Use http://, https://, www
    * [+] Usage : php dircat.php wordlist.txt
*/
system("clear") or system("cls");
error_reporting(0);
function banner(){
  echo "
     |\__/,|   (`\   - DIRECTORY CAT ! -
   _.|o o  |_   ) )  Coded By 4LM05TH3V!L
 -(((---(((--------  Github : github.com/momos1337        
 
 ";
}
banner();
/*Color*/
$cyan = "\e[0;36m";
$red = "\e[31;1m";
$green = "\e[4;32m";
$white = "\e[1;37m";
/*Get URL & LIST */
$url = $argv[1];
$get = $argv[2];
/*Check File */
if ($url == null || $get == null) {
	exit("{$red}[!] {$white}Usage: php dircat.php target.go.id wordlist.txt \n\n");
}
$get = file_get_contents($get);
$path = array_filter(explode("\n", $get));
$loaded = count($path);
$current = 1;
/*Execute*/
echo "[+] Wait...\n";
sleep(6);
echo " [+] Scanning...\n";
sleep(3);
foreach($path as $paths){
    $target = "$url/$paths";
    $ch = curl_init();
    $req = array(CURLOPT_URL => "$url/$paths",
                 CURLOPT_RETURNTRANSFER => "true",
                 CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36",
                 CURLOPT_FOLLOWLOCATION => "true",
                 CURLOPT_TCP_FASTOPEN => "true",
                 CURLOPT_SSL_VERIFYPEER => "false",
                 CURLOPT_SSL_VERIFYHOST => "false"
    );
    curl_setopt_array($ch,$req);
    $res = curl_exec($ch);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $time = date("h:i:s");
    /*Kondisi If Status Code*/
if($httpcode != 0){
    } else 
      die("\n$red [$time] $httpcode - $url - Invalid Domain!\n");
if($httpcode != 200 && $httpcode != 302 && $httpcode != 403 && $httpcode != 500 && $httpcode != 301) { 
      echo "\n$cyan [$time] $httpcode - $url - /$paths";
    } else
echo "\n$green [$time] $httpcode - $url - /$paths";
}
echo "\n$white [+] Done. Have a nice day :)\n";
?>