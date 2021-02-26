<!-- Color picker -->
<script src="{{ asset('backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('backend/js/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('backend/js/plugins/summernote/summernote-bs4.js')}}"></script>

<script>
    $(document).ready(function () {
        $(".productCategorySelect2").select2();
        $(".productBrandSelect2").select2();
        $(".productTaxSelect2").select2();
        $('.productsTextEditor').summernote();

        /************Start ==> Hide and show product size with sections******************/
            // if get some validation error get old value then hide this section
        var oldProductPrice = "{{ isset($product->price) ? $product->price : old('product_price')}}"
        if (oldProductPrice) {
            $("#appendRowHereForProductPrice").hide('slow')
        } else {
            $("#appendRowHereForProductPrice").show()
        }

        $(".productPriceInput").on('change', function () {
            if ($(this).val().trim()) {
                $("#appendRowHereForProductPrice").hide('slow')
            } else {
                $("#appendRowHereForProductPrice").show()
            }
        })
        /************End ==> Hide and show product size with sections******************/
    });


    /************ Start => add and remove product size with price **************/
    // add new product size with price
    function addNewProductSizeWithPrice(event) {
        event.preventDefault()
        $("#appendRowHereForProductPrice")
            .append(`<div class="row" id="removeThis">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input id="product_size_arr" type="text" name="product_size_arr[]" class="form-control">
                                     </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input id="product_price_arr" type="text"name="product_price_arr[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input id="discount_price_arr" type="text"name="discount_price_arr[]" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input id="product_stock_arr" type="number" name="product_stock_arr[]" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                       <button class="btn btn-danger btn-block" onclick="removeProductSizeWithPrice(event, this)"><i class="fa fa-minus-circle"></i></button>
                                    </div>
                                </div>
                    </div>`)
    }

    // remove product size with price
    function removeProductSizeWithPrice(event, element) {
        event.preventDefault()
        $(element).parents('.row #removeThis').remove();
    }

    /************ End => add and remove product size with price **************/

    /************ Start => add new and remove product color **************/
    function addNewProductColor(event, element) {
        event.preventDefault()
        $("#productColorArrAppend")
            .append(`<div class="row" id="productColorArrRemove">
                    <div class="col-md-9">
                        <div class="form-group">
                            <input id="product_color_arr" type="text"
                                   name="product_color_arr[]"
                                    class="form-control productColorPicker colorpicker-element">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button class="btn btn-danger"
                                    onclick="removeProductColor(event, this)"><i
                                    class="fa fa-minus-circle"></i></button>
                        </div>
                    </div>
                </div>`)
    }


    function removeProductColor(event, element) {
        event.preventDefault()
        $(element).parents('.row #productColorArrRemove').remove();
    }

    /************ End => add new and remove product color **************/


    /***********************Start for edit sections*******************************/


    function removeProductPriceItemFromDataBase(e, element, product_size_id) {
        e.preventDefault()
        if (product_size_id && confirm('Are you sure to delete this item')) {
            $.get('{{ route('admin.products.remove.size') }}', {product_size_id: product_size_id}, (res) => {
                if (res.success) {
                    $(element).parents('.row #removeExistingProductSize').remove();
                    toastr.success(`${res.message}`);
                }
            })
        }
    }


    // delete product image
    function removeProductImage(e, el, image_id) {
        e.preventDefault()
        if (image_id && confirm('Are you sure to delete this item')) {
            $.get('{{ route('admin.products.remove.image') }}', {image_id: image_id}, (res) => {
                if (res.success) {
                    $(el).parents('#removeProductImageSection').remove();
                    toastr.success(`${res.message}`);
                }
            })
        }
    }


</script>
