<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Manage Sale
                            </div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal" wire:submit.prevent="updateSale" >
                      <div class="form-group">
                                <label class="col-md-4 control-label">Status</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="status">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Date</label>
                                <div class="col-md-4">
                                    <input type="text"  id="sale_date" placeholder="YYYY/MM/DD H:M:S" class="form-control input-md" wire:model="sale_date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
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
@push('scripts')
<script>
    $(function(){
  $('#sale_date').datetimepicker({
         format:'Y-MM-DD h:m:s',

  }) 
  .on('dp.change',function(ev){
      var data = $('#sale_date').val();
      @this.set('sale_date',data);


  });


});

    
    
    </script>    
@endpush

