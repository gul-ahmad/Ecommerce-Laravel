<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Slider
                            </div>
                            <div class="col-md-6"><a href="{{ route('admin.sliders') }}" class="btn btn-success pull-right">All Sliders</a></div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal" wire:submit.prevent="addSlide" enctype="multipart/form-data" >
                           {{--  @if(Session::has('success_message'))
                            <div class="alert alert-success" role="alert">
                             {{Session::get('success_message')}}

                            </div>
                            @endif --}}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Title</label>
                                <div class="col-md-4">
                                    <input type="text" name="title" id="title" placeholder="Title" class="form-control input-md" wire:model="title"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Sub title</label>
                                <div class="col-md-4">
                                    <input type="text" name="subtitle" id="subtitle" placeholder="Sub Title" class="form-control input-md" wire:model="subtitle" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-4">
                                    <input type="text" name="price" id="price" placeholder="Price" class="form-control input-md" wire:model="price" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Link</label>
                                <div class="col-md-4">
                                    <input type="text" name="link" id="link"  class="form-control input-md" wire:model="link" />
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Image</label>
                                <div class="col-md-4">
                                    <input type="file"  class="input-file" wire:model="image" />
                                   @if($image)
                                    <img src="{{$image->temporaryUrl()}}" width="120px"/>
                                    @endif 
                                </div>
                            </div>

                           
                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label"> Status</label>
                                <div class="col-md-4">
                                    <select  class="form-control" wire:model="stock_status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>

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


