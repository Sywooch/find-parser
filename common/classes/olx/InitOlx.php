<?php
namespace common\classes\olx;

class InitOlx
{
    public function initOlx(){
        $olxEl = new ElectronikaOlx();
        /*Электроника*/
        $olxEl->saveParseOlxPhone();
        $olxEl->saveParseOlxTV();
        $olxEl->saveParseOlxNout();
        $olxEl->saveParseOlxPlanshet();
        $olxEl->saveParseOlxMediaPlayer();
        $olxEl->saveParseOlxMp3Player();
        $olxEl->saveParseOlxNaushniki();
        $olxEl->saveParseOlxWashers();
        $olxEl->saveParseOlxPilesosi();
        $olxEl->saveParseOlxPliti();
        $olxEl->saveParseOlxMicrowave();
        $olxEl->saveParseOlxFridges();
        $olxEl->saveParseOlxGamesPrst();
        $olxEl->saveParseOlxAksesuari();
        $olxEl->saveParseOlxProchee();
        $olxEl->saveParseOlxKlimat();
        $olxEl->saveParseOlxPhoto();
        $olxEl->saveParseOlxVideo();
        $olxEl->saveParseOlxAksessuaryFotoVideokamer();
        $olxEl->saveParseOlxFotovspyshki();
        $olxEl->saveParseOlxObektivy();
        $olxEl->saveParseOlxShtativyMonopody();
        $olxEl->saveParseOlxSvetofiltry();
        $olxEl->saveParseOlxZaryadnye();
        $olxEl->saveParseOlxSumki();
        /*Недвижимость*/
        NedvizhimostOlx::saveParseOlxNedvizhimost();
        /*Транспорт*/
        AutoOlx::saveParseOlxAuto();
        /*Отдых, спорт*/
        OtdihSportOlx::saveParseOlxOtdihAndSport();
        /*Бизнес, услуги*/
        BiznesOlx::saveParseOlxBiznes();
        /*Работа*/
        RabotaOlx::saveParseOlxWork();
    }
}