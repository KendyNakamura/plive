<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Place;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $places = Place::all();
        return view('admin.place.index', [
            'places' => $places,
        ]);
    }

    public function create()
    {
        return view('admin.place.create');
    }

    public function store(PlaceRequest $request)
    {
        $place = Place::create($request->all());
        return redirect(route('admin::place.index'))->with('result', __('c.saved'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Place $place)
    {
        return view('admin.place.edit', ['place' => $place]);
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $place->fill($request->all())->save();
        return redirect(route('admin::place.update', $place))->with('result', __('c.saved'));
    }

    public function destroy($id)
    {
        //
    }
}
