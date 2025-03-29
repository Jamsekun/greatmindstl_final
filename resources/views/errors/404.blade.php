@extends('layouts.theme-2')

@section('page-title')
ERROR
@endsection

@section('content')
	<!-- inner-page-banner start -->
    <section class="inner-page-banner has_bg_image" data-background="{{ asset('assets/sorteo/img/inner-page-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-page-banner-area">
                        <h1 class="page-title">Page not found</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-page-banner end -->

    <section class="error-section section-padding">
    	<div class="container">
      		<div class="row justify-content-center">
        		<div class="col-lg-8">
          			<div class="error-content text-center">
            			<img src="{{ asset('assets/sorteo/img/404.png') }}" alt="images">
            			<h3 class="title">Oops... It looks  like you ‘re lost ! </h3>
            			<p>The page you were looking for dosen’t exist.</p>
            			<a href="{{ route('index') }}" class="cmn-btn">GO HOME</a>
         	 		</div>
        		</div>
      		</div>
    	</div>
  	</section>
@endsection