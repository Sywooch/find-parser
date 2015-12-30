<?php namespace common\classes\foxmart;
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

class FoxmartParser extends Parser {

    const STORE = 'FoxMart';
    const PHONE = '(044) 202-15-51';

    public static $map = [
        '1' => [
            'smartphone' => 'http://foxmart.ua/smartfony.html',
            'mob_phone'  => 'http://foxmart.ua/mobilnye%20telefony.html'
        ],

        '2' => [
            'noutbuk'  => 'http://foxmart.ua/noutbuk.html',
            'planshet' => 'http://foxmart.ua/internet-planshety.html'
        ],

        '3' => [
            'tv' => 'http://foxmart.ua/televizory.html'
        ],

        '4' => [
            'washers' => 'http://foxmart.ua/stiralnye%20mashiny.html',
            'pliti' => 'http://foxmart.ua/plity.html',
            'pilesosi' => 'http://foxmart.ua/pylesosy.html',
            'fridges' => 'http://foxmart.ua/holodilniki/1.html'
        ]
    ];


    public static function parse() {
        set_time_limit(0);
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
        self::logFile('file.log', $page);
        $products = self::findByDoc($document, '.item');

        echo "founded $products->length elements in $link \n";

        if(!$products->length) {
            return;
        }

        foreach($products as $product) {
            /**
             * @var $product \DOMNode
             */

            $a = self::findByDoc($document, 'h4 a', $product)->item(0);
            $href =  $a ? ($a->getAttribute('href') . "\n") : null;

            try {
                if($href && self::productUnique('http://foxmart.ua' . $href)) {
                    $name = trim(explode('.', $a->textContent)[0]);
                    $name = self::decode(trim(explode('+', $name)[0]));

                    $price = self::findByDoc($document, '.price_prod', $product)->item(0)->textContent;
                    $price = preg_replace('/[^\d]+/', '', $price);

                    $diagonal = self::findByDoc($document, '.product_view', $product)->item(0)->textContent;
                    preg_match('/����: ([\d\.]+)/', $diagonal, $matchesDia);

                    $product = new Items();
                    $product->url            = 'http://foxmart.ua' . $href;
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
            } catch (\Exception $e) {
                echo $e->getTraceAsString();
            }
        }


        if(preg_match('/\/([\d]+).html/', $link, $matchCurrent)) {
            $current = $matchCurrent[1];
            self::processLink(preg_replace('/\/[\d]+.html/', '/' . ($current + 1) . '.html', $link), $category_id, $optionType);
        } else {
            self::processLink(preg_replace('/.html/', '/2.html', $link), $category_id, $optionType);
        }
    }

}