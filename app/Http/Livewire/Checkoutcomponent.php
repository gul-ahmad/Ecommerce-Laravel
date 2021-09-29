<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;
use Cart;
use Exception;
use Stripe;
//use Cartalyst\Stripe\Stripe;

class Checkoutcomponent extends Component
{
    public $ship_to_different_address;

    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $address;
    public $country;
    public $zipcode;
    public $city;
    public $province;
    public $line1;
    public $line2;

    public $thankyou;



    public  $s_firstname;
    public  $s_lastname;
    public  $s_email;
    public  $s_mobile;
    public  $s_country;
    public  $s_zipcode;
    public  $s_city;
    public $s_province;
    public $s_line1;
    public $s_line2;

    public $paymentmode;


    public $card_no;
    public $exp_year;
    public $exp_month;
    public $cvc;

      public function updated($fields)
      {
      $this->validateOnly($fields,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'country'=>'required',
            'zipcode'=>'required',
            'city'=>'required',
            'province'=>'required',
            'line1'=>'required',
            'paymentmode'=>'required',

      ]);
      if($this->ship_to_different_address)
      {
        $this->validateOnly($fields,[
            's_firstname'=>'required',
            's_lastname'=>'required',
            's_email'=>'required|email',
            's_mobile'=>'required|numeric',
            's_country'=>'required',
            's_zipcode'=>'required',
            's_city'=>'required',
            's_province'=>'required',
            's_line1'=>'required',

         ]);
      }

          if($this->paymentmode =='card')
          {
            $this->validateOnly($fields,[
              'card_no'=>'required|numeric',
              'exp_year'=>'required|numeric',
              'exp_month'=>'required|numeric',
              'cvc'=>'required|numeric',
          
             ]);
                    
          }



      }

     public function placeOrder()
     {
         $this->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'country'=>'required',
            'zipcode'=>'required',
            'city'=>'required',
            'province'=>'required',
            'line1'=>'required',
            'paymentmode'=>'required',
        
         ]);   

         if($this->paymentmode =='card')
         {
           $this->validate([
             'card_no'=>'required|numeric',
             'exp_year'=>'required|numeric',
             'exp_month'=>'required|numeric',
             'cvc'=>'required|numeric',
         
            ]);
                   
         }



       $order = new Order();
      // dd($order);
       $order->user_id = Auth::user()->id;
       $order->subtotal = session()->get('checkout')['subtotal'];
       $order->discount = session()->get('checkout')['discount'];
       $order->tax = session()->get('checkout')['tax'];
       $order->total = session()->get('checkout')['total'];
       $order->firstname= $this->firstname;
       $order->lastname= $this->lastname;
       $order->email= $this->email;
       $order->mobile= $this->mobile;
       $order->line1= $this->line1;
       $order->line2= $this->line2;
       $order->country= $this->country;
       $order->province= $this->province;
       $order->zipcode= $this->zipcode;
       $order->city= $this->city;
       $order->status= 'ordered';
       $order->is_shipping_different= $this->ship_to_different_address ? 1:0 ;
       $order->save();

       foreach(Cart::instance('cart')->content() as $item)
       {
         $orderItem = new OrderItem();
         $orderItem->product_id = $item->id;
         $orderItem->order_id = $order->id;
         $orderItem->price = $item->price;
         $orderItem->quantity = $item->qty;
         $orderItem->save();
         
       }

                if($this->ship_to_different_address)
                {
                //  dd('I am here in ');
                     $this->validate([
                        's_firstname'=>'required',
                        's_lastname'=>'required',
                        's_email'=>'required|email',
                        's_mobile'=>'required|numeric',
                        's_country'=>'required',
                        's_zipcode'=>'required',
                        's_city'=>'required',
                        's_province'=>'required',
                        's_line1'=>'required',

                    ]);  
                    $shipping = new Shipping();
                    $shipping->order_id= $order->id;
                    $shipping->firstname= $this->s_firstname;
                    $shipping->lastname= $this->s_lastname;
                    $shipping->email= $this->s_email;
                    $shipping->mobile= $this->s_mobile;
                    $shipping->line1= $this->s_line1;
                    $shipping->line2= $this->s_line2;
                    $shipping->city= $this->s_city;
                    $shipping->country= $this->s_country;
                    $shipping->province= $this->s_province;
                    $shipping->zipcode= $this->s_zipcode;
                  
                    $shipping->save();


                }

            if($this->paymentmode == 'cod')
            {
                 $this->makeTransction($order->id ,'pending');
                 $this->resetCart();
   
            }
            elseif ($this->paymentmode =='card')
            {
             $stripe =Stripe::make(env('STRIPE_API_KEY'));
              try
               {
                $token = $stripe->tokens()->create([
                  'card' => [
                      'number'    => $this->card_no,
                      'exp_month' => $this->exp_month,
                      'exp_year'  => $this->exp_year,
                      'cvc'       => $this->cvc
                  ],
              ]);
            
                 if(!isset($token['id']))

                  {
                   
                    session()->flash('stripe_error','Stripe token was not generated correctly');
                    $this->thankyou =0;

                  }

                  $customer = $stripe->customers()->create([
                    'name' => $this->firstname.''.$this->lastname,
                    'email' => $this->email,
                    'phone' => $this->mobile,
                     'address' =>[
                          'line1' => $this->line1,
                          'postal_code' => $this->zipcode,
                          'city' => $this->city,
                          'province' => $this->province,
                          'country' => $this->country,
                     ],
                     'shipping' =>[
                      'name' => $this->firstname.''.$this->lastname,
                      'address' =>[
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode,
                        'city' => $this->city,
                        'province' => $this->province,
                        'country' => $this->country,
                  
                      ],
                 
                    ],
                      'source' =>$token['id'], 
                  ]);   
                  
                  $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount'   => session()->get('checkout')['total'],
                    'description'   => 'Payment for the Order No'.$order->id
                  ]);

                  if ($charge['status']=='succeeded') {
                    $this->makeTransction($order->id ,'approved');
                    $this->resetCart();
                  } else {
                    session()->flash('stripe_error','Error in Transaction!');
                    $this->thankyou =0 ;
                  }
                  

              } catch(Exception $e) {

                  session()->flash('stripe_error',$e->getMessage());
                  $this->thankyou =0 ;

              }


            }
              
              

        }
               public function makeTransction($order_id ,$status)
               {
               
                $transaction = new Transaction();
                $transaction->user_id =Auth::user()->id;
                $transaction->order_id =$order_id;
                $transaction->mode ='cod';
                $transaction->status =$status;
                $transaction->save();
                
               }
                public function resetCart()
                {

                  $this->thankyou =1;
                  Cart::instance('cart')->destroy();
                  session()->forget('checkout');


                }


            public function verifyForCheckOut()
            {

              if(!Auth::check())
              {
               return redirect()->route('login');

              }
             else if($this->thankyou)
             {
                return redirect()->route('thankyou');
             }
           else if(!session()->get('checkout'))
           {

            return redirect()->route('product.cart');


           }

                
            }


    public function render()
    {
         $this->verifyForCheckOut();
        return view('livewire.checkoutcomponent')->layout('layouts/base');
    }
}
