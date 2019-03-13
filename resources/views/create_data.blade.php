@extends('layout')

@section('title', 'Create faker data')

@section('content')
    <div class="title m-b-md">Create logs data</div>
    <p>Load this page to create faker table data</p>
    <p>Users created = <?php echo $users ?></p>
    <p>Countries created = <?php echo $countries ?></p>
    <p>Numbers created = <?php echo $numbers ?></p>
    <p>Logs created = <?php echo $logs ?></p>
@endsection
