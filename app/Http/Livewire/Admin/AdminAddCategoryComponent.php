<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;


class AdminAddCategoryComponent extends Component
{
    
    public $name;
    public $slug;
    protected $listeners = ['add'];
    public function generateslug()
    {
     $this->slug =Str::slug($this->name);
    }
    public function storeCategory()
    {
      $category =new Category();
      $category->name =$this->name;
      $category->slug=$this->slug;
      $category->save();
     // session()->flash('success_message','Category added Successfully!');

          $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Category Added Successfully!',
            'text' =>'',


          ]);


    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
