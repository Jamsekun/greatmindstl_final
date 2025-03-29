@extends('layouts.theme-2')

@section('page-title')
	Representative Information
@endsection

@push('css')
<style type="text/css">
    img#profile-picture {
        border: 3px solid #ffffff;
        -webkit-box-shadow: 0px 0px 13px 0px rgb(0 0 0 / 10%);
        box-shadow: 0px 0px 13px 0px rgb(0 0 0 / 10%);
    }

    .status-active {
        padding: 8px 0;
        background-color: var(--green);
        color: #ffffff;
    }

    .status-inactive {
        padding: 8px 0;
        background-color: var(--red);
        color: #ffffff;
    }
</style>
@endpush

@section('content')
	<!-- inner-page-banner start -->
    <section class="inner-page-banner has_bg_image" data-background="{{ asset('assets/sorteo/img/inner-page-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-page-banner-area">
                        <h1 class="page-title">Representative Information</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-page-banner end -->
    
    @if($model->status == 'Active')
        <div class="status-active">
            <div class="text-center">&nbsp;</div>
        </div>
    @else
        <div class="status-inactive">
            <div class="text-center">&nbsp;</div>
        </div>
    @endif

    <!-- latest-winner-section start -->
    <section class="contact-section border-top overflow-hidden">
        

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="contact-thumb">
                        @if (is_null($model->picture))
                            <img src="{{ asset('assets/image/user/no-user.png') }}" width="500" id="profile-picture" alt="image" >
                        @else
                            <img src="{{ $model->picture }}" width="500" id="profile-picture" alt="image" />
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-header text-center">
                        <h2 class="section-title text-uppercase">{{ $model->full_name }}</h2>
                        @if ($model->status == 'Inactive')
                            <span class="text-danger"><b>(INACTIVE)</b></span>
                        @elseif($model->status == 'Lost ID')
                            <span class="text-danger"><b>(LOST ID/INACTIVE)</b></span>
                        @endif
                        
                        <p>Personal Information</p>
                    </div>
                    <div class="comment-form-wrap">
                        <form class="comment-form">
                            <div class="frm-group">
                                <label>Position:</label>
                                <input type="text" value="{{ $model->position }}" readonly/>
                            </div>
                            <div class="frm-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone No.:</label>
                                        <input type="text" value="{{ $model->phone_number }}" readonly/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Telephone No.:</label>
                                        <input type="text" value="{{ $model->telephone_number }}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="frm-group">
                                <label>Email:</label>
                                <input type="text" value="{{ $model->email }}" readonly/>
                            </div>
                            <div class="frm-group">
                                <label>Address:</label>
                                <textarea readonly>{{ $model->address }}</textarea>
                            </div>
                            <div class="frm-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Station:</label>
                                        <input type="text" value="{{ $model->station }}" readonly/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Field Coordinator:</label>
                                        <input type="text" value="{{ $model->field_coordinator }}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="frm-group">
                                <label>Field Supervisor:</label>
                                <input type="text" value="{{ $model->field_supervisor }}" readonly/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest-winner-section end -->


    <!-- brand-section start -->
    <div class="brand-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-slider">
                        <div class="single-slide">
                            <div class="slide-inner">
                                <img src="{{ asset('assets/image/logo/logo3.png') }}" alt="image" width="80" />
                            </div>
                        </div>
                        <!-- single-slide end -->
                        <div class="single-slide">
                            <div class="slide-inner">
                                <img src="{{ asset('assets/image/logo/logo2.png') }}" alt="image" width="80" />
                            </div>
                        </div>
                        <!-- single-slide end -->
                        <div class="single-slide">
                            <div class="slide-inner">
                                <img src="{{ asset('assets/image/logo/logo1.png') }}" alt="image" width="80" />
                            </div>
                        </div>
                        <!-- single-slide end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-section end -->
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