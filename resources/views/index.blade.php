@extends('layouts.theme-2')

@push('css')
<style type="text/css">
/* jssor slider loading skin spin css */
.jssorl-009-spin img {
    animation-name: jssorl-009-spin;
    animation-duration: 1.6s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes jssorl-009-spin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

/*jssor slider bullet skin 132 css*/
.jssorb132 {position:absolute;}
.jssorb132 .i {position:absolute;cursor:pointer;}
.jssorb132 .i .b {fill:#fff;fill-opacity:0.8;stroke:#000;stroke-width:1600;stroke-miterlimit:10;stroke-opacity:0.7;}
.jssorb132 .i:hover .b {fill:#000;fill-opacity:.7;stroke:#fff;stroke-width:2000;stroke-opacity:0.8;}
.jssorb132 .iav .b {fill:#000;stroke:#fff;stroke-width:2400;fill-opacity:0.8;stroke-opacity:1;}
.jssorb132 .i.idn {opacity:0.3;}

.jssora051 {display:block;position:absolute;cursor:pointer;}
.jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
.jssora051:hover {opacity:.8;}
.jssora051.jssora051dn {opacity:.5;}
.jssora051.jssora051ds {opacity:.3;pointer-events:none;}
</style>
@endpush

@section('content')
    <section class="banner-section">
        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1600px; height: 560px; overflow: hidden; visibility: hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; text-align: center; background-color: rgba(0, 0, 0, 0.7);">
                <img style="margin-top: -19px; position: relative; top: 50%; width: 38px; height: 38px;" src="{{ asset('assets/slider/img/spin.svg') }}" />
            </div>
            <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1600px; height: 560px; overflow: hidden;">
                <div style="background-color: #d3890e;">
                    <img data-u="image" data-src="{{ asset('assets/image/stl/IMG_1.jpg') }}" />
                </div>
                <div style="background-color: #d3890e;">
                    <img data-u="image" data-src="{{ asset('assets/image/stl/IMG_2.jpg') }}" />
                </div>
            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb132" style="position: absolute; bottom: 24px; right: 16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                <div data-u="prototype" class="i" style="width: 12px; height: 12px;">
                    <svg viewbox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                    </svg>
                </div>
            </div>
            <!-- Arrow Navigator -->
            <div data-u="arrowleft" class="jssora051" style="width: 55px; height: 55px; top: 0px; left: 25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <svg viewbox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #000; opacity: 0.2;">
                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora051" style="width: 55px; height: 55px; top: 0px; right: 25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewbox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #000; opacity: 0.25;">
                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                </svg>
            </div>
        </div>
    </section>
    <!-- banner-section end -->

    <!-- lottery-timer-section start -->
    <section class="lottery-timer-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5">
                    <div class="timer-content">
                        <h3 class="title">Install Application</h3>
                    </div>
                </div>
                <div class="col-xl-5 text-center">
                    <div class="timer-part">
                        <div class="clock"></div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="link-area text-center">
                        <a href="#0" class="border-btn">LINk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- lottery-timer-section end -->

    <!-- lottery-result-section start -->
    <section class="lottery-result-section section-padding has_bg_image" data-background="assets/images/bg-one.jpg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-header text-center">
                        <h2 class="section-title">Latest Lottery Results</h2>
                        <p>Check your lotto results online, find all the lotto winning numbers and see if you won the latest lotto jackpots!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="lottery-winning-num-part">
                        <div class="lottery-winning-num-table">
                            <h3 class="block-title">lottery winning numbers</h3>
                            <div class="lottery-winning-table">
                                <table id="lottery-winning-table">
                                    <thead>
                                        <tr>
                                            <th class="name">Date</th>
                                            <th class="date">Draw Time</th>
                                            <th class="numbers">winning numbers</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="winner-part">
                        <h3 class="block-title">our winners</h3>
                        <div class="winner-list" id="winner-list">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <a href="#" class="text-btn">see all result</a>
                </div>
            </div>
        </div>
    </section>
    <!-- lottery-result-section end -->
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script src="{{ secure_asset('assets/nifty/js/axios.min.js') }}"></script>
<script src="{{ secure_asset('assets/nifty/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ secure_asset('assets/slider/jssor.slider-28.1.0.min.js') }}"></script>
<script type="text/javascript">
$(function (namespace, $) {
    'use strict';

    var js = function () {
        var o = this;

        $(document).ready(function () {
            o.initialize()
        })
    }

    var p = js.prototype;

    p.initialize = function () {
        this._AxiosSettings();
        this._Results();
        this._Winners();
        this._Count();
        this._SlimScroll();
        this._Jssor();
    }

    p._AxiosSettings = function () {
        axios.defaults.headers.common = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
        };
    }

    p._Results = function () {
        axios({
            method: 'POST',
            url: '{{ route('lottery_results.numbers') }}',
            data: {
                date: moment().format('YYYY-MM-DD')
            }
        }).then(function (response) {
            var data = response.data;

            if(_.isEmpty(data)) {
                $('<tr>', {
                    html: '<td style="text-align: center !important;" colspan="3">No Results</td>'
                }).appendTo($('#lottery-winning-table > tbody'))
            } else {
                _.forEach(data, function (row, key) {
                    var numbers = JSON.parse(row.result);

                    $('<tr>', {
                        html:  '<td>\
                                    <div class="winner-details">\
                                        <span class="winner-name">' + row.date + '</span>\
                                    </div>\
                                </td>\
                                <td>\
                                    <span class="winning-date">' + row.draw_time + '</span>\
                                </td>\
                                <td>\
                                    <ul class="number-list">\
                                        <li>' + numbers[0] + '</li>\
                                        <li class="active">' + numbers[1] + '</li>\
                                    </ul>\
                                </td>'
                    }).appendTo($('#lottery-winning-table > tbody'))
                })
            }
        })
    }

    p._Winners = function () {
        axios({
            method: 'POST',
            url: '{{ route('lottery_results.agents') }}',
            data: {
                date: moment().format('YYYY-MM-DD')
            }
        }).then(function (response) {
            var data = response.data;

            if(!_.isEmpty(data)) {
                 _.forEach(data, function (row, key) {
                    $('<div>', {
                        class: 'winner-single',
                        html:  '<div class="winner-header">\
                                    <span class="name">' + row.full_name + '</span>\
                                </div>\
                                <p>\
                                    <span class="lottery-name">' + row.branch + '</span>\
                                    <span class="date">' + row.date + '</span>\
                                </p>\
                                <h5 class="prize-amount">&#8369; ' + row.amount + '</h5>'
                    }).appendTo($('#winner-list'))
                });
            }
        })
    }

    p._Count = function () {
        axios.all([
            axios.post('{{ route('total_members') }}'), 
            axios.post('{{ route('total_winners') }}')
        ]).then(axios.spread((members, winners) => {
           $('#total-members').text(members.data);
           $('#total-winners').text(winners.data);
        }));
    }

    p._SlimScroll = function () {
        $('.winner-list').slimScroll({
            height: '350px',
            size: '1px',
        });
    }

    p._Jssor = function () {
        var jssor_1_SlideoTransitions = [
            [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
            [{b:0,d:2000,y:30,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
            [{b:500,d:1500,o:1}], 
            [{b:0,d:1000,y:380,e:{y:6}}],
            [{b:300,d:1000,x:80,e:{x:6}}],
            [{b:300,d:1000,x:330,e:{x:6}}],
            [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
            [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
            [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
            [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
        ];

        var jssor_1_options = {
            $AutoPlay: 1,
            $LazyLoading: 1,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 20,
                $SpacingY: 20
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*#region responsive code begin*/

        var MAX_WIDTH = 3000;
            var MAX_HEIGHT = 3000;
            var MAX_BLEEDING = 0.025;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {
                    var originalWidth = jssor_1_slider.$OriginalWidth();
                    var originalHeight = jssor_1_slider.$OriginalHeight();

                    var containerHeight = containerElement.clientHeight || originalHeight;

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                    var expectedHeight = Math.min(MAX_HEIGHT || containerHeight, containerHeight);

                    //constrain bullets, arrows inside slider area, it's optional, remove it if not necessary
                    //if (MAX_BLEEDING >= 0 && MAX_BLEEDING < 1) {
                    //    var widthRatio = expectedWidth / originalWidth;
                    //    var heightRatio = expectedHeight / originalHeight;
                    //    var maxScaleRatio = Math.max(widthRatio, heightRatio);
                    //    var minScaleRatio = Math.min(widthRatio, heightRatio);

                    //    maxScaleRatio = Math.min(maxScaleRatio / minScaleRatio, 1 / (1 - MAX_BLEEDING)) * minScaleRatio;
                    //    expectedWidth = Math.min(expectedWidth, originalWidth * maxScaleRatio);
                    //    expectedHeight = Math.min(expectedHeight, originalHeight * maxScaleRatio);
                    //}

                    //scale the slider to expected size
                    jssor_1_slider.$ScaleSize(expectedWidth, expectedHeight, MAX_BLEEDING);

                    //position slider at center in vertical orientation
                    jssor_1_slider.$Elmt.style.top = ((containerHeight - expectedHeight) / 2) + "px";

                    //position slider at center in horizontal orientation
                    jssor_1_slider.$Elmt.style.left = ((containerWidth - expectedWidth) / 2) + "px";
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            function OnOrientationChange() {
                ScaleSlider();
                window.setTimeout(ScaleSlider, 800);
            }

        ScaleSlider();

        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        /*#endregion responsive code end*/
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush