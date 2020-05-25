@extends('layouts.app')

<!-- @if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif -->

@section('content')
<div class="container-fluid" style="background-color: #3490dc">
    <div class="container py-3">
        <div class="row py-5">
            <div class="col-12 col-md-6">   
                <h2 class="text-white font-weight-bold">Motivate helps you to stay on track by showing you how far along you are.</h2>
                <h5 class="text-white">Built from the ground up with motivation in mind, Motivate uses psychological principles to keep you working to schedule.</h5>
                @if (Route::has('login'))
                    <div class="app-buttons mt-5">
                        @auth
                            <a type="button" class="btn btn-success font-weight-bold px-4" style="font-size: 20px;" href="{{ url('/home') }}">Dashboard</a>
                        @else
                            <a type="button" class="btn btn-success font-weight-bold px-4" style="font-size: 20px;" href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a type="button" class="btn btn-secondary font-weight-bold px-4" style="font-size: 20px;" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-6">   
                <div class="card mt-3 mt-lg-0 mx-lg-3 p-3">
                    <img class="w-100 h-auto" src="{{ asset('images/example.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-5 align-items-center">
        <div class="col-12 col-lg-6 order-lg-1">
            <h3>Progress Bars</h3>
            <p class="">Our unique progress bars show you your progress through tasks against a marker of where you should be based on your due date.</p>
            <p class="">The progress bars on both the project and sections update in real time as you complete tasks, helping you understand your progress on each task.</p>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card p-3">
                <img class="w-100 h-auto" src="{{ asset('images/progress.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="row my-4 align-items-center">
        <div class="col-12 col-lg-6">
            <div>
            <h3>Task Sectioning</h3>
            <p class="">Projects can be complicated, we seperate tasks into grouped sections which have unique progress tracking and due dates.</p>
            <p class="">The progress bars on both the project and sections update in real time as you complete tasks, helping you understand your progress on each task.</p>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card p-3">
                <img class="w-100 h-auto" src="{{ asset('images/sections.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="row mb-5 align-items-center">
        <div class="col-12 col-lg-6 order-lg-1">
            <h3>Project Analysis</h3>
            <p class="">See data on project performance and progress over time to discover how you work. By pinpointing bad work habits and inefficient
             days you can understand how your motivation works and begin to build good work habits.</p>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card px-3">
                <img class="w-100 h-auto" src="{{ asset('images/retrospective.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
