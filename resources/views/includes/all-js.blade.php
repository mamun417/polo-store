<script>
    $('.boys-btn').click(function () {
        $('.sidebar ul .boys-show').toggleClass('show');
        $('.sidebar ul .boys').toggleClass('rotate');
    });
    $('.men-btn').click(function () {
        $('.sidebar ul .men-show').toggleClass('active');
        $('.sidebar ul .men').toggleClass('men-rotate');
    });
</script>
<script>
    $('.boys-btn').click(function (e) {
        e.preventDefault();
        $('.sidebar ul .boys-show').toggleClass('show');
        $('.sidebar ul .boys').toggleClass('rotate');
    });
</script>
<script>
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: false,
            controlNav: "thumbnails"
        });
    });
</script>
<!-- Popper.js -->
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>

<!-- imagezoom -->
<script src="{{ asset('frontend/assets/js/imagezoom.js') }}"></script>

<!-- flexslider -->
<script src="{{ asset('frontend/assets/js/jquery.flexslider.js') }}"></script>

<!-- All Plugins js -->
<script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>

<!-- Customs Js-->
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('backend/js/plugins/toastr/toastr.min.js') }}"></script>

<!--Axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

{{--Sweetalert--}}
<script src="{{ asset('backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script>
    @foreach(['success', 'warning', 'error', 'info'] as $item)
        @if(session($item))
            toastr['{{ $item }}']('{{ session($item) }}');
        @endif
    @endforeach


    let checkAuth = "{{ auth()->check() }}";
    $(".productRatingSubmit").on('click', function (){
        event.preventDefault();
        if(!checkAuth){
            toastr.error('You need first login')
        }else{
            $("#productStartRatingForm").submit()
        }
    })

    @error('user_id')
    let ratingSubmittedMessage = "{{ $message }}"
    toastr.info(ratingSubmittedMessage)
    @enderror

    @error('rating')
    let ratingRequiredMessage = "{{ $message }}"
    toastr.error(ratingRequiredMessage)
    @enderror
</script>
