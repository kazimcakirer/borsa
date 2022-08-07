<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json;charset=utf-8");

require 'db.php';



function get($par)
{
    return htmlspecialchars(trim($_GET[$par]));
}

/* Zaman aralığını "interval" diye bir dizi içerisinde tutuluyor */
function getInterval($par)
{
    /* İstenilen değerin indesi geri döndürülüyor */
    /*
        Karşılık olarak;
        0 => "Haftalık",
        1 => "1 Aylık",
        2 => "3 Aylık",
        3 => "6 Aylık",
        4 => "12 Aylık"
    */
    return $GLOBALS['interval'][$par];
}

$oran = get('oran');
$aralik = get('aralik');

if ($oran === "*" || $oran === 0) {
    $oran = 0.6;
}

if ($aralik === "*") {
    $aralik = getInterval(4);
}


$s = [];

foreach (getShare() as $share) {
    $contentShare = json_decode($share['share']);

    $e =  $contentShare->yilyuksek * $oran;

    if ($contentShare->kapanis < $e) {
       
        $hisse = '<a href="https://tr.tradingview.com/symbols/BIST-' . $contentShare->sembol . '" target="_blank">' . $contentShare->sembol . '</a>';
        $s[] = [
            $hisse,
            $contentShare->haftadusuk,
            $contentShare->haftayuksek,
            $contentShare->aydusuk,
            $contentShare->ayyuksek,
            $contentShare->yildusuk,
            $contentShare->kapanis,
            $contentShare->yilyuksek,
            number_format($contentShare->hacimlot, 0, '.', '.'),
            number_format($contentShare->hacimtl, 0, '.', '.'),
            $contentShare->yuzdedegisim
        ];
    }
}
echo json_encode($s);
