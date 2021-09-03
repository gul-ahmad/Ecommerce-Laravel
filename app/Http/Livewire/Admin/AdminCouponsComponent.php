<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;


    protected $listeners = ['deleteCoupon'];
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent( 'swal:confirm',[
            'type' =>'warning',
            'title' =>'Are you sure!',
            'text' =>'',
            'id'=>$id
        ]);


    }


      public function deleteCoupon($id)
      {
          $category =Coupon::find($id);
          $category->delete();
          $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Coupon Deleted Successfully!',
            'text' =>'',
          ]);
      }
  
      
    //Below is livewire hook method for validation
    public function updated($property)
    {

      $this->validateOnly($property);

    }
    public function storeCoupon()
    {
      $this->validate([
       
        'code'=>'required|unique::coupons',
        'type'=>'required',
        'value'=>'required|numeric',
        'cart_value'=>'required|numeric',
        
    ]);
        $coupon =new Coupon();
        $coupon->code =$this->code;
        $coupon->type=$this->type;
        $coupon->value =$this->value;
        $coupon->cart_value=$this->cart_value;
      
       $coupon->save();
       //below for sweetalert
       $this->dispatchBrowserEvent( 'swal:modal',[
        'type' =>'success',
        'title' =>'Coupon Added Successfully!',
        'text' =>'',
      ]);

      $this->code ='';
      $this->type='';
      $this->value ='';
      $this->cart_value='';
       

    }
    public function render()
    {
        $coupons =Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
