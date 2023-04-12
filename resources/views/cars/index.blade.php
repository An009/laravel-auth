@extends('layouts.layout')
@section('title',"cars")
@section('content')
<div class="carscontainer">
    @if (session('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <h1>My carage</h1>
    <a href="{{route('cars.create')}}" class="btn btn-primary m-2">Add new Car</a>
    <div class="cars">
        @forelse ($cars as $car)
        <div class="car">
            <span> {{$car['brand'] }}</span>
            <span>{{$car['price']}}</span>
            {{-- <span>{{$item['origin'] }}</span> --}}
            <span>{{$car['user']->name}}</span>
            <div class='groupbtn'>
                <form action="{{route('cars.destroy',$car)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{route('cars.show',$car)}}" class="btn btn-primary"> show</a>
                    <a href="{{route('cars.edit',$car)}}" class="btn btn-success">Edit</a>
                    @can('delete', $car)
                    <button class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </div>
        </div>
        @empty
        <h3>there is no cars</h3>
        @endforelse
    </div>
</div>
@endsection