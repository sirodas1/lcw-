<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\SundayAttendance;
use DB;
use Log;

class ReportsController extends Controller
{
    public function home()
    {
        if(auth()->user()->user_type == 'Admin'){
            $reports = Report::all();
            return view('reports.home', compact('reports'));
        }else{
            $reports = auth()->user()->reports;
            return view('reports.zone_leader.home', compact('reports'));
        }
    }

    public function addReport()
    {
        return view('reports.zone_leader.add_report');
    }

    public function saveReport(Request $request)
    {
        $this->validate($request, [
            'sunday_date' => 'required|date',
            'arrival_time' => 'required',
            'number_of_new_souls' => 'required|numeric',
            'means_of_transport' => 'required|string',
            'number_of_vehicles_brought' => 'required|numeric',
            'attendance' => 'array',
        ]);
        $report = auth()->user()->reports->where('sunday_date', $request->sunday_date);
        if( isset($report) && (count($report) > 0)){
            session()->flash('error_message', 'Report for this Date Already Exist.');
            return back();
        }
        DB::beginTransaction();
        try {
            $report = auth()->user()->reports()->create($request->all());

            if ($request->has('attendance.members')) {
                foreach ($request->input('attendance.members') as $id => $value) {
                    if (array_key_exists('status',$value)) {
                        $report->members_attendance()->attach($id, [
                            'attendance' => true,
                            'sunday_date' => $request->sunday_date, 
                            'zone_id' => auth()->user()->zone->id
                        ]);
                    }else{
                        $report->members_attendance()->attach($id, [
                            'reason' => $value['reason'],
                            'sunday_date' => $request->sunday_date, 
                            'zone_id' => auth()->user()->zone->id
                        ]);
                    }
                }
            }
            if ($request->has('attendance.visitors')) {
                $report->visitors_attendance()->attach($request->input('attendance.visitors'), [
                    'sunday_date' => $request->sunday_date, 
                    'zone_id' => auth()->user()->zone->id
                ]);
            }
            DB::commit();
            session()->flash('new_report', 'New Report Added Successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
            return back();
        }
        return redirect()->route('reports.home');
    }

    public function editReport(Report $report)
    {
        return view('reports.zone_leader.edit_report', compact('report'));
    }

    public function updateReport(Request $request, Report $report)
    {
        $this->validate($request, [
            'arrival_time' => 'required',
            'number_of_new_souls' => 'required|numeric',
            'means_of_transport' => 'required|string',
            'number_of_vehicles_brought' => 'required|numeric',
            'attendance' => 'array',
        ]);
        
        DB::beginTransaction();
        try {
            $report->update($request->all());

            if ($request->has('attendance.members')) {
                $attendance_array = [];
                foreach ($request->input('attendance.members') as $id => $value) {
                    if (array_key_exists('status',$value)){
                        $attendance_array[$id] = [
                            'attendance' => true,
                            'reason' => null,
                            'sunday_date' => $report->sunday_date, 
                            'zone_id' => auth()->user()->zone->id
                        ];
                    }else{
                        $attendance_array[$id] = [
                            'attendance' => false,
                            'reason' => $value['reason'],
                            'sunday_date' => $report->sunday_date, 
                            'zone_id' => auth()->user()->zone->id
                        ];
                    }
                }

                $report->members_attendance()->sync($attendance_array);
            }
            if ($request->has('attendance.visitors')) {
                $report->visitors_attendance()->syncWithPivotValues($request->input('attendance.visitors'), [
                    'sunday_date' => $report->sunday_date, 
                    'zone_id' => auth()->user()->zone->id
                ]);
            }
            DB::commit();
            session()->flash('new_report', 'New Report Added Successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
            return back();
        }
        return redirect()->route('reports.home');
    }
    
    public function viewReport(Report $report)
    {
        return view('reports.view_report', compact('report'));
    }
    
    public function reviewedReport(Report $report)
    {
        try {
            DB::transaction(function () use ($report) {
                $report->update(['status' => true]);
            });
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back();
        }
        return redirect()->route('reports.home');
    }
}
