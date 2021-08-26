<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    protected $listeners = ['deleteProduct'];
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent( 'swal:confirm',[
            'type' =>'warning',
            'title' =>'Are you sure!',
            'text' =>'',
            'id'=>$id
        ]);


    }


      public function deleteProduct($id)
      {
          $category =Product::find($id);
          $category->delete();
          $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Product Deleted Successfully!',
            'text' =>'',
          ]);
      }
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}
