<?php
$xml = file_get_contents('http://zaporozhe.zap.olx.ua/elektronika/telefony/mobilnye-telefony/q-iphone-5s/rss/');
$movies = new SimpleXMLElement($xml, LIBXML_NOCDATA);
foreach($movies->channel->item as $item){
    $str = $item->description;
//if(strstr($str, 'Этажность дома: 2') and strstr($str, 'Этаж: 2')){
    preg_match('#<a.*?>(.*)</a>#is', $str, $m);
    echo $str . '<br> <hr>';
//}
}
?>