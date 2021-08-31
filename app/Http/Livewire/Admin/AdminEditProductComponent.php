<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug ;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $imageNew;
    public $category_id;
    public $product_id;
   public function mount($product_id)
   {
     $product =Product::where('id',$product_id)->first();
     $this->name= $product->name;
     $this->slug = $product->slug;
     $this->short_description= $product->short_description;
     $this->description= $product->description;
     $this->regular_price= $product->regular_price;
     $this->sale_price= $product->sale_price;
     $this->SKU= $product->SKU;
     $this->stock_status= $product->stock_status;
     $this->featured= $product->featured;
     $this->quantity=$product->quantity;
     $this->image=$product->image;
     $this->category_id=$product->category_id;
     $this->product_id=$product->id;
  

   }
   public function generateSlug()
   {
     
  $this->slug =Str::slug($this->name,'-');

   }
    //defined this function to ingnore the unique validation for current editing category
    protected function product_rules()
    {
        return [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('products')->ignore($this->product_id)
            ],
        'short_description'=>'required',
        'description'=>'required',
        'regular_price'=>'required|numeric',
        'sale_price'=>'required',
        'SKU'=>'required',
        'stock_status'=>'required',
        'featured'=>'required',
        'quantity'=>'required|numeric',
    //    'imageNew'=>'mimes::jpeg,png',
        'category_id'=>'required',
        ];
    }
    protected function messages()
    {
        return [
          'category_id.required' => 'Please select the category!',
          'SKU.required' => 'SKU is required!'
        ];
    }
   
    //liverwire hook method for validation
    public function updated($fields)
    {
        $this->validateOnly($fields, $this->product_rules(),$this->messages());
    }
   public function updateProduct()
   {
    $this->validate($this->product_rules());
     $product =Product::find($this->product_id);
    // dd($product);
     $product->name =$this->name;
     $product->slug=$this->slug;
     $product->short_description =$this->short_description;
     $product->description=$this->description;
     $product->regular_price =$this->regular_price;
     $product->sale_price=$this->sale_price;
     $product->SKU =$this->SKU;
     $product->stock_status=$this->stock_status;
     $product->featured=$this->featured;
     $product->quantity=$this->quantity;
     if($this->imageNew)
     {
    $imageName =Carbon::now()->timestamp. '.'.$this->imageNew->extension();
    $this->imageNew->storeAs('products',$imageName);
    $product->image=$imageName;

     }
  
    $product->category_id=$this->category_id;
    $product->save();
    $this->dispatchBrowserEvent( 'swal:modal',[
        'type' =>'success',
        'title' =>'Product updated Successfully!',
        'text' =>'',

      ]);




   }


    public function render()
    {
        $categories =Category::all();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
