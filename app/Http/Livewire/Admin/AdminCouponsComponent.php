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
    public $expiray_date;


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
  
    public function render()
    {
        $coupons =Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
