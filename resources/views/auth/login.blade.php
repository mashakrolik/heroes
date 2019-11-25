@extends('layouts.app')

@section('content')
<div class="panel-heading">Tests</div>
 
<div class="panel-body table-responsive">
	<tests></tests>
    <router-view name="testsIndex"></router-view>
    <router-view></router-view>
</div>
@endsection
