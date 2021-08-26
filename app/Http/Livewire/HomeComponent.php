<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders =HomeSlider::where('status',1)->get();
        $lates_products =Product::OrderBy('created_at','DESC')->get()->take(8);
       //below query for HomeCategory tabs
       $category =HomeCategory::find(1);
       $no_of_products =$category->no_of_products;
       $cat_ids =explode(',',$category->select_categories);
      // dd($cat_ids);
      $sale_products =Product::where('sale_price', '>', 0)->InRandomOrder()->get()->take(8);
       $categories =Category::whereIn('id',$cat_ids)->with('products')->get()->take($no_of_products);
       
      /*  $categories = Category::with(['products' => function($query) {
        $query->take('$no_of_products');
              }])->take("3")->get();
 */

             //sale timer
               $sale =Sale::find(1);
 


             //sale timer ended

     // $categories =Category::with('Product')->find(1);
     //  dd($categories);
        
          //take is not working properly ,its not showing the no of records from products table as passed from 
          //Manage tabs dashboard area instead it works for Category
        return view('livewire.home-component',['sliders'=>$sliders,'lates_products'=>$lates_products,'categories'=>$categories,'sale_products'=>$sale_products,'sale'=>$sale])->layout('layouts/base');
    }
}
