<?php namespace common\classes\allo;
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

class AlloParser extends Parser {

    const STORE = 'Allo';
    const PHONE = "(0-800) 300-10";

    public static $map = [
        '1' => [
            'smartphone' => 'http://allo.ua/ru/products/mobile/klass-kommunikator_smartfon/p-1/',
            'mob_phone'  => 'http://allo.ua/ru/products/mobile/klass-mobile_telefon/p-1/'
        ],

        '2' => [
            'noutbuk'  => 'http://allo.ua/ru/products/p-1/',
            'planshet' => 'http://allo.ua/ru/products/internet-planshety/p-1/'
        ],

        '3' => [
            'tv' => 'http://allo.ua/televizory/p-1/'
        ],

        '4' => [
            'washers' => 'http://allo.ua/stiralnye-mashiny/p-1/',
            'pliti' => 'http://allo.ua/plity/p-1/',
            'pilesosi' => 'http://allo.ua/ru/products/pylesosy/p-1/',
            'fridges' => 'http://allo.ua/holodilniki/p-1/'
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
        $products = self::findByDoc($document, '.item');

        echo "founded $products->length elements in $link \n";

        if(!$products->length) {
            return;
        }

        foreach($products as $product) {
            /**
             * @var $product \DOMNode
             */

            $a = self::findByDoc($document, 'a.product-name', $product)->item(0);
            $href = $a ? ($a->getAttribute('href') . "\n") : null;

            try {
                if($href && self::productUnique($href)) {
                    $name = trim(explode('.', $a->textContent)[0]);
                    $name = self::decode(trim(explode('+', $name)[0]));

                    $price = self::findByDoc($document, '.price .sum', $product)->item(0)->textContent;
                    $price = preg_replace('/[^\d]+/', '', $price);

                    $diagonal = self::findByDoc($document, '.attr-container', $product)->item(0)->textContent;
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

        preg_match('/\/p-([\d]+)/', $link, $matchCurrent);
        $current = isset($matchCurrent[1]) ? $matchCurrent[1] : 1;

        self::processLink(preg_replace('/\/p-[\d]+/', '/p-' . ($current + 1), $link), $category_id, $optionType);
    }

}