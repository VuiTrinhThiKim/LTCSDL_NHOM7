@extends('layout_view')

@section('content')

<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Tìm kiếm sản phẩm</h2>
    <?php
    $customer_id_for_fav = Session::get('customer_id');
    $favorite_list_items = Session::get('favorite_list');
    ?>
    @foreach($search_product as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        {{csrf_field()}}
                        <input type="hidden" name="productId" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
                        <input type="hidden" name="producName" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
                        <input type="hidden" name="productPrice" class="cart_product_price_{{$product->product_id}}" value="{{$product->price}}">
                        <input type="hidden" name="productImage" class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
                        <input type="hidden" name="productQuantity" class="cart_product_qty_{{$product->product_id}}" value="1">

                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                            <img src="{{asset('/upload/products/'.$product->product_image)}}" alt="{{$product->product_image}}" />
                            <h2>{{number_format($product->price).' ₫'}}</h2>
                            <p>{{$product->product_name}}</p>
                        </a>

                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-product_id="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li>
                        @if ($customer_id_for_fav != null && $favorite_list_items != null)
                        <a onclick="favoritesOrUnfavorites( '{{ $customer_id_for_fav }}', '{{ $product->product_id }}' )" class="add-to-fav">
                            @if($favorite_list_items->contains('product_id', $product->product_id))
                            <i class="fa fa-heart favorited"></i>
                            <span>Đã yêu thích</span>
                            @else
                            <i class="fa fa-heart"></i>
                            <span>Yêu thích</span>
                            @endif
                        </a>
                        @else
                        <a href="{{URL::to('/login-to-checkout')}}"><i class="fa fa-plus-square"></i>Thêm vào danh sách yêu thích</a>
                        @endif
                    </li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--features_items-->
@endsection