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
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Nhập thương hiệu">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea class="form-control " id="ccomment" name="product_desc" required="" resize="none" row="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea class="form-control " id="ccomment" name="product_content" required="" resize="none" row="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá</label>
                        <input type="text" class="form-control" name="product_price" id="exampleInputEmail1">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Danh mục</label>
                        <select name="category_id" class=form-control input-sm m-bot15>
                            @foreach($category as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>    
                            @endforeach            
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Thương hiệu</label>
                        <select name="brand_id" class=form-control input-sm m-bot15>
                            @foreach($brand as $key => $b)
                                <option value="{{$b->brand_id}}">{{$b->brand_name}}</option>    
                            @endforeach                       
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select name="product_status" class=form-control input-sm m-bot15>
                            <option value="0">Ẩn</option>        
                            <option value="1">Hiện</option>                    
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-info">Thêm</button>
                </form>
                </div>

            </div>
        </section>

    </div>
@endsection