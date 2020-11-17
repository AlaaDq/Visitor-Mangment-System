@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                <form action="{{route('department.store')}}" method="POST">
                    @csrf    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>title:</strong>
                                <input type="text" name="title" class="form-control" placeholder="title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                @role('admin')
                <select id="selectedEmp" name="department_id">
                    <option value="">Select Employee </option>
                </select>
                @endrole

                @role('admin|receptionist')
                @can('create visiting_actions')
                    
                <form action="{{route('employee.store')}}" method="POST">
                @csrf               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <select id="selectedDep" name="department_id">
                                    <option  value="">Select Department </option>
                                    @foreach ($departments as $department)
                                    <option  value="{{ $department->id }}"
                                        @if ( old('department_id') == $department->id  )
                                        selected="selected"
                                        @endif
                                        >{{ $department->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>full_name:</strong>
                                    <input type="text" name="full_name" class="form-control" placeholder="full_name">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>username:</strong>
                                    <input type="text" name="username" class="form-control" placeholder="full_name">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>address:</strong>
                                    <input type="text" name="address" class="form-control" placeholder="address">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>password:</strong>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                    @endcan
                    @endrole
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
 
    $("#selectedDep").change(function(){
    
      
        console.log($(this).val());
        $.ajax({
           type:'POST',
           url:"{{ route('department.employees') }}",
           data:{"department_id":$(this).val(),
                 "_token": "{{ csrf_token() }}",
           },
           success:function(data){
               console.log(data.html)                    
        
            $('#selectedEmp').html(data.html);
           }
        });
    
    });
    
    </script>
@endsection
