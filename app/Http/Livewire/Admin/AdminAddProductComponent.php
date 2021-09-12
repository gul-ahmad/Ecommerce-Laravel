<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
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
    public $category_id ;

    //Below is livewire rules for validations
    protected $rules = [
      'name'=>'required',
      'slug'=>'required|unique:products',
      'short_description'=>'required',
      'description'=>'required',
      'regular_price'=>'required|numeric',
      'sale_price'=>'required',
      'SKU'=>'required',
      'stock_status'=>'required',
      'featured'=>'required',
      'quantity'=>'required|numeric',
      'image'=>'required|mimes::jpeg,png',
      'category_id'=>'required',
  ];
     //Below is livewire custom messages way to show errors
  protected $messages = [
      'category_id.required' => 'Please select the category!',
      'SKU.required' => 'SKU is required!'
  ];
    
    public function mount()
    {
      $this->stock_status ='instock';
      $this->featured =0;
    //  $this->addError('category_id', 'Category is required.');

    }
    public function generateSlug()
    {
      
   $this->slug =Str::slug($this->name,'-');

    }
    //Below is livewire hook method for validation
    public function updated($property)
    {

      $this->validateOnly($property);

    }
    public function storeProduct()
    {
      $this->validate([
        'name'=>'required',
        'slug'=>'required|unique:products',
        'short_description'=>'required',
        'description'=>'required',
        'regular_price'=>'required|numeric',
        'sale_price'=>'required',
        'SKU'=>'required',
        'stock_status'=>'required',
        'featured'=>'required',
        'quantity'=>'required|numeric',
        'image'=>'required|mimes::jpeg,png',
        'category_id'=>'required',
        
    ]);
        $product =new Product();
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
       // $product->image=$this->image;
       $imageName =Carbon::now()->timestamp. '.'.$this->image->extension();
       $this->image->storeAs('products',$imageName);
       $product->image=$imageName;
       $product->category_id=$this->category_id;
       $product->save();
       //below for sweetalert
       $this->dispatchBrowserEvent( 'swal:modal',[
        'type' =>'success',
        'title' =>'Product Added Successfully!',
        'text' =>'',
      ]);

      $this->name ='';
      $this->slug='';
      $this->short_description ='';
      $this->description='';
      $this->regular_price ='';
      $this->sale_price='';
      $this->SKU ='';
      $this->stock_status='';
      $this->featured='';
      $this->quantity='';
     // $product->image=$this->image;

     $this->image='';
     $this->category_id='';




    }


    public function render()
    {
         $categories =Category::all();

        return view('livewire.admin.admin-add-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
