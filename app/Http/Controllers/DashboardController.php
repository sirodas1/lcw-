<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Catchment;
use App\Models\Member;
use App\Models\Report;
use App\Models\SundayAttendance;
use App\Models\SundayAttendanceVisitor;
use DB;
use Log;

class DashboardController extends Controller
{
    public function home()
    {
        if(auth()->user()->user_type == 'Admin'){
            $zones = Zone::all();
            $statistics = $this->calculateMemberStatistics();
            $attendance = $this->calStatsTable();
            $new_reports = Report::where('status', false)->get();
            return view('dashboard_admin', compact('zones', 'statistics', 'attendance', 'new_reports'));
        }

        $zone = auth()->user()->zone;
        $statistics = $this->calMemStatsForZoneLeaders($zone);
        $report_ready = false;
        if (date('l') == "Sunday") {
            $date = date('Y-m-d');
            $report = Report::where('sunday_date', $date)->firstOr(function(){
                return null;
            });
            if (!isset($report)) {
                $report_ready = true;
            }
        }

        return view('dashboard_zone_leader', compact('zone', 'statistics', 'report_ready'));
    }

    private function calStatsTable()
    {
        $last_sunday = date('Y-m-d',strtotime('last sunday'));
        //Number of Members in Attendance
        $members_attendence = SundayAttendance::where('sunday_date', $last_sunday)->where('attendance', true)->count();
        //Number of Visitors in Attendance
        $visitors_attendence = SundayAttendanceVisitor::where('sunday_date', $last_sunday)->count();

        $number_fs_completed = Member::where('foundation_sch_status', true)->count();
        $number_fs_uncompleted = Member::where('foundation_sch_status', false)->count();
        $attendance = [
            'Last Sunday Church Members Attendance' => $members_attendence,
            'Last Sunday Visitors Attendance' => $visitors_attendence,
            'Number of Members who Completed Foundation Sch.' => $number_fs_completed,
            'Number of Members who are still in Foundation Sch.' => $number_fs_uncompleted,
        ];

        return $attendance;
    }

    private function calculateMemberStatistics()
    {
        $members = Member::all();
        $statistics = [];
        //Total Number of members;
        $statistics[] = [
            'name' => 'Total Members',
            'number' => $members->count(),
            'link' => route('members.home'),
        ];
        //Total Number of male members;
        $statistics[] = [
            'name' => 'Male Members',
            'number' => $members->where('gender', 'Male')->count(),
        ];
        //Total Number of female members;
        $statistics[] = [
            'name' => 'Females Members',
            'number' => $members->where('gender', 'Female')->count(),
        ];
        //Total Number of baptized members;
        $statistics[] = [
            'name' => 'Baptized Members',
            'number' => $members->where('baptized', true)->count(),
        ];
        //Total Number of unbaptized members;
        $statistics[] = [
            'name' => 'Unbaptized Members',
            'number' => $members->where('baptized', false )->count(),
        ];

        return $statistics;
    }

    private function calMemStatsForZoneLeaders($zone)
    {
        $statistics = [];
        //Assigned of members;
        $statistics[] = [
            'name' => 'Assigned Members',
            'number' => $zone->catchments->loadCount('members')->sum('members_count'),
        ];
        //Assigned of visitors;
        $statistics[] = [
            'name' => 'Assigned Visitors',
            'number' => $zone->catchments->loadCount('visitors')->sum('visitors_count'),
        ];
        
        return $statistics;
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

    public function editZone(Request $request, Zone $zone)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $zone->update(['name' => $request->name]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function viewZone(Zone $zone)
    {
        if (auth()->user()->user_type == "Admin") 
            return view('zone-details', compact('zone'));
        else 
            return view('zone-details-leader', compact('zone'));
    }

    public function addCatchment(Request $request, Zone $zone)
    {
        $this->validate($request, [
            'location' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            Catchment::create([
                'location' => $request->location,
                'zone_id' => $zone->id,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function editCatchment(Request $request)
    {
        $this->validate($request, [
            'catchment_id' => 'required|numeric',
            'location' => 'required|string',
        ]);
        
        DB::beginTransaction();
        try {
            Catchment::find($request->catchment_id)->update([
                'location' => $request->location
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function deleteCatchment(Catchment $catchment)
    {
        DB::beginTransaction();
        try {
            $catchment->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }

        return back();
    }
}
