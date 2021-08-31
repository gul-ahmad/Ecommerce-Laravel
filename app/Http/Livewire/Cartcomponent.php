<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class Cartcomponent extends Component
{
    public function IncreaseQuantity($rowId)
    {
       $product =Cart::instance('cart')->get($rowId);
       $qty =$product->qty+1;
       Cart::instance('cart')->update($rowId,$qty);
       $this->emitTo('cart-list-count-component', 'refreshCartCount');

    }
    public function DecreaseQuantity($rowId)
    {
       $product =Cart::instance('cart')->get($rowId);
       $qty =$product->qty-1;
       Cart::instance('cart')->update($rowId,$qty);
       $this->emitTo('cart-list-count-component', 'refreshCartCount');
    }
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-list-count-component', 'refreshCartCount');
        session()->flash('success_message','Item has been deleted');

    }
    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-list-count-component', 'refreshCartCount');
        session()->flash('success_message','Cart cleared');

    }
    public function render()
    {
        return view('livewire.cartcomponent')->layout('layouts.base');
    }
}
