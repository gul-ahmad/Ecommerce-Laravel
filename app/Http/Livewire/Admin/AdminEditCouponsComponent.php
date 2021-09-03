<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;

class AdminEditCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;

    public function mount($coupon_id)
   {
     $coupon =Coupon::where('id',$coupon_id)->first();
     $this->code= $coupon->code;
     $this->type = $coupon->type;
     $this->value= $coupon->value;
     $this->cart_value= $coupon->cart_value;
     $coupon->save();
     

   }
      
    //Below is livewire hook method for validation
    public function updated($property)
    {

      $this->validateOnly($property);

    }
    public function updateProduct()
    {
        $this->validate([
       
            'code'=>'required|unique::coupons',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            
        ]);
   
      $coupon =Coupon::find($this->coupon_id);
     // dd($product);
      $coupon->code =$this->code;
      $coupon->type=$this->type;
      $coupon->value =$this->value;
      $coupon->cart_value=$this->cart_value;
        $coupon->save();
        $this->dispatchBrowserEvent( 'swal:modal',[
            'type' =>'success',
            'title' =>'Coupon updated Successfully!',
            'text' =>'',
    
        ]);
    
 
 
 
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-coupons-component');
    }
}
