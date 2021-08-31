<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartListCountComponent extends Component
{
    //defined livewire listener here to dynamically update the cart value as soon as product is added to it
    // $refresh is defualt word of livewire
    protected $listeners = ['refreshCartCount' => '$refresh'];

    public function render()
    {
        return view('livewire.cart-list-count-component');
    }
}
