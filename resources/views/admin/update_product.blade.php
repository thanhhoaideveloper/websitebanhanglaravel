@extends('admin_layout')
@section('content')
    <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm sản phẩm
            </header>
            <?php 
            $message = Session::get('messages');
            if($message){
                echo "Thong bao:".$message;
             }
            ?>
            <div class="panel-body">
                @foreach($update_product as $key => $product)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-value-product/'.$product->product_id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" value="{{$product->product_name}}" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Nhập thương hiệu">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea class="form-control "  id="ccomment" name="product_desc" required="" resize="none" row="5">{{$product->product_desc}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea class="form-control "  id="ccomment" name="product_content" required="" resize="none" row="5">{{$product->product_content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                        <input type="file"  class="form-control" name="product_image" id="exampleInputEmail1">
                        <img style="width:100px;height:100px" src="{{asset('uploads/product/'.$product->product_image)}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá</label>
                        <input type="text"  value="{{$product->product_price}}" class="form-control" name="product_price" id="exampleInputEmail1">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Danh mục</label>
                        <select name="category_id" class=form-control input-sm m-bot15>
                            @foreach($category as $key => $cate)
                                @if($cate->category_id == $product->category_id)
                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                             @endforeach                      
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Thương hiệu</label>
                        <select name="brand_id" class=form-control input-sm m-bot15>
                            @foreach($brand as $key => $brand)
                                @if($brand->brand_id == $product->category_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>  
                                @else
                                    <option  value="{{$brand->brand_id}}">{{$brand->brand_name}}</option> 
                                @endif
                        @endforeach                       
                        </select>
                    </div>   
                    <button type="submit" class="btn btn-info">Sửa</button>
                </form>
                </div>
            @endforeach
            </div>
        </section>

    </div>
@endsection