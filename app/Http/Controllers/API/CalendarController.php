<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Resources\CalendarResource;
use Symfony\Component\HttpFoundation\Response;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = CalendarResource::collection(Calendar::all());
        // return $data;
        $data = Calendar::all();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',

        ]);

        return Calendar::create([
            'title' => $request['title'],
            'start' => $request['start'],
            'end' => $request['end'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        return response($calendar, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $calendar = Calendar::findOrFail($id);
        $this->validate($request,[
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $calendar->update($request->all());
        return ['message' => 'Updated the report info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);

        $calendar->delete();

        return ['message' => 'Report Deleted'];
    }
}
