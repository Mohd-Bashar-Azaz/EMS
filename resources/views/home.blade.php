@extends('layouts.navbar')
@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <h1>Welcome to Employee Management System</h1>
</div>
<style>


h1 {
    font-family: 'Arial', sans-serif;
    font-size: 2rem; /* Responsive font size */
    font-weight: bold;
    color: #333; /* Dark grey color */
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

</style>
@endsection
