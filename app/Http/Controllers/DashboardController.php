<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use DB;
use Log;

class DashboardController extends Controller
{
    public function home()
    {
        if(auth()->user()->user_type == 'Admin')
            $zones = Zone::all();
        else
            $zones = auth()->user()->zones;
        return view('dashboard', compact('zones'));
    }

    public function addZone(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            Zone::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }
}
