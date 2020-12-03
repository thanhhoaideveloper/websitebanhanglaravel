@extends('admin_layout')
@section('content')
    <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm Sản Phẩm
            </header>
            <?php 
                $message = Session::get('message');
                if($message){
                    echo "Thong bao:".$message;
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Danh Mục</label>
                        <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" placeholder="Nhập Tên sản phẩm">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea class="form-control " id="ccomment" name="category_desc" required="" resize="none" row="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="category_status" class=form-control input-sm m-bot15>
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