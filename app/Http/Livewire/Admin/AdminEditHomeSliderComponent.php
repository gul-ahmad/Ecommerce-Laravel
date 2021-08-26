<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $link;
    public $image;
    public $price;
    public $status;
    public $imageNew;
    public $slider_id;
     public function mount($slider_id)
     {
      $slider =HomeSlider::find($slider_id);
      $this->title =$slider->title;
      $this->subtitle =$slider->subtitle;
      $this->link =$slider->link;
      $this->image =$slider->image;
      $this->status =$slider->status;
      $this->price =$slider->price;
      $this->slider_id =$slider->id;
     

     }
     public function updateSlider()
     {
       $slider =HomeSlider::find($this->slider_id);
      // dd($product);
       $slider->title =$this->title;
       $slider->subtitle=$this->subtitle;
       $slider->link =$this->link;
       $slider->status=$this->status;
       $slider->price=$this->price;
      
       if($this->imageNew)
       {
      $imageName =Carbon::now()->timestamp. '.'.$this->imageNew->extension();
      $this->imageNew->storeAs('sliders',$imageName);
      $slider->image=$imageName;
  
       }
      $slider->save();
      $this->dispatchBrowserEvent( 'swal:modal',[
          'type' =>'success',
          'title' =>'Slider updated Successfully!',
          'text' =>'',
  
        ]);
  
  
  
  
     }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');;
    }
}
