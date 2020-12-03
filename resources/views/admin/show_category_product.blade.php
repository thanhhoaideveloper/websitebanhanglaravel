@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh mục sản phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <input type="checkbox" name="post[]"><i>
              </th>
              <th>Tên danh mục</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($show_category_product as $key => $category_product)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $category_product->category_name }}</td>
              <td><a class="status" href="{{URL::to('/update-category-status/'.$category_product->category_id)}}">
                <?php 
                    if($category_product->category_status==0){
                      echo "Ẩn";
                    }
                    else {
                      echo "Hiện";
                    }
                  ?>
                  </a>
              </td>
              <td class="action_category" style="width:100px;">
                <a href="{{URL::to('/update-category-product/'.$category_product->category_id)}}" ui-toggle-class="" class="styling-action-product"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                <a onclick="return confirm('Bạn có thực sự muốn xóa sản phẩm ?')" href="{{URL::to('/delete-category-product/'.$category_product->category_id)}}" ui-toggle-class="" class="styling-action-product"><i class="fa fa-times text-danger text"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection