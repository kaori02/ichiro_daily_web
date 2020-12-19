<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Laporan;
use Facade\FlareClient\Report;

class MechanicReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Laporan::where('role', 'mechanic')->orderBy('waktu','desc')->paginate(10);
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
            'nama' => 'required',
            'body_laporan' => 'required',
            'waktu' => 'required',
        ]);

        return Laporan::create([
            'nama' => $request['nama'],
            'title_laporan' => $request['title_laporan'],
            'body_laporan' => $request['body_laporan'],
            'waktu' => date('Y-m-d', strtotime($request['waktu'])),
            'role' => 'mechanic',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // return $id;
        $laporan = Laporan::findOrFail($id);
        $this->validate($request,[
            'nama' => 'required',
            'body_laporan' => 'required',
            'waktu' => 'required',
        ]);

        $laporan->update($request->all());
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
        $laporan = Laporan::findOrFail($id);

        $laporan->delete();

        return ['message' => 'Report Deleted'];
    }
}
