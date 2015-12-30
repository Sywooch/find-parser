<?php namespace common\classes\rozetka;
/**
 * Created by PhpStorm.
 * User: canary
 * Date: 17.12.2015
 * Time: 20:57
 */

use common\classes\Parser;
use common\models\Items;
use Symfony\Component\CssSelector\CssSelectorConverter;
use yii\helpers\HtmlPurifier;

class RozetkaParser extends Parser {

    const STORE = 'Rozetka';
    const PHONE = '0 800 503-808';

    public static $map = [
        '1' => [
            'smartphone' => 'http://rozetka.com.ua/mobile-phones/c80003/filter/page=1;preset=smartfon/',
            'mob_phone'  => 'http://rozetka.com.ua/mobile-phones/c80003/filter/page=1;preset=mob-phones/'
        ],

        '2' => [
            'noutbuk'  => 'http://rozetka.com.ua/notebooks/c80004/filter/page=1/',
            'planshet' => 'http://rozetka.com.ua/tablets/c130309/filter/page=1/'
        ],

        '3' => [
            'tv' => 'http://rozetka.com.ua/all-tv/c80037/page=1/'
        ],

        '4' => [
            'washers' => 'http://bt.rozetka.com.ua/washing_machines/c80124/filter/page=1/',
            'pliti' => 'http://bt.rozetka.com.ua/cookers/c80122/filter/page=1/',
            'pilesosi' => 'http://bt.rozetka.com.ua/vacuum_cleaners/c80158/filter/page=1/',
            'fridges' => 'http://bt.rozetka.com.ua/refrigerators/c80125/filter/page=1/'
        ]
    ];


    public static function parse() {

        foreach(self::$map as $category_id => $links) {
            echo "process category $category_id \n";

            foreach($links as $optionType => $link) {
                self::processLink($link, $category_id, $optionType);
            }
        }

    }

    public static function processLink($link, $category_id, $optionType) {

        $page = self::getPage($link);

        $document = new \DOMDocument();
        try {
            $document->loadHTML($page);
        } catch(\Exception $e) {
            return;
        }
        $products = self::findByDoc($document, '.g-i-tile-catalog');

        if(!$products->length) {
            return;
        }

        echo "founded $products->length elements in $link \n";
        foreach($products as $product) {
            /**
             * @var $product \DOMNode
             */

            $a = self::findByDoc($document, '.g-i-tile-i-title a', $product)->item(0);
            $href = $a ? ($a->getAttribute('href') . "\n") : null;

            try {
                if($href && self::productUnique($href)) {
                    $name = trim(explode('.', $a->textContent)[0]);
                    $name = trim(explode('+', $name)[0]);

                    $price = self::findByDoc($document, '.g-price-uah', $product)->item(0)->textContent;
                    $price = preg_replace('/[^\d]+/', '', $price);

                    $diagonal = self::findByDoc($document, '.g-i-tile-short-detail', $product)->item(0)->textContent;
                    preg_match('/([\d\.]+)"/', $diagonal, $matchesDia);

                    $product = new Items();
                    $product->url            = $href;
                    $product->store          = self::STORE;
                    $product->price          = $price;
                    $product->product        = $name;
                    $product->phone          = self::PHONE;
                    $product->subcategory_id = $category_id;
//                    $product->options        = '{' .
//                        '"type": "' . $optionType . '",' .
//                        (isset($matchesDia[1]) ? ('"display": "'. $matchesDia[1] .'"') : '' ) .
//                    '}';
                    $product->options = json_encode(array_merge(
                        [
                            'type' => $optionType
                        ],
                        (isset($matchesDia[1]) ?
                            ['display' => $matchesDia[1]]
                            : []
                        )
                    ));
                    $product->save();
                }
            } catch (\Exception $e) {}
        }

        preg_match('/page=([\d]+)/', $link, $matchCurrent);
        $current = isset($matchCurrent[1]) ? $matchCurrent[1] : 1;

        self::processLink(preg_replace('/page=[\d]+/', 'page=' . ($current + 1), $link), $category_id, $optionType);
    }

}