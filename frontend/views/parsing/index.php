<?php
$xml = file_get_contents('http://zaporozhe.zap.olx.ua/elektronika/telefony/mobilnye-telefony/q-iphone-5s/rss/');
$movies = new SimpleXMLElement($xml, LIBXML_NOCDATA);
foreach($movies->channel->item as $item){
//if(strstr($str, 'Цена: 6 500')){
    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);

//    закоментировал, потому что работает пока коряво, нужно доработать регулярку, где из $m[0] только число выталкивается
//    завтра утром буду с этим разбираться
//    if(isset($m[0])){
//        preg_match("/\d/", $m[0], $res);
//    }
//    if(isset($res[0])) {
//        echo 'Заголовок: ' . $item->title . '<br>';
//        echo '' . str_replace(" ", "", $res[0]) . '<br>';
//        echo 'Ссылка: ' . $item->link . '<br> <hr>';
//    }
//}

    if(isset($m[0])) {
        echo 'Заголовок: ' . $item->title . '<br>';
        echo $m[0] . '<br>';
        echo 'Ссылка: ' . $item->link . '<br> <hr>';
    }
}