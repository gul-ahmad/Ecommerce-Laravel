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
                         All Products
                     </div>
                     <div class="col-md-6">
                      <a href="{{route('admin.addproduct')}}" class="btn btn-success pull-right">Add Product</a>
                     </div>


                   </div>
                 </div>
                 <div class="panel-body">
                     <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Image</th>
                                 <th>Name</th>
                                 <th>Stock</th>
                                 <th>Price</th>
                                 <th>Sale Price</th>
                                 <th>Category</th>
                                 <th>Date</th>
                                 <th>Action</th>
                                 <th></th>

                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{asset('assets/images/products')}}/{{$product->image}}" width="60px"></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->stock_status}}</td>
                                <td>{{$product->regular_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->created_at}}</td>
                                <td>
                                 <a href="{{route('admin.editproduct',['product_id'=>$product->id])}}" ><i class="fa fa-edit fa-2x"></i></a>   
                                 <button type="button" wire:click ="deleteConfirm({{$product->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i></button>   
                                </td>
 
                                
                            </tr>
                                
                            @endforeach

                         </tbody>
                     </table>
                     {{$products->links()}}
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
        window.livewire.emit('deleteProduct',event.detail.id);
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
