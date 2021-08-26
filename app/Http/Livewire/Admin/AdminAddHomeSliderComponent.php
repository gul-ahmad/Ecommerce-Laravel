<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{ 
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $link;
    public $image;
    public $price;
    public $status;
    public function mount()
    {

    $this->status =1;

    }
    public function addSlide(){
        $slider =new HomeSlider();
        $slider->title =$this->title;    
        $slider->subtitle=$this->subtitle;
        $slider->link = $this->link;
        $imageName =Carbon::now()->timestamp. '.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image = $imageName;
        $slider->price= $this->price;
        $slider->status=$this->status;
        $slider->save();
        $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Slider Added Successfully!',
            'text' =>'',
          ]);
          $this->title ='';
      $this->subtitle='';
      $this->price ='';
      $this->link='';
      $this->image ='';
      $this->status='';
     




    }
    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');;
    }
}
