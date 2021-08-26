<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories =[];
    public $noofproducts;
    public function mount()
    {
     $category =HomeCategory::find(1);
     $this->selected_categories =explode(',',$category->select_categories);
     $this->noofproducts =$category->no_of_products;

    }
    public function updateHomeCategory()
    {
        $category =HomeCategory::find(1);
        $category->select_categories =implode(',',$this->selected_categories);
        $category->no_of_products =$this->noofproducts;
        $category->save();
        $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Category Tab Updated Successfully!',
            'text' =>'',
          ]);





    }
    public function render()
    {    
        $categories =Category::all();
        return view('livewire.admin.admin-home-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
