<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //display all the cars availables in the database
        return View('cars.index', [
            'cars' => Car::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show the add car form
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create a new car
        $validatedData = $request->validate([
            'brand' => 'required|min:3',
            'price' => 'required|numeric',
            'origin' => 'required',
            'picture' => ['required', 'image']
        ]);
        $image_path = $request->picture->store('cars', 'public');
        $user_id = Auth::id();
        $car = new Car();
        $car->user_id = $user_id;
        $car->brand = $validatedData['brand'];
        $car->price = $validatedData['price'];
        $car->origin = $validatedData['origin'];
        $car->picture = $image_path; //$validatedData['picture']->store('public/cars');
        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car Added Succefully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $car)
    {
        //show the single item
        return view('cars.show', [
            'car' => Car::findOrFail($car)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $car)
    {
        //show the edit form
        return view('cars.edit', [
            'car' => Car::findOrFail($car)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //update Car
        $request->validate([
            'brand' => 'required',
            'price' => 'required|numeric',
            'origin' => 'required',
            'picture' => 'nullable|image|max:2048'
        ]);

        $car->brand = $request->input('brand');
        $car->price = $request->input('price');
        $car->origin = $request->input('origin');

        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($car->picture && Storage::exists($car->picture)) {
                Storage::delete($car->picture);
            }
            // Save new picture
            $path = $request->file('picture')->store('public/cars');
            $car->picture = str_replace('public/', '', $path);
        }

        $car->save();

        return redirect()->route('cars.show', $car)->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $car)
    {
        //delete a car
        Car::destroy($car);
        return redirect()->route('cars.index');
    }
}
