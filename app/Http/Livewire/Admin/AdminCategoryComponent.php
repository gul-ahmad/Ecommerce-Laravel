<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
     use WithPagination;
     protected $listeners = ['deleteCategory'];

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent( 'swal:confirm',[
            'type' =>'warning',
            'title' =>'Are you sure!',
            'text' =>'',
            'id'=>$id
        ]);


    }


      public function deleteCategory($id)
      {
          $category =Category::find($id);
          $category->delete();
          $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Category Deleted Successfully!',
            'text' =>'',


          ]);


      }


    public function render()
    {
         $categories=Category::paginate(12);        
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
