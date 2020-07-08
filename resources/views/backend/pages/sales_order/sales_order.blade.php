@extends('backend.master.template')
@section('link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg" id="add_button">Add Order</button>
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
                <h3 class="card-title">List of all Orders</h3>
              </div>
              <!-- /.card-header -->
        @include('backend.partials.flash-message')

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    {{-- <th>Code</th> --}}
                    <th>Order Date</th>
                    <th>Client</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount Paid</th>
                    <th>Bal.</th>
                    <th>Due Date</th>
                    <th>Order Status</th>
                    <th>Layout Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($sales_orders as $key => $sales_order)
                        <tr>
                            <td>{{++$key}}</td>
                            {{-- <td>{{$sales_order->code}}</td> --}}
                            <td>{{date('M-d-y', strtotime($sales_order->order_date))}}</td>
                            <td>{{$sales_order->client->firstname . ' ' . $sales_order->client->lastname}}</td>
                            <td>{{$sales_order->category->name}}</td>
                            <td>{{$sales_order->details}}</td>
                            <td>{{$sales_order->quantity}}</td>
                            <td>{{$sales_order->unit_price}}</td>
                            <td>{{$sales_order->paid_amount}}</td>
                            <td>{{$sales_order->balance}}</td>
                            <td>{{date('M-d-y', strtotime($sales_order->due_date))}}</td>
                            {{-- LAYOUT STATUS --}}
                            @if ($sales_order->order_status == 'Done')
                            <td><span class="badge bg-success">{{$sales_order->order_status}}</span></td>
                            @elseif($sales_order->order_status == 'For Delivery')
                                <td><span class="badge bg-warning">{{$sales_order->order_status}}</span></td>
                            @else
                                <td><span class="badge bg-danger">{{$sales_order->order_status}}</span></td>
                            @endif
                            {{-- ORDER STATUS --}}
                            @if ($sales_order->layout_status == 'Done')
                                <td><span class="badge bg-success">{{$sales_order->layout_status}}</span></td>
                            @elseif($sales_order->layout_status == 'On-going')
                                <td><span class="badge bg-warning">{{$sales_order->layout_status}}</span></td>
                            @else
                                <td><span class="badge bg-danger">{{$sales_order->layout_status}}</span></td>
                            @endif
                            {{-- PAYMENT STATUS --}}
                            @if ($sales_order->balance == 0)
                              <td><span class="badge bg-success">Paid</span></td>
                            @else
                              <td><span class="badge bg-danger">{{$sales_order->payment_status}}</span></td>
                            @endif
                            <td>
                                <div class="form-group" style="display:inline-flex">
                                    <a class="btn btn-success btn-sm mr-1 edit" title="Edit" data-toggle="modal" data-target="#modal-lg" id={{$sales_order->id}}><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-info btn-sm mr-1 order" title="Order" data-toggle="modal" data-target="#modal-sm" id={{$sales_order->id}}><i class="fa fa-truck"></i></a>
                                    <a class="btn btn-warning btn-sm mr-1 layout" title="Layout" data-toggle="modal" data-target="#modal-sm" id={{$sales_order->id}}><i class="fa fa-pen-nib"></i></a>
                                    <a class="btn btn-primary btn-sm mr-1 pay" title="Layout" data-toggle="modal" data-target="#modal-pay" id={{$sales_order->id}}><i class="fa fa-money-bill-alt"></i></a>
                                        <form class="form-horizontal" method="get" action="{{ url('sales_order/destroy/'. $sales_order->id)}}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" onclick="return confirm('Are you sure?')"></i></button>
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
          <h4 class="modal-title">Add Order</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="client-form" action="{{ url('sales_order/save') }}"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Order Date</label>
                  <input type="date" class="form-control" id="order_date" name="order_date" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="form-group">
                    <label>Client</label>
                    <select class="form-control" id="client_id" name="client_id">
                      @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->firstname . ' ' . $client->lastname}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Details/Notes</label>
                    <textarea class="form-control" rows="3" id="details" name="details" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Unit Price</label>
                    <input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="Enter Unit Price">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo date("Y-m-d"); ?>">
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

  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Layout</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" value="" id="layout_value" hidden>
            <input type="text" value="" id="url_value" hidden>
            <button class="btn btn-danger layout-button">Pending</button>
            <button class="btn btn-warning layout-button" id="change-status">On-going</button>
            <button class="btn btn-success layout-button" id="change-status-2">Done</button>
        </div>
        <div class="modal-footer justify-content-between">

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade" id="modal-pay">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" value="" id="pay_id" hidden>
            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="paid_amount" name="paid_amount" placeholder="Enter Unit Price">
            </div>
            <div class="form-group">
              <label>Payment Type</label>
              <select class="form-control" id="type" name="type">
                <option>Cash</option>
                <option>BDO</option>
                <option>BPI</option>
                <option>PNB</option>
                <option>GCash</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Date</label>
              <input type="date" class="form-control" id="payment_date" name="payment_date" value="<?php echo date("Y-m-d"); ?>">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" style="float:right" id="pay_button">Pay</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('scripts')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.0.0/js/buttons.html5.min.js" crossorigin="anonymous"></script>

    <script>
        function edit(id){
            $.ajax({
                url: '/sales_order/edit/' + id,
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
                    $('#client-form').attr('action', 'sales_order/update/' + data.sales_orders.id);
                }
            });
        }

        function pay(id){
            $.ajax({
                url: '/sales_order/payment/' + id,
                method: 'get',
                data: {
                   paid_amount: $('#paid_amount').val(),
                   type:$('#type').val(),
                   payment_date: $('#payment_date').val()
                },
                success: function(data) {
                  location.reload();
                }
            });
        }

        $(document).ready(function(){
          $("#example1").DataTable({
            
              dom: 'Bfrtip',
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5'
              ]
            });

            $('.edit').click(function() {
                edit(this.id);
            });

            $('.layout').click(function(){
                $('#change-status').text('On-going')
                $('#layout_value').val(this.id);
                $('#url_value').val('layout');
            })

            $('.order').click(function(){
                $('#change-status').text('For Delivery')
                $('#layout_value').val(this.id);
                $('#url_value').val('order');
            })

            $('.pay').click(function(){
                $('#pay_id').val(this.id);
            })

            $('#pay_button').click(function(){
                pay($('#pay_id').val());
            })

            $('.layout-button').click(function(){
               var status = $(this).text();
               var url = $('#url_value').val();
                $.ajax({
                    url: '/sales_order/'+ url +'/' + $('#layout_value').val() + '/' + status,
                    method: 'get',
                    data: {

                    },
                    success: function(data) {
                      location.reload();
                    }
                });
            })
        })        
    </script>
@endsection