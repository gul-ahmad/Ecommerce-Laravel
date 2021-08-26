<div>
   <div class="container" style="padding: 30px 0">
       <div class="row">
            <div class="col-md-12">
                 <div class="panel panel-default">

                       <div class="panel-heading">Manage Home Categories</div>
                       <div class="panel-body">
                            <form action="" class="form-horizontal" wire:submit.prevent ="updateHomeCategory">
                              <div class="form-group">
                                  <label for="" class="col-md-4 control-label">Choose Categories</label>
                                    <div class="col-md-4" wire:ignore>
                                        <select  class="form-control select-categories" name="categories[]"  multiple="multiple" wire:model="selected_categories">                                        @foreach ($categories as $category)
                                           <option value="{{$category->id}}">{{$category->name}}</option>
                                               
                                           @endforeach
                                    </select>

                                    </div>

                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-4 control-label">No Of Products</label>
                                  <div class="col-md-4">
                                      <input class="form-control input-md" type="text" placeholder="No of Products" wire:model="noofproducts"/>
                                  </div>

                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                  <div class="col-md-4">
                                      <button  type="submit" class="btn btn-primary">save</button>
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



@push('scripts')
<script>
   $(document).ready(function(){
     $('.select-categories').select2();
     $('.select-categories').on('change', function (e) {
            var data = $('.select-categories').select2("val");
            @this.set('selected_categories', data);
        });
    


   });

    </script>
@endpush

