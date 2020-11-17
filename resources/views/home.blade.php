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
