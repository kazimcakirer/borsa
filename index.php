<?php
ob_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Pay Takip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="assets/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div class="me-main-wraper">
        <!-- main header -->
        <div class="me-main-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-7">
                        <div class="me-logo">
                            <a href="#">Pay<span>Takip</span></a>
                        </div>
                    </div>
                    <div class="col-sm-9 col-5">
                        <div class="me-menu">
                            <ul>
                                <li class="me-menu-children">
                                    <a href="#" class="me-active-menu">Hisse</a>
                                </li>
                                <li><a href="#">Notlar</a></li>
                            </ul>
                            <div class="me-toggle-nav">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rate -->
        <div id="me-rate">
            <p>
                <span>EUR/USD -0.54559%</span>
                <span>GBP/USD -0.44243%</span>
                <span>USD/CHF +0.15403%</span>
                <span>USD/CAD +0.03873%</span>
                <span>EUR/JPY -0.66775%</span>
            </p>
        </div>
        <div class="container mb-3">
            <div class="row mb-3 ">
                <div class="col-md-12 ">
                    <p class="my-3">Güncellenmeyen {test} veri var!</p>
                    <form>
                        <div class="form-row">
                            <div class="col-md-6 ">
                                <label for="oran">Oran </label>
                                <input type="number" class="form-control" id="oran" placeholder="0.6">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="aralik">Zaman Aralığı </label>
                                <select class="custom-select" id="aralik">
                                    <option selected disabled value="">Seçiniz...</option>
                                    <option value="0">Haftalık</option>
                                    <option value="1">1 Aylık</option>
                                    <option value="2">3 Aylık</option>
                                    <option value="3">6 Aylık</option>
                                    <option value="4">12 Aylık</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 my-3 mb-3">

                    <table id="list" class="table ">
                        <thead>
                            <tr>
                                <th id="sembol">sembol</th>
                                <th id="haftadusuk">haftadusuk</th>
                                <th id="haftayuksek">haftayuksek</th>
                                <th id="aydusuk">aydusuk</th>
                                <th id="ayyuksek">ayyuksek</th>
                                <th id="yildusuk">yildusuk</th>
                                <th id="kapanis">kapanis</th>
                                <th id="yilyuksek">yilyuksek</th>
                                <th id="hacimlot">hacimlot</th>
                                <th id="hacimtl">hacimtl</th>
                                <th id="yuzdedegisim">yuzdedegisim</th>
                                <th id="islem">İşlem</th>
                            </tr>
                        </thead>
                        <tbody id="hisse">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script>
        $(() => {
            const bot = "<?= $bot ?>"
            let url = "<?= $api ?>"
            let share = "";
            let param = {
                oran: "*",
                aralik: "*"
            };

            $("#oran").on("focusout", (e) => {
                param.oran = $("#oran").val();
                api()
            })
            $("#aralik").on("change", (e) => {
                param.aralik = $("#aralik").val().toString()
                api()
            })

            const api = () => {

                par = `?oran=${param.oran}&aralik=${param?.aralik}`;
                share = "";
                $.get(url + par, function(data, status) {
                    $('#hisse').remove()
                    $("#list").append('<tbody id="hisse"></tbody>')
                    data.forEach(element => {
                        share += "<tr>";
                        element.forEach((item) => {
                            share += `<td>${item}</td>`;
                        })
                        share += `<td><button onclick="$(this).parent().parent().remove()">Sil</button></td>`
                        share += "</tr>";
                    });
                    $("#hisse").html(share);
                })
            }


            setInterval(() => {
                $.get(bot, function(data, status) {})
            }, 5000)

            api()
        });
    </script>
</body>

</html>