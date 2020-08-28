<?php

system('clear');
$vd = "1";
$red="\033[1;31m";
$green="\033[1;32m";
$yellow="\033[1;33m";
$xanhduong="\033[1;34m";
$tim = "\033[1;35m";
$xanh="\033[1;36m";
$trang="\033[1;37m";
echo $yellow."<===================================================>\n";
echo $red."                  YOUTUBER: ";
echo $green."KHANGGAMER\n";
echo $yellow."<===================================================>\n";
echo $tim."             TOOL CHUCKY FREE BY KHANG \n";
echo $green."Bạn Có Muốn Nhập Dữ Liệu
1. Có
2. Không
==> ";
$go = trim(fgets(STDIN));

if($go == "1"){
echo $yellow."Nhập Device: ".$trang;
$dev = trim(fgets(STDIN));
echo $yellow."Nhập Customer: ".$trang;
$cus = trim(fgets(STDIN));
echo $yellow."Nhập Requestkey: ".$trang;
$re = trim(fgets(STDIN));

$k = fopen("cfg.php","w+");
fwrite($k, "<?php
");
fwrite($k, "$");
fwrite($k, "dev = '$dev';
");
fwrite($k, "$");
fwrite($k, "cus = '$cus';
");
fwrite($k, "$");
fwrite($k, "re = '$re';
");

fwrite($k, "?>");
fclose($k);
}

include("cfg.php");
while(true){
$url = "https://giftapp-prod.askchuck.co/wp-json/gifts/v2/spin_result";

$data = '{"won_coins":"5000","spinner_key":"spinner_3","start":"false"}';

$mr = curl_init();
curl_setopt_array($mr, array(
  CURLOPT_PORT => "443",
  CURLOPT_URL => "$url",
  CURLOPT_ENCODING => "",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
"device:$dev",
"customer:$cus",
"requestkey:$re",
"Content-Type:application/json; charset=UTF-8",
"Host:giftapp-prod.askchuck.co"
)));
$mr2 = curl_exec($mr); curl_close($mr);
$json = json_decode($mr2,true);
$coin = $json["data"]["user_coins"];
$spin = $json["data"]["spin_result"];
$qc = $json["data"]["is_need_to_show_ad"];
if($qc == false){
$qcc = $red."Không Có Quảng Cáo";
}
if($qc == true){
$qcc = $green."Đã Xem Quảng Cáo";
}

if($spin >= "1"){
echo $green."[Ask]".$trang." =>".$yellow." $coin ".$trang."| $qcc \n";
}else{

echo $xanh."Max Ngày Hôm Nay \n";
exit;
}

if($coin >= "15500"){
$url = "https://giftapp-prod.askchuck.co/wp-json/gifts/v1/watched_an_30_sec_advertisement";

$mr = curl_init();
curl_setopt_array($mr, array(
  CURLOPT_PORT => "443",
  CURLOPT_URL => "$url",
  CURLOPT_ENCODING => "",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_CUSTOMREQUEST => "POST",
//  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
"device:$dev",
"customer:$cus",
"requestkey:$re",
"Host:giftapp-prod.askchuck.co",
"content-type:application/json; charset=UTF-8"
)));
$mr2 = curl_exec($mr); curl_close($mr);
$json = json_decode($mr2,true);
echo $xanh."Đã Max Coin \n";
}


}
