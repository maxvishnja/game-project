@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users
                    <a class="btn btn-success float-right" href="{{ route('users.create') }}">Create user</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Name</td>
                            <td>Link</td>
                            <td>Expired at</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{url("/link/{$user->link}")}}</td>
                                <td>{{ $user->link_expired }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'class' => 'remove-form','route' => ['users.destroy', $user->id] ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
