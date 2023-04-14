@extends('layouts.layout')
@section('title', 'Edit Car')
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <h1>Edit Car</h1>
    <a href="{{ route('cars.index') }}" class="btn btn-primary m-2">Go back to Garage</a>
    <div class="container w-75">
        <form method="POST" action="{{ route('cars.update', $car) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand" value="{{ $car->brand }}">
            </div>
            @error('brand')
            <span class="text-danger mb-3">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ $car->price }}">
            </div>
            @error('price')
            <span class="text-danger mb-3">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="origin">Origin</label>
                <select class="form-control" id="origin" name="origin">
                    <option value="">Choose origin</option>
                    <option value="USA" {{ $car->origin == 'USA' ? 'selected' : '' }}>USA</option>
                    <option value="China" {{ $car->origin == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Japan" {{ $car->origin == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="Europe" {{ $car->origin == 'Europe' ? 'selected' : '' }}>Europe</option>
                </select>
            </div>
            @error('origin')
            <span class="text-danger mb-3">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="picture">Picture</label>
                <div class="image-container position-relative">
                <img id="preview-image" src="{{ old('picture') ? asset('storage/' . old('picture')) : asset('storage/' . $car->picture) }}" alt="Car Picture" class="img-fluid">
                    <div class="image-overlay d-flex justify-content-center align-items-center">
                        <div class="edit-image-btn">
                            <label for="edit-picture" class="btn btn-primary btn-sm">Edit</label>
                            <input id="edit-picture" type="file" class="d-none" name="picture">
                        </div>
                    </div>
                </div>
            </div>

            @error('picture')
            <span class="text-danger mb-3">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
