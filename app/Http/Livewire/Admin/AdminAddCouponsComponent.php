<?php

namespace App\Http\Livewire\Admin;
use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiray_date;
    
      
    //Below is livewire hook method for validation
    public function updated($fields)
    {

      $this->validateOnly($fields,[

        'code'=>'required|unique:coupons',
        'type'=>'required',
        'value'=>'required|numeric',
        'cart_value'=>'required|numeric',
        'expiray_date'=>'required'


      ]);

    }
    public function storeCoupon()
    {
      $this->validate([
       
        'code'=>'required|unique:coupons',
        'type'=>'required',
        'value'=>'required|numeric',
        'cart_value'=>'required|numeric',
        'expiray_date'=>'required'
        
    ]);
        $coupon =new Coupon();
        $coupon->code =$this->code;
        $coupon->type=$this->type;
        $coupon->value =$this->value;
        $coupon->cart_value=$this->cart_value;
        $coupon->expiray_date=$this->expiray_date;
      
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
      $this->expiray_date='';
       

    }
    public function render()
    {
        return view('livewire.admin.admin-add-coupons-component')->layout('layouts.base');
    }
}
