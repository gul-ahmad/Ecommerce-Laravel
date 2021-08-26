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
                         All Sliders
                     </div>
                     <div class="col-md-6">
                      <a href="{{route('admin.addslider')}}" class="btn btn-success pull-right">Add Slider</a>
                     </div>


                   </div>
                 </div>
                 <div class="panel-body">
                     <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th>Image</th>
                                 <th>Title</th>
                                 <th>Sub Title</th>
                                 <th>Price</th>
                                 <th>Link</th>
                                 <th>Status</th>
                                 
                                 <th>Action</th>
                                 

                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                               
                                <td><img src="{{asset('assets/images/sliders')}}/{{$slider->image}}" width="60px"></td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->subtitle}}</td>
                                <td>{{$slider->price}}</td>
                                <td>{{$slider->link}}</td>
                                <td>{{$slider->status == 1 ? 'Active':'InActive'}}</td>
                                <td>
                                 <a href="{{route('admin.editslider',['slider_id'=>$slider->id])}}" ><i class="fa fa-edit fa-2x"></i></a>   
                                 <button type="button" wire:click ="deleteConfirm({{$slider->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i></button>   
                                </td>
 
                                
                            </tr>
                                
                            @endforeach

                         </tbody>
                     </table>
                     {{$sliders->links()}}
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
        window.livewire.emit('deleteSlider',event.detail.id);
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
