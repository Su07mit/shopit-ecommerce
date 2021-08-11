@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Admin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>

            <div class="info-box-content">
                <a href="{{ route('admin.users.index') }}">                
                    <span class="info-box-text fas-fa">Users</span>
                </a>
                <span class="info-box-number">
                  {{ $users->count() }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <a href="{{ route('admin.products.index') }}">                
                    <span class="info-box-text fas-fa">Products</span>
                </a>
                <span class="info-box-number">
                  {{ $products->count() }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-clipboard-list"></i></span>

            <div class="info-box-content">
                <a href="{{ route('admin.users.index') }}">                
                    <span class="info-box-text fas-fa">Categories</span>
                </a>
                <span class="info-box-number">
                  {{ $categories->count() }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            
            <!-- /.card -->
            
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      {{-- <th>Item</th> --}}
                      <th>Status</th>
                      <th>Popularity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      @foreach ($orders as $order)
                      {{-- @foreach ($products as $product ) --}}
                      <td><a href="#">{{ $order->id }}</a></td>
                      {{-- <td>{{ $product->name }}</td> --}}
                      <td><span class="badge badge-success">{{ $order->status }}</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"></div>
                      </td>
                    </tr>
                    
                      {{-- @endforeach --}}
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ route('admin.orders.create')}}" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="{{ route('admin.orders.create')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">            
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach ($products as $product )
                    <li class="item">
                    <div class="product-img">
                      <img src="{{ $product->image }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="{{ route('admin.products.index') }}" class="product-title">{{ $product->name }}
                        <span class="badge badge-warning float-right">{{ $product->price }}</span></a>
                      <span class="product-description">
                       
                      </span>
                    </div>
                  </li>
                  @endforeach 
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{ route('admin.products.index') }}" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- Main content -->
                </div>
            </div>
        </div>
    </div>
@stop
