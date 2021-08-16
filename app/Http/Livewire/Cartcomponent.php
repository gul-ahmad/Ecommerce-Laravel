<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class Cartcomponent extends Component
{
    public function IncreaseQuantity($rowId)
    {
       $product =Cart::get($rowId);
       $qty =$product->qty+1;
       Cart::update($rowId,$qty);

    }
    public function DecreaseQuantity($rowId)
    {
       $product =Cart::get($rowId);
       $qty =$product->qty-1;
       Cart::update($rowId,$qty);

    }
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message','Item has been deleted');

    }
    public function destroyAll()
    {
        Cart::destroy();
        session()->flash('success_message','Cart cleared');

    }
    public function render()
    {
        return view('livewire.cartcomponent')->layout('layouts.base');
    }
}
