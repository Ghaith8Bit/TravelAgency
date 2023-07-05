<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::paginate(4);
        return view('dashboard.trips.index', ['trips' => $trips]);
    }

    public function show(Trip $trip)
    {
        return view('dashboard.trips.show', ['trip' => $trip]);
    }

    public function store(Request $request)
    {
        Validator::extend('after_or_equal_next_day', function ($attribute, $value, $parameters, $validator) {
            $currentDate = Carbon::tomorrow();
            return Carbon::parse($value)->greaterThan($currentDate);
        });

        Validator::extend('after_start_date', function ($attribute, $value, $parameters, $validator) {
            $startDate = Carbon::parse($validator->getData()['start_date']);
            return Carbon::parse($value)->greaterThan($startDate);
        });

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date|after_or_equal_next_day',
            'end_date' => 'required|date|after_start_date',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            $message = app()->getLocale() === 'ar' ? 'بيانات غير صالحة.' : 'Invalid input data.';
            return redirect()->back()->with('error', $message)->withInput();
        }

        $trip = new Trip();
        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->start_date = $request->input('start_date');
        $trip->end_date = $request->input('end_date');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public', $imageName);
            $trip->image = asset('storage/' . $imageName);
        } else {
            $trip->image = asset('storage/no_pic.jpg');
        }

        $trip->save();

        $message = app()->getLocale() === 'ar' ? 'تم إنشاء الرحلة بنجاح.' : 'Trip created successfully.';
        return redirect()->route('dashboard.trips.index')->with('success', $message);
    }

    public function update(Request $request, Trip $trip)
    {
        Validator::extend('after_or_equal_next_day', function ($attribute, $value, $parameters, $validator) {
            $currentDate = Carbon::tomorrow();
            return Carbon::parse($value)->greaterThan($currentDate);
        });

        Validator::extend('after_start_date', function ($attribute, $value, $parameters, $validator) {
            $startDate = Carbon::parse($validator->getData()['start_date']);
            return Carbon::parse($value)->greaterThan($startDate);
        });

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date|after_or_equal_next_day',
            'end_date' => 'required|date|after_start_date',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            $message = app()->getLocale() === 'ar' ? 'بيانات غير صالحة.' : 'Invalid input data.';
            return redirect()->back()->with('error', $message)->withInput();
        }

        $trip->name = $request->input('name');
        $trip->description = $request->input('description');
        $trip->price = $request->input('price');
        $trip->start_date = $request->input('start_date');
        $trip->end_date = $request->input('end_date');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($trip->image && Storage::exists('public/' . basename($trip->image))) {
                Storage::delete('public/' . basename($trip->image));
            }

            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public', $imageName);
            $trip->image = asset('storage/' . $imageName);
        }

        $trip->save();

        $message = app()->getLocale() === 'ar' ? 'تم تحديث الرحلة بنجاح.' : 'Trip updated successfully.';
        return redirect()->route('dashboard.trips.index')->with('success', $message);
    }

    public function destroy(Trip $trip)
    {
        // Delete the image if it exists and is not the default image
        if ($trip->image && $trip->image !== asset('storage/no_pic.jpg')) {
            $imagePath = str_replace(asset('storage/'), 'public/', $trip->image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $trip->delete();

        $message = app()->getLocale() === 'ar' ? 'تم حذف الرحلة بنجاح.' : 'Trip deleted successfully.';
        return redirect()->route('dashboard.trips.index')->with('success', $message);
    }
}
