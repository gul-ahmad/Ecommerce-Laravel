<div>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Product
                            </div>
                            <div class="col-md-6"><a href="{{ route('admin.products') }}" class="btn btn-success pull-right">All Products</a></div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" class="form-horizontal" wire:submit.prevent="updateProduct" enctype="multipart/form-data" >
                           {{--  @if(Session::has('success_message'))
                            <div class="alert alert-success" role="alert">
                             {{Session::get('success_message')}}

                            </div>
                            @endif --}}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name" placeholder="Product Name" class="form-control input-md" wire:model="name" wire:keyup="generateSlug"/>
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                    <input type="text" name="slug" id="slug" placeholder="Product Slug" class="form-control input-md" wire:model="slug" />
                                    @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                         <div class="form-group">
                                <label for="short_description" class="col-md-4 control-label">Short Description</label>
                                <div class="col-md-4">
                                    <textarea name="short_description"
                                     id="short_description" 
                                     placeholder="Short Description"
                                      class="form-control"
                                       wire:model="short_description">
                                </textarea>
                                @error('short_description') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4">
                                    <textarea  placeholder="Description" class="form-control"  wire:model="description"></textarea>
                                    @error('description') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4">
                                    <input type="text" name="regular_price" id="regular_price" placeholder="Price" class="form-control input-md" wire:model="regular_price">
                                    @error('regular_price') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                    <input type="text" name="sale_price" id="sale_price" placeholder="Sale Price" class="form-control input-md" wire:model="sale_price">
                                    @error('sale_price') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" name="sku" id="sku" placeholder="SKU" class="form-control input-md" wire:model="SKU">
                                    @error('SKU') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label">Stock Status</label>
                                <div class="col-md-4">
                                    <select  class="form-control" wire:model="stock_status">
                                    <option value="instock">instock</option>
                                    <option value="outofstock">outofstock</option>
                                    </select>
                                    @error('stock_status') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select  class="form-control" wire:model="featured">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control input-md" wire:model="quantity">
                                    @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                    <input type="file"  class="input-file" wire:model="imageNew" />
                                    @if($imageNew)
                                    <img src="{{$imageNew->temporaryUrl()}}" width="120px"/>
                                    @else
                                    <img src="{{asset('assets/images/products')}}/{{$image}}" width="120px"/>
                                    @endif
                                    @error('imageNew') <span class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-md-4 control-label">Product Category</label>
                                <div class="col-md-4">
                                    <select  class="form-control" wire:model="category_id">
                                        <option value="">Select Category<option>
                                          @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->name}}</option>    
                                          @endforeach  
                                    
                                    </select>
                                    @error('category_id') <span class="error text-danger">{{ $message }}</span> @enderror

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


