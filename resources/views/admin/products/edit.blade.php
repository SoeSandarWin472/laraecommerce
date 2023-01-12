@extends('layouts.admin')

@section('content')

<div class="row">
            <div class="col-md-12">

                 @if (session('message'))
                            <h5 class="alert alert-success mb-2">{{session('message')}}</h5>
                        @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Edit Product
                            <a href="{{url('admin/products')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                            
                        @endif
                        <form action="{{url('admin/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag" type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO Tags</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
  </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Product Image</button>
  </li>
   <li class="nav-item" role="presentation">
    <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab">Product Colors</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade  border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="mb-3">
        <label for="">Select Category</label>
        <select name="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}}>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="">Product Name</label>
        <input type="text" name="name" value="{{$product->name}}" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Product Slug</label>
        <input type="text" name="slug" value="{{$product->slug}}" class="form-control">
    </div>

    <div class="mb-3">
      <label for="">Select Brand</label>
        <select name="brand" class="form-control">
            @foreach ($brands as $brand)
            <option value="{{$brand->name}}" {{$brand->name == $product->brand ? 'selected':''}}>
                {{$brand->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="">Small Description(500 Words)</label>
        <textarea name="small_description" class="form-control" rows='4'>{{$product->small_description}}</textarea>
    </div>
    <div class="mb-3">
        <label for="">Description </label>
        <textarea name="description" class="form-control" rows='4'>{{$product->description}}</textarea>
    </div>
  </div>

  <div class="tab-pane fade border p-3 " id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
    <div class="mb-3">
        <label for="">Meta Title</label>
        <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Meta Description</label>
        <textarea name="meta_description" class="form-control" rows='4'>{{$product->meta_description}}</textarea>
    </div>
    <div class="mb-3">
        <label for="">Meta Keyword </label>
        <textarea name="meta_keyword" class="form-control" rows='4'>{{$product->meta_keyword}}</textarea>
    </div>
  </div>

  <div class="tab-pane fade border p-3 " id="details" role="tabpanel" aria-labelledby="details-tab">
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="">Original Price</label>
                <input type="text" name="original_price" value="{{$product->original_price}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="">Selling Price</label>
                <input type="text" name="selling_price" value="{{$product->selling_price}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="">Quantity</label>
                <input type="text" name="quantity" value="{{$product->quantity}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="">Trending </label>
                <input type="checkbox" name="trending"value="{{$product->trending=='1'?'hidden':'visible'}}" style="width:50px;height:50px"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="">Status</label>
                <input type="checkbox" name="status" value="{{$product->status=='1'?'hidden':'visible'}}" style="width:50px;height:50px"/>
            </div>
        </div>
    </div>
  </div>

  <div class="tab-pane fade border p-3 " id="image" role="tabpanel" aria-labelledby="image-tab">
    <div class="mb-3">
        <label for="">Upload Images</label>
        <input type="file" name="image[]" multiple class="form-control">
    </div>
    <div>
        @if ($product->productImages)
        <div class="row">
            @foreach($product->productImages as $image)
            <div class="col-md-2">
            <img src="{{asset($image->image)}}" style="width: 80px;height:80px;" class="me-4 border" alt="Img" />
            <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Remove</a>
            </div>
            @endforeach
            </div>
        @else
            <h5>No Image Added</h5>
        @endif
    </div>
  </div>

  <div class="tab-pane fade border p-3 " id="color" role="tabpanel">
   <div class="mb-3">
    <h4>Add Product Color</h4>
        <label for="">Select Color</label>
        <hr />
        <div class="row">
        @forelse ($colors as $coloritem)
            <div class="col-md-3">
                <div class="p-2 border mb-3">

                Color:<input type="checkbox" name="colors[{{$coloritem->id}}]" value="{{$coloritem->id}}"/>
                {{$coloritem->name}}<br>
                Quantity:<input type="number" name="colorquantity[{{$coloritem->id}}]" style="width: 70px;border:1px solid">
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <h1>No colors found</h1>
            </div>
        @endforelse
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <td>Color Name</td>
                    <td>Quantity</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->productColors  as $prodColor)
                <tr class="prod-color-tr">
                    <td>
                        @if ($prodColor->color)
                            {{$prodColor->color->name}}
                        @else
                            No Color Found
                        @endif
                    </td>
                    <td>
                        <div class="input-group mb-3" style="width: 150px">
                         <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm">
                         <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                    </td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="py-2 float-end">
    <button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
                    </div>
                </div>
            </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).on('click','.updateProductColorBtn',function(){

            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

            var product_id="{{$product->id}}";
            var prod_color_id=$(this).val();
            var qty=$(this).closest('.prod-color-tr').find('.productColorQuantity').val();
           // alert(prod_color_id);

           if(qty <=0){
                alert('Quantity is required');
                return false;
           }

           var data={
            'product_id':product_id,
            'qty':qty
           };

            $.ajax({
               type:'POST',
               url:'/admin/product-color/'+prod_color_id,
               data:data,
               success:function(response) {
                  alert(response.message)
               }
            });

             $(document).on('click','.deleteProductColorBtn',function(){

                var prod_color_id=$(this).val();
                var thisClick=$(this);

                $.ajax({
               type:'GET',
               url:'/admin/product-color/'+prod_color_id+'/delete',
               success:function(response) {
                thisClick.closest('.prod-color-tr').remove();
                alert(response.message);
               }
            });
             });
        });
    </script>
@endsection