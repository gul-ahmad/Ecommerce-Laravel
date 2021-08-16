<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;


class CategoryComponent extends Component
{
    public $pagessize;
    public $sorting;
    public $category_slug;
   public function mount($category_slug)
   {
     $this->pagessize = 12;
      $this->sorting ="defualt";
      $this->category_slug =$category_slug;
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
     $Category =Category::where('slug',$this->category_slug)->first();
     $category_id =$Category->id;
     $category_name=$Category->name;

      if($this->sorting =='date')
      {

        $products =Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pagessize);

      }
      elseif($this->sorting =='price')
      {

        $products =Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pagessize);


      }
      elseif($this->sorting =='price-desc')
      {

        $products =Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pagessize);


      }
      else{

        $products =Product::where('category_id',$category_id)->paginate($this->pagessize);



      }
        $categories =Category::all();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])->layout('layouts/base');
    }
}
