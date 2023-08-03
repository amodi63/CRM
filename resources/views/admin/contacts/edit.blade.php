@extends('layouts.admin')
@section('content')
<div class="col-12 grid-margin stretch-card">


    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Contact [{{ $contact->full_name }}]</h4>
        <x-alert-messsages type="error"/>
        <x-alert-messsages type="success"/>
      
        @include('admin.contacts._form', ['btn_text' => 'Update Contact', 'action' => route('contacts.update',$contact->id)])
      </div>
    </div>
  </div>
@endsection
