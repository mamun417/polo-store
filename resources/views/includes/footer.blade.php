<footer class="footer-area">
    <!--    <h2 class="footer-top">Clear the CLEARENCE! | Upto 75% Off</h2>-->
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <a href="{{ route('home') }}"><img class="footer-logo"
                           src="@if(empty($globalSettingInfo)) @else {{ $globalSettingInfo->image()->where('type', 'footer_logo')->first()->url }} @endif"
                           alt="Footer Logo">
                        </a>
                    </div>
                </div>
                <p class="footer-area_desc">{!! @$globalSettingInfo->description_one !!}</p>
                <div class="social-icon-area">
                    @if($globalSocialInfo->count() > 0)
                        @foreach($globalSocialInfo as $social)
                            <a target="_blank" href="{{ $social->link }}"><i class="{{ $social->icon }} icon-width"
                                                                             aria-hidden="true"></i></a>
                        @endforeach
                    @else
                    @endif
                </div>
                <hr class="icon-bottom-bar">
                <p class="footer-area-bottom_desc">{!! @$globalSettingInfo->description_two !!}</p>
            </div>
        </div>
    </div>
</footer>
