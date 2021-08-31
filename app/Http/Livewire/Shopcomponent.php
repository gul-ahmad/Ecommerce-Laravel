<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class Shopcomponent extends Component
{
    public $pagessize;
    public $sorting;
    public $min_price;
    public $max_price;
   public function mount()
   {
     $this->pagessize = 12;
      $this->sorting ="defualt";
      $this->min_price =1;
      $this->max_price =3000;
   }

    public function store($product_id,$product_name,$product_price)
    {
      Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
      //emiting the event to cartlist count component to update the value
      $this->emitTo('cart-list-count-component', 'refreshCartCount');

      Session()->flash('success_message','Item Added Successfully');
      return redirect()->route('product.cart');

    }
    public function addToWishList($product_id,$product_name,$product_price)
    {

         Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
         $this->emitTo('wish-list-count-component', 'refreshWishCount');
  


    }
    public function removeFromWishList($product_id)
    {

         foreach(Cart::instance('wishlist')->content() as $WishListItem)
         {

            if($WishListItem->id == $product_id)
            {
               Cart::instance('wishlist')->remove($WishListItem->rowId);
               $this->emitTo('wish-list-count-component', 'refreshWishCount');
               return;


            }


         }




    }
    use WithPagination;
    public function render()
    {
      if($this->sorting =='date')
      {

        $products =Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagessize);

      }
      elseif($this->sorting =='price')
      {

        $products =Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagessize);


      }
      elseif($this->sorting =='price-desc')
      {

        $products =Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagessize);


      }
      else{

        $products =Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagessize);



      }
        $categories =Category::all();
        return view('livewire.shopcomponent',['products'=>$products,'categories'=>$categories])->layout('layouts/base');
    }
}
