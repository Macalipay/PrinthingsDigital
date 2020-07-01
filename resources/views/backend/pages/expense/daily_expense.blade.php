@extends('backend.master.template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Expense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Add Expense</button>
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
                <h3 class="card-title">List of Daily Expense</h3>
              </div>
        @include('backend.partials.flash-message')

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Expense Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Payment Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($expenses as $key => $expense)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$expense->expenseType->name}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->description}}</td>
                            <td>{{$expense->payment_type}}</td>
                            <td>
                                <div class="form-group" style="display:inline-flex">
                                        <a class="btn btn-success btn-sm mr-1 edit" title="Edit" data-toggle="modal" data-target="#modal-lg" id={{$expense->id}}><i class="fa fa-edit"></i></a>
                                        <form class="form-horizontal" method="get" action="{{ url('expense/destroy/'. $expense->id)}}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                </div>
                            </td>
                        </tr>  
                    @endforeach
                  </tbody>
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
          <h4 class="modal-title">Add Expense</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="expense-form" action="{{ url('expense/save') }}"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputPassword1">Date</label>
                <input type="date" class="form-control" id="expense_date" name="expense_date" value="<?php echo date("Y-m-d"); ?>">
              </div>
              <div class="form-group">
                  <label>Expense Type</label>
                  <select class="form-control" id="expense_id" name="expense_id">
                    @foreach ($expensetypes as $expensetype)
                      <option value="{{$expensetype->id}}">{{$expensetype->name}}</option>
                    @endforeach
                  </select>
              </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                  <label>Payment Type</label>
                  <select class="form-control" id="payment_type" name="payment_type">
                    <option>Cash</option>
                    <option>BDO</option>
                    <option>BPI</option>
                    <option>PNB</option>
                    <option>GCash</option>
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
                url: '/expense/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Expense');
                    $('.user-button').text('Update');

                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                    $('#expense-form').attr('action', 'expense/update/' + data.expenses.id);
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