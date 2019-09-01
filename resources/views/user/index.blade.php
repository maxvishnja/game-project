@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 col-xs-12">
            <h3 class="mobile-center">Your link is </h3>
            </div>
            <div class="col-md-7 col-xs-12">
                <h3 id="link">{{url("/link/{$user->link}")}}</h3>
            </div>
            <div class="col-md-3 btn-block">
                <a class="btn btn-info copy-btn" data-clipboard-target="#link" data-clipboard-action="copy">Copy</a>
                <a class="btn btn-success" href="/link/{{$user->link}}/generate">Generate</a>
                <a class="btn btn-danger" href="/link/{{$user->link}}/remove">Delete</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3 text-center btn-block">
                <a class="btn btn-success calc-btn" href="/calculated">Im feeling lucky</a>
                <div class="mt-4">
                    <h3 class="result-title"></h3>
                    <h3 class="result-value"></h3>
                </div>
            </div>
            <div class="col-md-3 text-center btn-block">
                <a class="btn btn-info history-btn" href="/history">History</a>
                <div class="history mt-4">

                </div>
            </div>
        </div>
    </div>
@endsection
