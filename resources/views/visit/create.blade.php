@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{route('visits.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="first_name" class="form-control" placeholder="first name">
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" name="last_name" class="form-control" placeholder="last name">
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <strong>National Id:</strong>
                <input type="number" name="national_id" class="form-control" placeholder="your national id">
                @error('national_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <strong>Purpose:</strong>
                <input type="text" name="purpose" class="form-control" placeholder="purpose of the visit">
                @error('purpose')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select id="selectedDep" name="department_id">
                    <option  value="">Select Department </option>
                    @forelse ($departments as $department)
                    <option  value="{{ $department->id }}">
                        {{ $department->title }}
                    </option>
                    @empty
                    <option  value="">Sorry there is not any Department yet</option>
                    @endforelse
                </select>
                @error('department_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select id="selectedEmp" name="employee_id">
                    <option value="">Select Employee </option>
                </select>
                @error('employee_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

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