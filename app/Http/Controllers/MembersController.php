<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Visitor;
use App\Models\Catchment;
use Validator;
use DB;
use Log;
use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{
    public function home()
    {   
        if(request()->has('filter')){
            $filter = request()->filter;
            // dd($filter);
            if($filter == "all"){
                return redirect()->route('members.home');
            }elseif($filter == "male"){
                $members = Member::where('gender', 'Male')->paginate(20);
            }elseif($filter == "female"){
                $members = Member::where('gender', 'Female')->paginate(20);
            }elseif($filter == "pastors"){
                $members = Member::where('title', 'Pastor')->orWhere('title', 'E-Pastor')->paginate(20);
            }elseif ($filter == "deacon") {
                $members = Member::where('title', ['Deacon', 'Deaconess'])->paginate(20);
            }elseif ($filter == "stewards") {
                $members = Member::where('title', 'Steward')->paginate(20);
            }elseif ($filter == "baptized") {
                $members = Member::where('baptized', true)->paginate(20);
            }elseif ($filter == "unbaptized") {
                $members = Member::where('baptized', false)->paginate(20);
            }elseif ($filter == "fds") {
                $members = Member::where('foundation_sch_status', true)->paginate(20);
            }
            return view('members.home', compact('members','filter'));
        }

        if(request()->has('search')){
            $search = request()->search;
            if(auth()->user()->user_type == 'Admin')
                $members = Member::where('firstname', $search)->orWhere('lastname', $search)->orWhere('othername', $search)->paginate(20);
        }else{
            if(auth()->user()->user_type == 'Admin')
                $members = Member::paginate(20);
            else{
                $catchments = auth()->user()->zone->catchments->load('members');
                return view('members.home_zone_leader', compact('catchments'));
            }
        }
        return view('members.home', compact('members'));
    }

    public function homeVisitors()
    {
        if(request()->has('search')){
            $search = request()->search;
            if(auth()->user()->user_type == 'Admin')
                $visitors = Visitor::where('firstname', $search)->orWhere('lastname', $search)->orWhere('othername', $search)->paginate(20);
        }else{
            if(auth()->user()->user_type == 'Admin')
                $visitors = Visitor::paginate(20);
            else{
                $catchments = auth()->user()->zone->catchments->load('visitors');
                return view('visitors.home_zone_leader', compact('catchments'));
            }
        }

        return view('visitors.home', compact('visitors'));
    }

    public function addMember()
    {
        $members = Member::all();
        if(auth()->user()->user_type == 'Admin')
            $catchments = Catchment::all();
        else
            $catchments = auth()->user()->zone->catchments;
        return view('members.add_member', compact('catchments', 'members'));
    }
    public function saveMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'title' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            if($request->any_relations == 'null')
                $array['any_relations'] = null;
            if($request->baptized)
                $array['baptized'] = true;
            if($request->foundation_sch_status)
                $array['foundation_sch_status'] = true;
            if($request->sld_subscription)
                $array['sld_subscription'] = true;
            
            $member = Member::create($array);
            DB::commit();
            session()->flash('new_member', $member->firstname.' '.$member->lastname.' has been added as a new member of the Church.');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error_message', $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('members.home');
    }

    public function editMember(Member $member)
    {
        $members = Member::all();
        $catchments = Catchment::all();
        $data = [
            'members' => $members,
            'member' => $member,
            'catchments' => $catchments,
        ];
        return view('members.edit_member', $data);
    }
    public function updateMember(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'title' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            if($request->any_relations == 'null')
                $array['any_relations'] = null;
            if($request->baptized)
                $array['baptized'] = true;
            if($request->foundation_sch_status)
                $array['foundation_sch_status'] = true;
            if($request->sld_subscription)
                $array['sld_subscription'] = true;
            
            $member->update($array);
            DB::commit();
            session()->flash('success_message', 'Member updated successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error_message', $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('members.home');
    }

    public function importMembers(Request $request)
    {
        Excel::import(new MembersImport,  $request->file('import_file'));

        return redirect()->back();
    }

    public function addVisitor()
    {
        $members = Member::all();
        if(auth()->user()->user_type == 'Admin')
            $catchments = Catchment::all();
        else
            $catchments = auth()->user()->zone->catchments;
        return view('visitors.add_visitor', compact('catchments', 'members'));
    }
    public function saveVisitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'title' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            if($request->any_relations == 'null')
                $array['any_relations'] = null;
            if($request->baptized)
                $array['baptized'] = true;
            if($request->foundation_sch_status)
                $array['foundation_sch_status'] = true;
            if($request->sld_subscription)
                $array['sld_subscription'] = true;
            
            Visitor::create($array);
            DB::commit();
            session()->flash('success_message', 'Visitor added successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error_message', $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('visitors.home');
    }
    public function editVisitor(Visitor $visitor)
    {
        $members = Member::all();
        $catchments = Catchment::all();
        $data = [
            'members' => $members,
            'visitor' => $visitor,
            'catchments' => $catchments,
        ];
        return view('visitors.edit_visitor', $data);
    }
    public function updateVisitor(Request $request, Visitor $visitor)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'title' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'marital_status' => 'required|string',
            'occupation' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            if($request->any_relations == 'null')
                $array['any_relations'] = null;
            if($request->baptized)
                $array['baptized'] = true;
            if($request->sld_subscription)
                $array['sld_subscription'] = true;
            
            $visitor->update($array);
            DB::commit();
            session()->flash('success_message', 'Member updated successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error_message', $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('visitors.home');
    }
    public function logAttendance(Visitor $visitor)
    {
        DB::beginTransaction();
        try {
            $visitor->attendance = $visitor->attendance + 1;
            $visitor->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
        }
        return back();
    }

    public function logAttendanceAddMember(Visitor $visitor)
    {
        DB::beginTransaction();
        try {
            $visitor->attendance = $visitor->attendance + 1;
            $member = Member::create($visitor->attributesToArray());
            $member->foundation_sch_status = true;
            $member->save();
            $visitor->delete();
            DB::commit();
            session()->flash('new_member','Visitor '.$member->firstname.' '.$member->lastname.' has been added as a new member of the Church.');
        } catch (\Exception $ex) {
            DB::rollback();
        }
        return redirect()->route('members.home');
    }
}
