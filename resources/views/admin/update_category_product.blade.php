@extends('admin_layout')
@section('content')
    <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Sửa danh mục sản phẩm
            </header>
            <?php 
                $message = Session::get('message');
                if($message){
                    echo "Thong bao:".$message;
                }
            ?>
            <div class="panel-body">
                @foreach($update_category_product as $key => $category_update)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-value-product/'.$category_update->category_id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Danh Mục</label>
                        <input value={{$category_update->category_name}} type="text" class="form-control" name="category_name" id="exampleInputEmail1" placeholder="Nhập Tên sản phẩm">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea class="form-control " id="ccomment" name="category_desc" required="" style="resize: none" resize="none" rows="8">{{$category_update->category_desc}} 
                        </textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-info">Sửa</button>
                </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection