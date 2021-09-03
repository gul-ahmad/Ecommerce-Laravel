<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;


class WishListComponent extends Component
{
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
    public function moveFromWishListToCart($rowId)
    {
      $Item = Cart::instance('wishlist')->get($rowId);
      Cart::instance('wishlist')->remove($rowId);
      Cart::instance('cart')->add($Item->id,$Item->name,1,$Item->price)->associate('App\Models\Product');
      $this->emitTo('wish-list-count-component', 'refreshWishCount');
      $this->emitTo('cart-list-count-component', 'refreshCartCount');

       
    }
    public function render()
    {
        return view('livewire.wish-list-component')->layout('layouts.base');
    }
    
}
