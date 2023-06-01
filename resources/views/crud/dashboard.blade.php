@extends('layouts.auth.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-12 mx-auto">
            <div class="card my-5">
                <div class="card-body">
                    <h4 class="card-title text-center">All Data</h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('danger') }}
                        </div>
                    @endif
                    <a class="btn btn-success" href="{{ route('crud.create') }}">Add Data</a>
                    <hr>
                    {{-- @include('flash_data') --}}
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Email</td>
                                <td>Contact</td>
                                <td>Gender</td>
                                <td>Hobbies</td>
                                <td>Address</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->hobbies }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('crud.show', ['crud' => $user->id]) }}">Show</a>
                                        <a class="btn btn-warning"
                                            href="{{ route('crud.edit', ['crud' => $user->id]) }}">Update</a>
                                        <form method="POST" action="{{ route('crud.destroy', ['crud' => $user->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {!! $users->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
