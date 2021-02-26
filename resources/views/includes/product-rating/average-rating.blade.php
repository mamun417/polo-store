@if(@$productRating->ratings)
<div class="rating cursor_pointer_none">
    @if($product_rating_count = @$productRating->ratings->count() > 0)
        <label class="star_default_color rating_count ml-1">( {{ @$product_rating_count }} )</label>
    @endif

    @php
        @$product_rating = round(@$productRating->ratings()->avg('rating'), 2);
    @endphp
    @for ($i = 4; $i >= 0; $i--)
        @if (@$product_rating - $i >= 1)
            <!-- Full Rating Start-->
            <label class="star_size text-warning mb-0"><i class="fa fa-star"></i></label>
        @elseif (@$product_rating - $i > 0)
            <!--Half Rating Start-->
            <label class="text-warning star_size mb-0"><i class="fa fa-star-half"></i></label>
        @else
           {{-- Empty Rating Start--}}
            <label class="star_default_color star_size mb-0"><i class="fa fa-star"></i></label>
        @endif
    @endfor
</div>
@endif