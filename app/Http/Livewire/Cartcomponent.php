<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class Cartcomponent extends Component
{
   public $havecouponcode;
   public $CouponCode;
   public $discount;
   public $subTotalAfterDiscount;
   public $taxAfterDiscount;
   public $totalAfterDiscount;
    public function IncreaseQuantity($rowId)
    {
       $product =Cart::instance('cart')->get($rowId);
       $qty =$product->qty+1;
       Cart::instance('cart')->update($rowId,$qty);
       $this->emitTo('cart-list-count-component', 'refreshCartCount');

    }
    public function applyCouponCode()
    {
      $coupon=Coupon::where('code',$this->CouponCode)->where('expiray_date', '>=',Carbon::today())->where('cart_value','<=',Cart::instance('cart')->subtotal())->first();
       if(!$coupon)
       {
         session()->flash('coupon_message','Invalid coupon code!');
         return;
      
       }
       session()->put('coupon',[
         'code' =>$coupon->code,
         'type' =>$coupon->type,
         'value' =>$coupon->value,
         'cart_value' =>$coupon->cart_value

       ]);
    }
    public function calculateDiscounts()
    {
    if(session()->has('coupon'))
    {
        if(session()->get('coupon')['type']=='fixed')
        {
       $this->discount =session()->get('coupon')['value'];

        }
        else
        {

         $this->discount = (Cart::instance('cart')->subtotal()*session()->get('coupon')['value'])/100;

        }

          $this->subTotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
          $this->taxAfterDiscount =($this->subTotalAfterDiscount *config('cart.tax'))/100;
          $this->totalAfterDiscount = $this->subTotalAfterDiscount+$this->taxAfterDiscount ;


          }


      
    }
    public function DecreaseQuantity($rowId)
    {
       $product =Cart::instance('cart')->get($rowId);
       $qty =$product->qty-1;
       Cart::instance('cart')->update($rowId,$qty);
       $this->emitTo('cart-list-count-component', 'refreshCartCount');
    }
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-list-count-component', 'refreshCartCount');
        session()->flash('success_message','Item has been deleted');

    }
    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-list-count-component', 'refreshCartCount');
        session()->flash('success_message','Cart cleared');

    }
    public function checkout()
    {
         if (Auth::check()) {

             return redirect()->route('checkout');
          }
         else
          {
            return redirect()->route('login');
          }
        
    }
    public function setAmountForCheckOut()
    {
       if(!Cart::instance('cart')->count() > 0)
       {
          session()->forget('checkout');
          return;


       }



     if(session()->has('coupon'))
     {
     session()->put('checkout',[
          'discount'=>$this->discount,
          'subtotal'=>$this->subTotalAfterDiscount,
          'tax'=>$this->taxAfterDiscount,
          'total'=>$this->totalAfterDiscount,
     ]);
       }
       else
       {

        session()->put('checkout',[
          'discount'=>0,
          'subtotal'=>Cart::instance('cart')->subtotal(),
          'tax'=>Cart::instance('cart')->tax(),
          'total'=>Cart::instance('cart')->total(),
     ]);


       }



    }
    public function render()
    {
       if(session()->has('coupon'))
       {
         if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
         {

             session()->forget('coupon');
         }
         else
         {
           $this->calculateDiscounts();
         }

       }
          $this->setAmountForCheckOut();
        return view('livewire.cartcomponent')->layout('layouts.base');
    }
}
