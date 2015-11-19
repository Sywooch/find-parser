<?php
$xml = file_get_contents('http://zaporozhe.zap.olx.ua/elektronika/telefony/mobilnye-telefony/q-iphone-5s/rss/');
$movies = new SimpleXMLElement($xml, LIBXML_NOCDATA);
foreach($movies->channel->item as $item){
//if(strstr($str, 'Цена: 6 500'))
    preg_match("/Цена:\s\d(.*?)\sгрн/", $item->description, $m);
    if(isset($m[0])){
        preg_match_all("/\d/", str_replace(" ", "", $m[0]), $prices);
        foreach($prices as $price) {
//            $data['title'] = $item->title;
//            $data['price'] = implode('', $price);
//            $data['link'] = $item->link;
            echo 'Заголовок: ' . $item->title . '<br>';
            echo 'Цена: ' . implode('', $price) . '<br>';
            echo 'Ссылка: ' . $item->link . '<br> <hr>';

        }
//        print_r($data);
    }
}