<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;


class Shopcomponent extends Component
{
    public $pagessize;
    public $sorting;
   public function mount()
   {
     $this->pagessize = 12;
      $this->sorting ="defualt";
   }

    public function store($product_id,$product_name,$product_price)
    {
      Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
      Session()->flash('success_message','Item Added Successfully');
      return redirect()->route('product.cart');

    }
    use WithPagination;
    public function render()
    {
      if($this->sorting =='date')
      {

        $products =Product::orderBy('created_at','DESC')->paginate($this->pagessize);

      }
      elseif($this->sorting =='price')
      {

        $products =Product::orderBy('regular_price','ASC')->paginate($this->pagessize);


      }
      elseif($this->sorting =='price-desc')
      {

        $products =Product::orderBy('regular_price','DESC')->paginate($this->pagessize);


      }
      else{

        $products =Product::paginate($this->pagessize);



      }
        $categories =Category::all();
        return view('livewire.shopcomponent',['products'=>$products,'categories'=>$categories])->layout('layouts/base');
    }
}
