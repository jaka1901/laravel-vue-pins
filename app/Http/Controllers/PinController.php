<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use App\Models\Pin;
use Inertia\Inertia;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::secure()->orderBy('id','desc')->get();
        return Inertia::render('Pins/Index', [
            'pins' => $pins
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepinRequest $request)
    {
        try{
            $pins = new Pin;
            $pins->title = $request->title;
            $pins->description = $request->description;
            $pins->user_id = \Auth::user()->id;
            $pins->save();
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdatepinRequest $request)
    {
        try{
            $pins = Pin::find($request->id);
            $pins->title = $request->title;
            $pins->description = $request->description;
            $pins->save();
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Pin::find($id)->delete();
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
