@extends('layout_view')

@section('content')
<div class="category_items">
	<!--category_items-->
	<h2 class="title text-center">Brand {{$brand_name}}</h2>
	<?php
	$customer_id_for_fav = Session::get('customer_id');
	$favorite_list_items = Session::get('favorite_list');
	?>
	@foreach($products_brand as $key => $product)
	<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center">
						<img src="{{asset('/upload/products/'.$product->product_image)}}" alt="{{$product->product_image}}" />
						<h2>{{number_format($product->price).' ₫'}}</h2>
						<p>{{$product->product_name}}</p>
						<form action="{{URL::to('/gio-hang')}}" method="post">
							{{csrf_field()}}
							<input type="hidden" name="productId" value="{{$product->product_id}}">
							<input name="productQuantity" type="hidden" value="1" />
							@if($product->product_qty > 0)
							<button type="submit" class="btn btn-default add-to-cart">
								<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
							</button>
							@else
							<button type="submit" class="btn btn-default add-to-cart" disabled>
								<i class="fa fa-shopping-cart"></i>Hết hàng
							</button>
							@endif
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
					</ul>
				</div>
			</div>
		</div>
	</a>
	@endforeach
</div>
<!--features_items-->
@endsection