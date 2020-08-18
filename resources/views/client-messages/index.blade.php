@extends('layouts.app')

@section('page_title')
Client Messages
@endsection
@section('additional_styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('adminlte/plugins/css/responsive.bootstrap4.min.css')}}" />
@endsection
@section('additional_scripts')
<script src="{{asset('adminlte/plugins/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
        $("#table").DataTable({
          responsive: true,
          autoWidth: false,
          paging:false,
          searching:false,
          info:false,
        });});
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
  @include('flash::message')
  <!-- Default box -->
  <div class="row justify-content-end mr-4 mb-3" id="filter-tools">

    <form class="form-inline ml-3" id="filter" action="{{ route('message.index') }}">
      <div class="input-group input-group-sm mr-2">
        <input class="form-control form-control-navbar" type="search" name="search" value=""
          style="background-color: #fff;" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar"
            style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>

    </form>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">List Of Client Messages</h3>

    </div>
    <div class="card-body">
      <table id="table" class="table table-bordered table-hover table-striped">
        <thead>
          <th>ID</th>
          <th>Client Name</th>
          <th>Title</th>
          <th>Content</th>
          <th>Delete</th>
        </thead>
        <tbody>
          @forelse ($records as $record)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$record->client->name}}</td>
            <td>
              {{$record->title}}
            </td>
            <td>
              {{$record->content}}
            </td>
            <td>
              <a href="{{route('message.destroy',['message'=>$record->id])}}" onclick="event.preventDefault();
                                                document.getElementById('{{'delete'.$record->id}}').submit();"
                class="btn btn-danger"><i class="fas fa-trash"></i></a>
              <form id="{{'delete'.$record->id}}" action="{{ route('message.destroy',['message'=>$record->id]) }}"
                method="POST" style="display: none;">
                @method('delete')
                @csrf
              </form>
            </td>
          </tr>
          @empty
          <tr style="text-align: center">
            <td colspan=5>No Data</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      {{$records->links()}}
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection