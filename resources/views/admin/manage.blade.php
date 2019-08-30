@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box">
                <div class="box-header">
                    <h3><i class='fa fa-file'></i>
                        @if(!isset($user))
                            Create new user
                        @else
                            Edit user: {{$user->name}}

                        @endif
                    </h3>
                </div>
                <div class="box-body">
                    <div class="col-md-8 col-xs-12">
                        @if(isset($user))
                            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
                        @else
                            {{ Form::open(array('route' => 'users.store')) }}
                        @endif
                        <div class="form-group">
                            {{ Form::label('name', 'Username') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('phone', 'Phone') }}
                            {{ Form::text('phone', null, array('class' => 'form-control')) }}
                        </div>


                        <div class="form-group">
                            {{ Form::label('link', 'Ony unique part of link') }}
                            {{ Form::text('link', null, array('class' => 'form-control')) }}
                        </div>

                        <br>
                        @if(isset($user))
                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        @else
                            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                        @endif

                        {{ Form::close() }}
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
@endsection
