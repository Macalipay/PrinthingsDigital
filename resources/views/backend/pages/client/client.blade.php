@extends('backend.master.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Add Client</button>
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
                <h3 class="card-title">List of all Client</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Company Address</th>
                    <th>Client Type</th>
                    <th>Market Source</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $key => $client)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$client->firstname . ' ' . $client->lastname}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->contact}}</td>
                            <td>{{$client->company}}</td>
                            <td>{{$client->company_address}}</td>
                            <td>{{$client->client_type}}</td>
                            <td>{{$client->market_source}}</td>
                            <td>
                                <div class="form-group" style="display:inline-flex">
                                        <a class="btn btn-success btn-sm mr-1 edit" title="Edit" data-toggle="modal" data-target="#modal-lg" id={{$client->id}}><i class="fa fa-edit"></i></a>
                                        <form class="form-horizontal" method="get" action="{{ url('client/destroy/'. $client->id)}}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
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
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Company Address</th>
                    <th>Client Type</th>
                    <th>Market Source</th>
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
            <form method="POST" id="client-form" action="{{ url('client/save') }}"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Firstname</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Lastname</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact">
                </div>
               
                <div class="form-group">
                    <label for="exampleInputEmail1">Company</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Enter Company">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Address</label>
                    <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Enter Company Address">
                </div>
                <div class="form-group">
                    <label>Client Type</label>
                    <select class="form-control" id="client_type" name="client_type">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Market Source</label>
                    <select class="form-control" id="market_source" name="market_source">
                      <option>Market Place</option>
                      <option>Natural Market</option>
                      <option>Referral</option>
                      <option>Walk-in</option>
                    </select>
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
                url: '/client/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Client');
                    $('.user-button').text('Update');

                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                    $('#client-form').attr('action', 'client/update/' + data.clients.id);
                }
            });
        }

        $(document).ready(function(){
            $('.edit').click(function() {
                edit(this.id);
            });
        })        
    </script>
@endsection