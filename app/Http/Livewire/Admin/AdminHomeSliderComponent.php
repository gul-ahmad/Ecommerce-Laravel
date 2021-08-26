<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHomeSliderComponent extends Component

{
    use WithPagination;
    protected $listeners = ['deleteSlider'];
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent( 'swal:confirm',[
            'type' =>'warning',
            'title' =>'Are you sure to Delete',
            'text' =>'',
            'id'=>$id
        ]);


    }


      public function deleteSlider($id)
      {
          $slider =HomeSlider::find($id);
          $slider->delete();
          $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Slider Deleted Successfully!',
            'text' =>'',
          ]);
      }
   


    public function render()
    {
        $sliders =HomeSlider::paginate(10);
        return view('livewire.admin.admin-home-slider-component',['sliders'=>$sliders])->layout('layouts.base');;
    }
}
