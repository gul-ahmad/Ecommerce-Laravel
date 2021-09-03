<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>WishList</span></li>
            </ul>
        </div>
        <style>
            .product-wish {
             position: absolute;
             top: 10%;
             left: 0;
             z-index: 99;
             right: 30px;
             text-align: right;
             padding-top: 0;


            }
            .product-wish .fa {

              color:blueviolet;
              font-size: 32px;


            }
            .product-wish .fa:hover {

             color:cadetblue;
             
             }
             .fill-heart {
              color:crimson !important;



             }
         </style>
        <div class="row">
            @if (Cart::instance('wishlist')->content()->count() > 0 )
                
          
            <ul class="product-list grid-products equal-container">
              
                 @foreach (Cart::instance('wishlist')->content() as $item)
                 <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">{{-- 
                          //Let's say you have a Product model in your application. With the associate() method, you can tell the cart that an item in the cart, is associated to the Product model.

                          That way you can access your model right from the CartItem!
                          
                          The model can be accessed via the model property on the CartItem. --}}
                          {{--  From Gloudamans Documentation we are using model here --}}



                            <a href="{{route('product.details',['slug'=>$item->model->slug])}}" title="{{$item->model->name}}">
                                <figure><img src="{{ asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{$item->model->name}}</span></a>
                            <div class="wrap-price"><span class="product-price">{{$item->model->regular_price}}</span></div>
                            <a href="#" class="btn add-to-cart" wire:click.prevent="moveFromWishListToCart('{{$item->rowId}}')">Move To Cart</a>
                            <div class="product-wish">
                               {{-- calling remove from wishlist only --}}
                                <a href="#" wire:click.prevent="removeFromWishList({{$item->model->id}},'{{$item->model->name}}',{{$item->model->regular_price}})"><i class="fa fa-heart"></i></a>
                               
                                
                            </div>
                        </div>
                    </div>
                </li>
                     
                 @endforeach
                
    
            </ul>
            
            @else
            <h4>No Items in WishList</h4>    
            @endif
          
        </div>
    </div>
   
</main>

