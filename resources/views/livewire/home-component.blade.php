
	<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
			
					
					@foreach ($sliders as $slider)
					<div class="item-slide">
						<img src="{{ asset('assets/images/sliders') }}/{{$slider->image}}" alt="{{$slider->title}}" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">{{$slider->title}}</b></h2>
							<span class="f-subtitle">{{$slider->subtitle}}</span>
							<p class="sale-info">Stating at: <b class="price">{{$slider->price}}</b></p>
							<a href="{{$slider->link}}" class="btn-link">Shop Now</a>
						</div>
					</div>	
					@endforeach
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-1.jpg') }}"  alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-2.jpg') }}" alt=""  width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			@if ($sale_products->count() > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now())
				
			
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">On Sale</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="{{Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s')}}"></div>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

		
                     @foreach ($sale_products as $sale_product)
						 
					
					<div class="product product-style-2 equal-elem ">
						<div class="product-thumnail">
							<a href="{{route('product.details',['slug'=>$sale_product->slug])}}" title="{{$sale_product->name}}">
								<figure><img src="{{ asset('assets/images/products/') }}/{{$sale_product->image}}" width="800" height="800')" }} alt="{{$sale_product->name}}"></figure>
							</a>
							<div class="group-flash">
								<span class="flash-item sale-label">sale</span>
							</div>
							
						</div>
						<div class="product-info">
							<a href="{{route('product.details',['slug'=>$sale_product->slug])}}" class="product-name"><span>{{$sale_product->name}}</span></a>
							<div class="wrap-price"><span class="product-price">{{$sale_product->sale_price}}</span></div>
						</div>
					</div>
                         @endforeach
				
				</div>
			</div>
			@endif
			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/digital-electronic-banner.jpg') }}" width="1170" height="240')" }} alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                     @foreach ($lates_products as $latest_product)
								         

									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{route('product.details',['slug'=>$latest_product->slug])}}" title="{{$latest_product->name}}">
												<figure><img src="{{ asset('assets/images/products') }}/{{$latest_product->image}}" width="800" height="800" alt="{{$latest_product->name}}"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{route('product.details',['slug'=>$latest_product->slug])}}" class="product-name"><span>{{$latest_product->name}}</span></a>
											<div class="wrap-price"><span class="product-price">{{$latest_product->regular_price}}</span></div>
										</div>
									</div>
		
									 @endforeach

								
						

								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
			
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg') }}" width="1170" height="240')" }} alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
							@foreach ($categories as $key=>$category)
								
							
							<a href="#category_{{$category->id}}" class="tab-control-item {{$key == 0 ? 'active': ''}}">{{$category->name}}</a>
							{{-- @foreach ($category->product as $item)
								<h1>{{$item['name']}}</h1>
							@endforeach
						 --}}
							@endforeach
						</div>
						<div class="tab-contents">
							@foreach ($categories as $key=>$category)
							<div class="tab-content-item {{$key == 0 ? 'active': ''}}" id="category_{{$category->id}}">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                    @foreach ($category->products as $item)
									
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{route('product.details',['slug'=>$item->slug])}}" title="{{$item->name}}">
												<figure><img src="{{ asset('assets/images/products/') }}/{{$item->image}}" width="800" height="800" alt="{{$item->name}}"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="{{ route('product.details',['slug'=>$item->slug])}}"
												 class="product-name"><span>{{$item->name}}</span></a>
											<div class="wrap-price"><span class="product-price">{{$item->regular_price}}</span></div>
										</div>
									</div>	
									@endforeach
									
 
								{{-- Product ended here --}}
								

								</div>
							</div>
							@endforeach

						
						</div>
					</div>
				</div>
			</div>	
			
			


		</div>

	</main>