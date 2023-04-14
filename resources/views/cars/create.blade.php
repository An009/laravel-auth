@extends('layouts.layout')
@section('title',"cars")
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <h1>Add A Car</h1>
    <a href="{{route('cars.index')}}" class="btn btn-primary m-2">Go back to Garage</a>
    <div class="container w-75">
        <form method="POST" action="{{route('cars.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand" value="{{old('brand')}}">
            </div>
            @error('brand')
            <span class="text-danger mb-3">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{old('price')}}">
            </div>
            @error('price')
            <span class="text-danger mb-3">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="origin">Origin</label>
                <select class="form-control" id="origin" name="origin">
                    <option value="">Choose origin</option>
                    <option value="USA"  {{ old('origin') == 'USA' ? 'selected' : '' }}>USA</option>
                    <option value="China" {{ old('origin') == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Japan" {{ old('origin') == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="Europe" {{ old('origin') == 'Europe' ? 'selected' : '' }}>Europe</option>
                </select>
            </div>
            @error('origin')
            <span class="text-danger mb-3">{{$message}}</span>
            @enderror
            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" class="form-control-file" id="picture" name="picture" value="{{old('picture')}}">
            </div>
            @error('picture')
            <span class="text-danger mb-3">{{$message}}</span>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</div>
@endsection
