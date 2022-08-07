<?php

## Require
require 'db.php';


function out_of_date_count()
{
    return query("SELECT COUNT(id) as total FROM hisse WHERE update_share=false")['total'];
}

//kullanılmıyor ama örnekler var.
function hisse()
{
    $hisse = getShare();
    $hisseList = [];
    foreach ($hisse as $value) {
        $contentHisse = json_decode($value['share']);
        if (isset($contentHisse->sembol)) {
            // $ort = ((($contentHisse->yilyuksek + $contentHisse->yildusuk) / 2) + $contentHisse->yildusuk) / 2;
            if ($contentHisse->kapanis < $contentHisse->yilortalama) {
                $hisseList[] = '<tr>
                <td><a  href="https://tr.tradingview.com/symbols/BIST-' . $contentHisse->sembol  . '"  target="_blank" />' . $contentHisse->sembol . '</a></td>
                <td>' . $contentHisse->kapanis . '</td>
                <td>' . '  (' . $contentHisse->dusuk . ' - ' . $contentHisse->yuksek . ')' . '</td>
                <td>' . $contentHisse->haftadusuk . '</td>
                <td>' . $contentHisse->haftayuksek . '</td>                            
                <td>' . $contentHisse->aydusuk . '</td>
                <td>' . $contentHisse->ayyuksek . '</td>                            
                <td>' . $contentHisse->yildusuk . '</td>
                <td>' . $contentHisse->yilyuksek . '</td>
                <td>' . number_format($contentHisse->hacimlot) . '</td>
                <td>' . number_format($contentHisse->hacimtl) . '</td>
                <td>' . $contentHisse->yuzdedegisim . '</td>
            </tr>';
            }
        }
    }
    return  $hisseList;
}

function update_share_date()
{
    $hisse = getShareByUpdateSingle();
    if (!is_null($hisse)) {
        $hisse = json_decode($hisse['share']);
        if (time() > strtotime($hisse->tarih)) {
            // To Do => buraya tarih bilgisi güncel olmayan hisse senedinin güncellenmesi yapılacak!
        }
    }
}