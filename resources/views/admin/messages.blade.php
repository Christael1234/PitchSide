@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="card-title">Contact Messages</h1>

    {{-- Sort buttons --}}
    <div class="mb-3">
        <a href="{{ route('admin.contacts', ['sort' => 'name']) }}" class="btn btn-sm btn-primary">Sort by Name</a>
        <a href="{{ route('admin.contacts', ['sort' => 'created_at']) }}" class="btn btn-sm btn-primary">Sort by Created At</a>
    </div>

    <div class="row">
        @foreach($contacts as $contact)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $contact->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $contact->email }}</h6>
                    <p class="card-text">{{ $contact->message }}</p>
                    <p class="card-text">Created At: {{ $contact->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
