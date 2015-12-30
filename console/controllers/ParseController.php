<?php namespace console\controllers;

use common\classes\allo\AlloParser;
use common\classes\foxmart\FoxmartParser;
use common\classes\rozetka\RozetkaParser;
use yii\console\Controller;

class ParseController extends Controller{

    public function actionIndex() {
         FoxmartParser::parse();
         AlloParser::parse();
         RozetkaParser::parse();
    }

}