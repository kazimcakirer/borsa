<?php
include 'db.php';
function connect($url)
{
    $urlHisse = 'http://bigpara.hurriyet.com.tr/api/v1/borsa/hisseyuzeysel/';
    $content = file_get_contents($urlHisse . $url);
    $content = json_decode($content);
    return $content;
}

function update_share_single()
{
    $hisse = getShareByUpdateSingle();
    if (is_array($hisse)) {
        $hisseAd = json_decode($hisse['share']);

        if (isset($hisseAd->sembol)) {
            $tarih = $hisseAd->tarih;
            $hisseAd = $hisseAd->sembol;
        }
        echo "{$hisseAd} seçildi.<br />";

        $pay = connect($hisseAd);

        if (isset($pay->data)) {
            echo 'bağlandı..<br />';
            $pay = $pay->data->hisseYuzeysel;
            if (isset($pay->sembolid)) {
                if (strtotime($pay->tarih) > strtotime($tarih)) {
                    $id = $pay->sembolid;
                    $pay = cleaning($pay);
                    update($id, $pay);
                    echo 'güncelleniyor..<br />';
                }
            }
        }
    } else {
        die('Tüm hisseler güncel!');
    }
}

function cleaning($share)
{
    $share = (array) $share;
    unset($share["sembolid"]);
    unset($share["yukseK1"]);
    unset($share["yukseK2"]);
    unset($share["dusuK1"]);
    unset($share["dusuK2"]);
    unset($share["kapaniS1"]);
    unset($share["kapaniS2"]);
    unset($share["hacimloT1"]);
    unset($share["hacimloT2"]);
    unset($share["aorT1"]);
    unset($share["aorT2"]);
    unset($share["hacimtL1"]);
    unset($share["hacimtL2"]);
    unset($share["yuzdedegisimS1"]);
    unset($share["yuzdedegisimS2"]);
    return $share;
}

update_share_single();