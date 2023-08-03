@extends('layouts.admin')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">


        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">All Contacts</h4>
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
                </div>

                <div class="mt-3 col-4">
                    <form action="{{ route('contacts.search') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" placeholder="Search" class="form-control" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>




                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Avatar </th>
                            <th> Full Name </th>
                            <th> Job title </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Birthday </th>
                            <th> Created At </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td class="py-1">
                                    <img src="{{ $contact->avatar_url }}" alt="image" />
                                </td>
                                <td>{{ $contact->full_name }} </td>
                                <td>
                                    {{ $contact->job_title ?? 'Unknown' }}
                                </td>
                                <td> {{ $contact->email }}</td>
                                <td> {{ $contact->phone_no }} </td>

                                <td> {{ $contact->birthday }} </td>
                                <td> {{ $contact->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('contacts.edit', $contact->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No contacts found.</td>
                            </tr>
                            @endforelse

                    </tbody>


                </table>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
