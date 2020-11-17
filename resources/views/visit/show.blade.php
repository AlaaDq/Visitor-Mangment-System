@extends('layouts.app')

@section('content')
<div class="container">
    <li>purpose: {{$visit->purpose}}</li> 
    <li>cteated_at: {{$visit->cteated_at}}</li> 
</div>
@endsection

@section('scripts')

@endsection
