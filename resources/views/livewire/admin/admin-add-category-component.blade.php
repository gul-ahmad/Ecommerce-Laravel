<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Category
                            </div>
                            <div class="col-md-6"><a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Categories</a></div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal" wire:submit.prevent="storeCategory" >
                            @if(Session::has('success_message'))
                            <div class="alert alert-success" role="alert">
                             {{Session::get('success_message')}}

                            </div>
                            @endif
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name" placeholder="Category Name" class="form-control input-md" wire:model="name" wire:keyup="generateslug">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" name="slug" id="slug" placeholder="Category Slug" class="form-control input-md" wire:model="slug">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label"></label>
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

