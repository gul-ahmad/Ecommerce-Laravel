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
                         All Categories
                     </div>
                     <div class="col-md-6">
                      <a href="{{route('admin.addcategory')}}" class="btn btn-success pull-right">Add Category</a>
                     </div>


                   </div>
                 </div>
                 <div class="panel-body">
                     <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Category Name</th>
                                 <th>Category Slug</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                 <a href="{{route('admin.editcategory',['category_slug'=>$category->slug])}}" ><i class="fa fa-edit fa-2x"></i></a>   
                                 <button type="button" wire:click ="deleteConfirm({{$category->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i></button>   
                                </td>

                                
                            </tr>
                                
                            @endforeach

                         </tbody>
                     </table>
                     {{$categories->links()}}
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
