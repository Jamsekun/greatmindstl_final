@extends('layouts.theme-2')

@section('title')
 | About Us
@endsection

@section('page-title')
ABOUT US
@endsection

@section('content')
	<!-- inner-page-banner start -->
    <section class="inner-page-banner has_bg_image" data-background="{{ asset('assets/sorteo/img/inner-page-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-page-banner-area">
                        <h1 class="page-title">About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-page-banner end -->

    <!-- about-section start -->
    <section class="about-section section-padding">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-xl-5 p-xl-0">
                   	<img src="{{ asset('assets/image/stl/black.gif') }}" alt="image" />
                </div>
                <div class="col-xl-6 p-xl-0">
                    <div class="content">
                        <h2 class="title">COMPANY PROFILE</h2>
                        <h4>CORPORATE BACKGROUND</h4>
                        <h6>ABOUT THE COMPANY</h6>

                        <p>
                        	The stockholders are 5 individuals who are involved in their own diverse field of expertise but bound together to achieved and attain a common goal of seeing a reformed community whose lives have been dependent on illegal activities
                        </p>
                        <p>
							Great Mind Games and Amusement Corporation is a financially sound corporation located in Km. 25 Lolomboy, Bocaue, Bulacan.
						</p>
						<p>
							The Great Mind president decided to amend and regroup itself with the set of people who are not only knowledgeable in running a business but who are all likewise financially sound to support, sustain and withstand the challenges and obstacles of running a Small-Town Lottery.
						</p>
						<p>
							Though its personality has changed, the objective of engaging in fair play and alleviating poverty in assisting the lives of many residents has remain its primodal purpose.
                        </p>	
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- choose-us-section start -->
    <section class="choose-us-section section-padding border-top border-bottom has_bg_image" data-background="{{ asset('assets/sorteo/img/inner-page-banner.jpg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title">Mission</h2>
                        <p>
                            <i>“to envision and experience responsible and legal gaming through the Small-Town Lottery of PCSO.”</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="choose-us-section section-padding border-top border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title">Vision</h2>
                        <p>
                        	To the Industry: <br>
							To increase the opportunity by creating jobs for the community.
						</p>
						<p>
							To Our Clientele: <br>
							To offer enjoyment and give them peace of mind by delivering to them fair returns.
						</p>
						<p>	
							To Our People: <br>
							To give them support to improve their capabilities holistically to achieve their full potential.
						</p>
						<p>
							To our partners: <br>
							To assure them of satisfactory earnings.
                        </p>		
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- choose-us-section end -->
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script src="{{ secure_asset('assets/nifty/js/axios.min.js') }}"></script>
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
                                        <span class="winner-name">' + row.schedule + '</span>\
                                    </div>\
                                </td>\
                                <td>\
                                    <span class="winning-date">' + row.date + '</span>\
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

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush