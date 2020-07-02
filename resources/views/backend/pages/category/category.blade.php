@extends('backend.master.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Add Category</button>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of all Category</h3>
              </div>
            @include('backend.partials.flash-message')

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <div class="form-group" style="display:inline-flex">
                                        <a class="btn btn-success btn-sm mr-1 edit" title="Edit" data-toggle="modal" data-target="#modal-lg" id={{$category->id}}><i class="fa fa-edit"></i></a>
                                        <form class="form-horizontal" method="get" action="{{ url('category/destroy/'. $category->id)}}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" onclick="return confirm('Are you sure?')"></i></button>
                                        </form>
                                </div>
                            </td>
                        </tr>  
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Order</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="category-form" action="{{ url('category/save') }}"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Firstname">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter Lastname">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('scripts')
    <script>
        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/category/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Category');
                    $('.user-button').text('Update');

                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                    $('#category-form').attr('action', 'category/update/' + data.categories.id);
                }
            });
        }

        $(document).ready(function(){
          $("#example2").DataTable({
              "autoWidth": false,
              "scrollX": true
            });

            $('.edit').click(function() {
                edit(this.id);
            });
        })        
    </script>
@endsection