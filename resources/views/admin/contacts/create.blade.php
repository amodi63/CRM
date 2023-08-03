@extends('layouts.admin')
@section('content')

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    
    <div class="card-body">
      <h4 class="card-title">Create Contact</h4>
      <x-alert-messsages type="error"/>
      <x-alert-messsages type="success"/>
   
        @include('admin.contacts._form',['btn_text' => 'Create Contact', 'action' => route('contacts.store')])
      </div>
    </div>
  </div>
@endsection