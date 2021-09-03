<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Coupon
                            </div>
                            <div class="col-md-6"><a href="{{ route('admin.coupons') }}" class="btn btn-success pull-right">All Coupons</a></div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal" wire:submit.prevent="updatecoupon" >
                            @if(Session::has('success_message'))
                            <div class="alert alert-success" role="alert">
                             {{Session::get('success_message')}}

                            </div>
                            @endif
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Coupon Code</label>
                                <div class="col-md-4">
                                    <input type="text" name="code" id="code" placeholder="Coupon Code" class="form-control input-md" wire:model="code">
                                    @error('code') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Coupon Type</label>
                                <div class="col-md-4">
                                    <select  class="form-control" wire:model="type">
                                        <option value="">Select Type<option>
                                         
                                          <option value="fixed">Fixed</option>
                                          <option value="percent">Percent</option>    
                                    
                                    </select>
                                    @error('type') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                    <input type="text" name="value" id="value" placeholder="Coupon value" class="form-control input-md" wire:model="value">
                                    @error('value') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-md-4 control-label">Cart Value</label>
                                <div class="col-md-4">
                                    <input type="text" name="cart_value" id="value" placeholder="Cart value" class="form-control input-md" wire:model="cart_value">
                                    @error('cart_value') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>
                            </div>

                        </form>

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
window.addEventListener('swal:modal', event => { 
    swal({
      title: event.detail.title,
      text: event.detail.text,
      icon: event.detail.type,
    });
});




</script>

