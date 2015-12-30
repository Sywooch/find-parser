<?php

namespace common\components;


class apiRequest extends \yii\web\Request {
    public $web;
    public $apiUrl;

    public function getBaseUrl(){
        return str_replace($this->web, "", parent::getBaseUrl()) . $this->apiUrl;
    }


    /*
        If you don't have this function, the admin site will 404 if you leave off
        the trailing slash.

        E.g.:

        Wouldn't work:
        site.com/admin

        Would work:
        site.com/admin/

        Using this function, both will work.
    */
    public function resolvePathInfo(){
        if($this->getUrl() === $this->apiUrl){
            return "";
        }else{
            return parent::resolvePathInfo();
        }
    }
}