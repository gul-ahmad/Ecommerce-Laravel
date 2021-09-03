<div>
    <style>
       nav svg{
      height: 20px;

       }
       nav .hidden{
       display: block !important;


       }


    </style>
   <div class="container" style="padding:30px 0;">
      <div class="row">
          <div class="col-md-12">
             <div class="panel panel-default">
                 <div class="panel-heading">
                   <div class="row">
                     <div class="col-md-6">
                         All Coupons
                     </div>
                     <div class="col-md-6">
                      <a href="{{route('admin.addcoupons')}}" class="btn btn-success pull-right">Add Coupons</a>
                     </div>


                   </div>
                 </div>
                 <div class="panel-body">
                     <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Coupons Code</th>
                                 <th>Coupons Type</th>
                                 <th>Coupon Value</th>
                                 <th>Coupon Cart Value</th>
                                 <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->code}}</td>
                                @if ($coupon->type =='fixed')
                                <td>{{$coupon->type}}</td>
                                
                                    
                                @else
                                <td>{{$coupon->type}}%</td>
                                    
                                @endif
                                
                                <td>{{$coupon->cart}}</td>
                                <td>{{$coupon->cart_value}}</td>
                                <td>
                                 <a href="{{route('admin.editcoupon',['coupon_id'=>$coupon->id])}}" ><i class="fa fa-edit fa-2x"></i></a>   
                                 <button type="button" wire:click ="deleteConfirm({{$coupon->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i></button>   
                                </td>

                                
                            </tr>
                                
                            @endforeach

                         </tbody>
                     </table>
                   {{--   {{$coupons->links()}} --}}
                 </div>
             </div>
          </div>
      </div>
   </div>
</div>
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>


window.addEventListener('swal:confirm', event => { 
    swal({
      title: event.detail.title,
      text: event.detail.text,
      icon: event.detail.type,
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.livewire.emit('deleteCategory',event.detail.id);
      }
    });
});
window.addEventListener('swal:modal', event => { 
    swal({
      title: event.detail.title,
      text: event.detail.text,
      icon: event.detail.type,
    });
});


</script>

