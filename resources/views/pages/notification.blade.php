@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
    <h1>Notification</h1>
    @if (count($pendings) > 0)
        @foreach ($pendings as $pending)
                <div class="card">
                    <div class="row py-4 ml-2">
                        <div class="col-sm-8">
                            <h5 style="font-weight: 450" class="ml-3"><b>{{$pending->name}}</b> has sent you a friend request.</h5>
                        </div>
                        <a href="/accept/{{Auth::user()->id}}/{{$pending->id}}" class="offset-sm-2"><button class="btn btn-outline-secondary">Accept</button></a>
                        <a href="/decline/{{Auth::user()->id}}/{{$pending->id}}" class=""><button class="btn btn-danger">Decline</button></a>
                    </div>
                </div><br>
                <div class="col-sm-8">
                    
                </div>                   
        @endforeach
        {{-- {{$pendings->links()}} --}}
    @else
        <p>No Notifications Found</p>
    @endif
@endsection