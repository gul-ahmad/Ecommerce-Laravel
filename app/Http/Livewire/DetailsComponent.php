<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    //for increasing and decreasing the quantity in details page of Product we are using $qty
    public $qty;
    public function mount($slug)
    {
        $this->slug =$slug;
        $this->qty = 1;

    }
   
    public function store($product_id,$product_name,$product_price)
    {
   /*    Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
      Session()->flash('success_message','Item Added Successfully');
      return redirect()->route('product.cart'); */
      Cart::instance('cart')->add($product_id,$product_name, $this->qty,$product_price)->associate('App\Models\Product');
      //emiting the event to cartlist count component to update the value
      $this->emitTo('cart-list-count-component', 'refreshCartCount');

      Session()->flash('success_message','Item Added Successfully');
      return redirect()->route('product.cart');

    }
    //not working
    public function increaseQuantity()
    {

        $this->qty++;

    }
    //not working
    public function decreaseQuantity()
    {
        if($this->qty > 1 )
        {

             $this->qty--;

        }

    }
    public function render()
    {
        $product =Product::where('slug',$this->slug)->first();
        $popular_products =Product::inRandomOrder()->limit(4)->get();
        $related_products =Product::where('category_id',$product->category_id)->inRandomOrder()->limit(5)->get();

         //sale timer
         $sale =Sale::find(1);
        //sale timer ended
        return view('livewire.details-component',['product'=>$product,'related_products'=>$related_products,'popular_products'=>$popular_products,'sale'=>$sale])->layout('layouts.base');
    }
}
