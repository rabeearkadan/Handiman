@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/employee-profile/reviews/review-cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/reviews/review-modal.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/reviews/see-all-reviews.css')}}" rel="stylesheet">
@endpush
@section('content')
    <section class="l-content-width section">
        <h1 class="section__headline see-all-header">
            <a href="" class="see-all-header__link link">
                employee Name
            </a>
            <span class="see-all-header__title">
                Ratings and Reviews
            </span>
        </h1>
        <div class="we-customer-ratings lockup ember-view">
            <div class="l-row">
                <div class="we-customer-ratings__stats l-column small-4 medium-6 large-4">
                    <div class="we-customer-ratings__averages"><span
                            class="we-customer-ratings__averages__display">N.M</span> out of 5
                    </div>
                    <div class="we-customer-ratings__count small-hide medium-show">N.M Ratings</div>
                </div>
                <div class=" l-column small-8 medium-6 large-4">
                    <figure class="we-star-bar-graph">
                        <div class="we-star-bar-graph__row">
                            <span class="we-star-bar-graph__stars we-star-bar-graph__stars--5"></span>
                            <div class="we-star-bar-graph__bar">
                                <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="we-star-bar-graph__row">
                            <span class="we-star-bar-graph__stars we-star-bar-graph__stars--4"></span>
                            <div class="we-star-bar-graph__bar">
                                <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="we-star-bar-graph__row">
                            <span class="we-star-bar-graph__stars we-star-bar-graph__stars--3"></span>
                            <div class="we-star-bar-graph__bar">
                                <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="we-star-bar-graph__row">
                            <span class="we-star-bar-graph__stars we-star-bar-graph__stars--2"></span>
                            <div class="we-star-bar-graph__bar">
                                <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="we-star-bar-graph__row">
                            <span class="we-star-bar-graph__stars "></span>
                            <div class="we-star-bar-graph__bar">
                                <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                    </figure>
                    <p class="we-customer-ratings__count medium-hide">N.M Ratings</p>
                </div>
            </div>
        </div>
        <!-- all reviews -->
        <div class="l-row">
            <!-- review -->
            <div
                class="ember-view l-column--grid l-column small-12 medium-6 large-4 small-valign-top l-column--equal-height">
                <div class="we-customer-review lockup ember-view">
                    <figure aria-label="1 out of 5"
                            class="we-star-rating ember-view we-customer-review__rating we-star-rating--large">
                        <span class="we-star-rating-stars-outlines">
                            <span class="we-star-rating-stars we-star-rating-stars-1"></span>
                        </span>
                    </figure>
                    <div class="we-customer-review__header we-customer-review__header--user">
                        <span class="we-truncate we-truncate--single-line ember-view we-customer-review__user">
                            Client Name
                        </span>
                        <span class="we-customer-review__separator">, </span>
                        <time aria-label="Month 0, 2020" class="we-customer-review__date">
                            00/00/2020
                        </time>
                    </div>
                    <h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">
                        title
                    </h3>
                    <blockquote
                        class="we-truncate we-truncate--multi-line we-truncate--interactive we-truncate--truncated ember-view we-customer-review__body">
                        <div class="we-clamp ember-view">
                            <p>Review  </p>
                            <br>
                        </div>
                        <button class="we-truncate__button link">
                            more
                        </button>
                    </blockquote>
                </div>
            </div><!-- review -->
        </div><!-- all reviews -->
{{--        <div class="we-loading-spinner ember-view we-loading-spinner--see-all"></div>--}}
    </section>
@endsection
@push('js')
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            @isset($service)
            filter('{{$service->name}}');
            @else
            filter('all');
            @endisset
        });
        var options = {
            valueNames: ['reviewservice']
        };
        var reviewsList = new List('reviews-list', options);
        function filter(service) {
            reviewsList.filter(function (item) {
                return !!item.values().reviewservice.includes(service);
            });
        }

        var feedbacks = @json($feedbacks);

        function more(serviceId,index) {
            document.documentElement.style.overflow = 'hidden';
            document.getElementById('modal-container').innerHTML = ' <div class="we-modal  we-modal--open" role="dialog">' +
                '<div class="we-modal__content large-10 medium-12 we-modal__content--review" >' +
                '<div class="we-modal__content__wrapper">' +
                '<div aria-labelledby="we-customer-review-21" class="we-customer-review lockup ember-view">' +
                '<figure aria-label="'+feedbacks[serviceId][index]["rating"]+'out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large">' +
                '<span class="we-star-rating-stars-outlines">' +
                '<span class="we-star-rating-stars we-star-rating-stars-'+feedbacks[serviceId][index]["rating"]+'"></span></span>' +
                '</figure>' +
                '<div class="we-customer-review__header we-customer-review__header--user">' +
                '<span class="we-truncate we-truncate--single-line ember-view we-customer-review__user"> ' +
                'Client '+feedbacks[serviceId][index]["client"]["name"]+'</span>' +
                '<span class="we-customer-review__separator">, </span>' +
                '<time class="we-customer-review__date">'+feedbacks[serviceId][index]["date"]+'</time>' +
                '</div><h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">'+feedbacks[serviceId][index]["title"]+'</h3>' +
                '<blockquote class="we-customer-review__body--modal">' +
                '<p>'+feedbacks[serviceId][index]["body"]+'</p></blockquote></div></div>' +
                '<button class="we-modal__close" onclick="less()" aria-label="Close" ></button>' +
                '</div><button class="we-modal__close--overlay" id="close-div" aria-label="Close" ></button>' +
                '</div><div class="overlay"></div>';
            if(feedbacks[serviceId][index]["rating"]>=3){
                $('#modal-container > blockquote').css('border-left', 'border-left:2px solid #5c9a6f');
            }
        }

        function less() {
            document.documentElement.style.overflow = 'scroll';
            const e = document.getElementById("modal-container");
            let child = e.lastElementChild;
            while (child) {
                e.removeChild(child);
                child = e.lastElementChild;
            }
        }
    </script>
@endpush




