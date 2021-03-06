@extends('layouts.app')
@inject('bloodTypes','App\Models\BloodType')
@inject('governs','App\Models\Government')
@section('page_title')
{{ __('pages.Clients') }}
@endsection
@section('additional_styles')
@include('partials.grid-view-styles')
@endsection
@section('additional_scripts')
@include('partials.grid-view-scripts')
@include('partials.delete')
<script>
    function getCities(){
          let govern = $('#govern').val();
        //   console.log(govern);

          $.ajax({
            url:`${location.origin}/api/v1/cities?govern=${govern}`
          }).done(function(data){
            let cities = data.data;

           let defaultElement= $('#city').children().first();
            $('#city').empty();
            $(defaultElement).appendTo('#city');
        //    $(`<option selected="" disabled=""></option>`).appendTo('#city');
            cities.forEach(function(city){
              $(`<option value=${city.id}>${city.name}</option>`).appendTo('#city');
            });
          })
        }
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
            <h3 class="card-title">{{ __('pages.List Of').' '. __('pages.Clients') }}</h3>
            <div class="row justify-content-end">
                <form class="form-inline ml-3" id="filter" action="{{route('client.index')}}">
                    <div class="input-group input-group-sm mr-2">
                        @if (app()->getLocale()=='ar')
                        <div class="input-group-append">
                            <button class="btn btn-navbar"
                                style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <input class="form-control form-control-navbar" type="search" name="search" value=""
                            style="background-color: #fff;" placeholder="{{ __('pages.Search') }}" aria-label="Search">
                        @else
                        <input class="form-control form-control-navbar" type="search" name="search" value=""
                            style="background-color: #fff;" placeholder="{{ __('pages.Search') }}" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar"
                                style="background-color: #fff; border:1px solid #CED4DA; border-left:0; color:rgba(0,0,0,.6)"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                    <select class="form-control custom-select mr-2"
                        onchange="document.getElementById('filter').submit();" name="blood" id="blood">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.Blood Type') }}</option>
                        @foreach ($bloodTypes->all() as $bloodType)
                        <option value={{$bloodType->id}}>{{$bloodType->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control custom-select mr-2" onchange="getCities()" name="govern" id="govern">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.Govern') }}</option>
                        @foreach ($governs->all() as $govern)
                        <option value={{$govern->id}}>{{$govern->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control custom-select" onchange="document.getElementById('filter').submit();"
                        name="city" id="city">
                        <option selected="" disabled="">{{ __('pages.Select').' '.__('pages.City') }}</option>

                        {{-- <option value={{$bloodType->id}}>{{$bloodType->name}}</option> --}}

                    </select>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>{{ __('pages.Name') }}</th>
                    <th>{{ __('pages.Email') }}</th>
                    <th>{{ __('pages.Phone') }}</th>
                    {{-- <th>Date Of Birth</th> --}}
                    <th>{{ __('pages.Blood Type') }}</th>
                    <th>{{ __('pages.Govern') }}</th>
                    <th>{{ __('pages.City') }}</th>
                    <th>{{ __('pages.Is Banned') }}</th>
                    <th>{{ __('pages.Ban') }}</th>
                    <th>{{ __('pages.Delete') }}</th>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                    <tr id="record-{{ $record->id }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{$record->phone}}</td>
                        {{-- <td>{{$record->dob}}</td> --}}
                        <td>{{$record->bloodType->name}}</td>
                        <td>{{$record->city->government->name}}</td>
                        <td>{{$record->city->name}}</td>
                        <td>{{$record->is_banned}}</td>
                        <td>
                            <a href="{{route('client.update',['client'=>$record->id])}}" onclick="event.preventDefault();
                                    document.getElementById('{{'ban'.$record->id}}').submit();"
                                class="btn btn-warning"><i class="fas fa-user-slash"></i></a>
                            <form id="{{'ban'.$record->id}}"
                                action="{{ route('client.update',['client'=>$record->id]) }}" method="POST"
                                style="display: none;">
                                @method('put')
                                <input type="number" name="is_banned" value="{{$record->is_banned=='Banned'?0:1}}">
                                @csrf
                            </form>
                        </td>
                        <td>
                            <a href="{{route('client.destroy',['client'=>$record->id])}}"
                                id="delete-route-{{ $record->id }}"
                                onclick="event.preventDefault();deleteRecord({{ $record->id }});"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center">
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                        <td>No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$records->links()}}
        </div>
        <!-- /.card-body -->
        @csrf
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
