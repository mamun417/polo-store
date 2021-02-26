<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-0">
            <div class="modal-header ml-0">
                <h5 class="modal-title text-left ml-0" id="exampleModalLongTitle">Rate this map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <h6 class="pl-3 my-0">Your rating will be added to overall score</h6>
            <div class="card-body text-center">
                <div class="comment-box text-center">
                    <form id="productStartRatingForm" action="{{ route('product.rating.store') }}" method="post">
                        @csrf
                        <div class="rating hover_add_full_star">
                            <input type="radio" name="rating" value="5" id="5">
                            <label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4">
                            <label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3">
                            <label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2">
                            <label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1">
                            <label for="1">☆</label>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div class="text-center mt-4">
                            <button type="submit" class="btn send px-5 productRatingSubmit">Submit Rat <i class="fa fa-long-arrow-right ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>