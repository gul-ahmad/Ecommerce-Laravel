<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Validation\Rule;


class AdminEditCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    public $expiray_date;

    public function mount($coupon_id)
   {
     $coupon =Coupon::where('id',$coupon_id)->first();
     $this->code= $coupon->code;
     $this->type = $coupon->type;
     $this->value= $coupon->value;
     $this->cart_value= $coupon->cart_value;
     $this->expiray_date= $coupon->expiray_date;
     $coupon->save();
     

   }
   protected function coupons_rules()
    {
        return [
       
          'type'=>'required',
          'value'=>'required|numeric',
          'cart_value'=>'required|numeric',
          'expiray_date'=>'required',
            'code' => [
                'required',
                Rule::unique('coupons')->ignore($this->coupon_id)
            ]
        ];
    }
      
    //Below is livewire hook method for validation
    public function updated($fields)
    {

      $this->validateOnly($fields, $this->coupons_rules());


    }
    public function updatecoupon()
    {
      $this->validate($this->coupons_rules());
   
      $coupon =Coupon::find($this->coupon_id);
     // dd($product);
      $coupon->code =$this->code;
      $coupon->type=$this->type;
      $coupon->value =$this->value;
      $coupon->cart_value=$this->cart_value;
      $coupon->expiray_date=$this->expiray_date;
        $coupon->save();
        $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Coupon updated Successfully!',
            'text' =>'',
    
        ]);
    
 
 
 
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-coupons-component')->layout('layouts.base');
    }
}
