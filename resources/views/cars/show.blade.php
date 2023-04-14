@extends('layouts.layout')
@section('title',"{{$car->brand}}")
@section('content')
<div class="container d-flex-column">
    <h1>My carage</h1>
    <a href="{{route('cars.index')}}" class="btn btn-primary m-2">Go back</a>
    <div class="card-deck mt-3">
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
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
