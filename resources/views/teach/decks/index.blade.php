@extends('layouts.app')
@section('content')
@include('teach.layouts.DashboardNav')
<style>
    .swiper-container {
        width: 98%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        box-shadow: -7px 7px 44px -26px rgba(174, 176, 191, 1);

    }

    .swiper-slide img {
        border: 3px solid #ccc;
        border-bottom: none;
    }

    .card-header,
    .card-footer {
        border: none !important;
    }
</style>
<div class="card m-4  m-auto">
    <div class="card-header">
        <div class="row w-75 mx-auto">
            <div class="col-6">
                <div class="form-group d-flex justify-content-center m-0" style="max-width:250px">
                    <input type="text" class="form-control" name="search" data-remote="true" data-method="get" id="search">
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{route('decks.create')}}" class="btn btn-primary">Create Deck</a>
            </div>
        </div>
    </div>
    <div class="card-body w-75 m-auto">
        {!! $view !!}
    </div>
</div>
@section("scripts")
<script src="{{asset('js/swiper/swiper-bundle.min.js')}}"></script>
<script>
    function swiper() {
        new Swiper('.swiper-container', {
            slidesPerView: 4,
            spaceBetween: 18,
            slidesPerGroup: 2,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                100: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                690: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                1080: {
                    slidesPerView: 4,
                    spaceBetween: 40
                }
            }
        });
    }
    swiper();
    $('#search').bind('ajax:success', function(data, status, xhr, code) {
        $('.alert').remove();
        $('.card-body').html(status);
        swiper();
    })
    $('#search').bind('ajax:beforeSend', function(data, status, xhr, code) {
        $('.card-body').prepend('<div class="alert alert-info">Please Wait while we retrieve your data</div>');
    })
</script>
@endsection
@endsection
