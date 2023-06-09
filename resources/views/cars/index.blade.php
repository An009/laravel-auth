@extends('layouts.layout')
@section('title',"cars")
@section('content')
<div class="container d-flex-column">
    @if (session('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <h1>My carage</h1>
    <a href="{{route('cars.create')}}" class="btn btn-primary m-2">Add new Car</a>
    <div class="card-deck mt-3">
        @forelse ($cars as $car)
        <div class="card car">
            <div class="card-body">
                <div class="car-image mb-3">
                    <img src="{{ asset('storage/' . $car['picture']) }}" alt="Car Picture" class="img-fluid">
                </div>
                <h5 class="card-title">{{ $car['brand'] }}</h5>
                <p class="card-text">{{ $car['price'] }}$</p>
                <p class="card-text">
                    @if($car['user'])
                    {{ $car['user']->name }}
                    @else
                    Unknown
                    @endif
                </p>
            </div>
            <div class="card-footer">
                <form action="{{ route('cars.destroy',$car) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="{{ route('cars.show',$car) }}" class="btn btn-primary mr-2">Show</a>
                    <a href="{{ route('cars.edit',$car) }}" class="btn btn-success mr-2">Edit</a>
                    @can('delete', $car)
                    <button class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </div>
        </div>
        @empty
        <h3>There are no cars.</h3>
        @endforelse
    </div>
</div>

@endsection
