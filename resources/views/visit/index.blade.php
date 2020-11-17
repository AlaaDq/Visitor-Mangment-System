@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
   @endif
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>visitor National id</th>
                <th>visitor full_name</th>
                <th>visit purpose</th>
                <th>department</th>
                <th>employee</th>
                <th>actions</th>
     
            </tr>
            </thead>
            <tbody>
                @forelse ($visits as $visit)   
                <tr>
                    <td scope="row">{{$visit->visitor_id}}</td>
                    <td>{{$visit->visitor->full_name}}</td>
                    <td> {{$visit->purpose}}</td>
                    <td> {{$visit->department->title}} </td>
                    <td> {{$visit->employee->username}} </td>
                    <td style="display:flex;">                    
                        <button class="btn btn-primary" 
                        onclick="window.location.href ='/visits/{{$visit->id}}';"> 
                        details 
                        </button>  
                        @can('edit visiting_actions')                        
                        <button class="btn btn-primary" 
                        onclick="window.location.href ='/visits/{{$visit->id}}/edit';"> 
                        edit 
                        </button>  
                        @endcan
                        @can('delete visiting_actions')                        
                        <form action="{{route('visits.destroy',$visit->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger">Delete Visit</button>
                        </form>
                        <form action="{{route('visitors.destroy',$visit->visitor->national_id)}}"  method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger">Delete Visitor</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <h3>  there is not any visit yet in the table </h3>
                @endforelse
            </tbody>
    </table>


  @can('restore visiting_actions')

  <br>
  <hr>
  <h2> admin restor trashed data section</h2>
  
  <table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>visitor National id</th>
            <th>trashed visitor full_name</th>
            <th>trashed visit purpose</th>
            <th>department</th>
            <th>employee</th>
            <th>actions</th>
 
        </tr>
        </thead>
        <tbody>
            @forelse ($trashedVisits as $trashedVisit)  
            <tr>
                <td scope="row">{{$trashedVisit->visitor_id}}</td>
                <td> {{$trashedVisit->trashedVisitor->first_name ?? '----'}}</td>
                <td> {{$trashedVisit->purpose}}</td>
                <td> {{$trashedVisit->department->title}} </td>
                <td> {{$trashedVisit->employee->username}} </td>
                <td style="display:flex;">                                             
                    <form action="{{route('visits.restore',$trashedVisit->id)}}" method="POST">
                        @csrf
                        <button class="btn btn-danger">restore Visit</button>
                    </form>
              
                    @if($trashedVisit->trashedVisitor)
                      <form action="{{route('visitors.restore',$trashedVisit->trashedVisitor->national_id)}}"  method="POST">
                          @csrf
                          <button class="btn btn-danger">restore Visitor</button>
                      </form>
                    @endif
                </td>
            </tr>
            @empty
            <h3>the trashed table is empty</h3>
            @endforelse
        </tbody>
</table>

@endcan

</div>
@endsection

@section('scripts')

@endsection
