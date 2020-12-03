@extends('admin_layout')
@section('content')
    <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm thương hiệu sản phẩm
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                        <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" placeholder="Nhập thương hiệu">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                        <textarea class="form-control " id="ccomment" name="brand_desc" required="" resize="none" row="5"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select name="brand_status" class=form-control input-sm m-bot15>
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