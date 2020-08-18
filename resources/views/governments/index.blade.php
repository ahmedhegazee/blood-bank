@extends('layouts.app')

@section('page_title')
Governments
@endsection
@section('additional_styles')
<link rel="stylesheet"
    href="{{ asset('adminlte/plugins/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet"
    href="{{ asset('adminlte/plugins/css/responsive.bootstrap4.min.css') }}" />
@endsection
@section('additional_scripts')
<script src="{{ asset('adminlte/plugins/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $("#table").DataTable({
            responsive: true,
            autoWidth: false,
            paging: false,
            searching: false,
            info: false,
        });
    });
</script>
@endsection
@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    @include('flash::message')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Of Governments</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-end mb-2">
                <a href="{{ route('government.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> Add Government</a>
            </div>
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>No Cities</th>
                    <th>Show</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->cities->count() }}</td>
                            <td>
                                <a href="{{ route('government.show',['government'=>$record->id]) }}"
                                    class="btn btn-primary"><i class="fas fa-city"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('government.edit',['government'=>$record->id]) }}"
                                    class="btn btn-success"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('government.destroy',['government'=>$record->id]) }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('{{ 'delete'.$record->id }}').submit();"
                                    class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                <form id="{{ 'delete'.$record->id }}"
                                    action="{{ route('government.destroy',['government'=>$record->id]) }}"
                                    method="POST" style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr style="text-align: center">
                            <td colspan=3>No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection