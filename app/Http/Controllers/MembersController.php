<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Visitor;
use App\Models\Catchment;
use Validator;
use DB;
use Log;

class MembersController extends Controller
{
    public function home()
    {
        if(auth()->user()->user_type == 'Admin')
            $members = Member::paginate(20);
        else
            $members = auth()->user()->zones->catchments->load('members');

        return view('members.home', compact('members'));
    }

    public function homeVisitors()
    {
        if(auth()->user()->user_type == 'Admin')
            $visitors = Visitor::paginate(20);
        else
            $visitors = auth()->user()->zones->catchments->load('visitors');

        return view('visitors.home', compact('visitors'));
    }

    public function addMember()
    {
        $catchments = Catchment::all();
        return view('members.add_member', compact('catchments'));
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
            if($request->baptized)
                $array['baptized'] = true;
            if($request->foundation_sch_status)
                $array['foundation_sch_status'] = true;
            if($request->sld_subscription)
                $array['sld_subscription'] = true;
            
            Member::create($array);
            DB::commit();
            session()->flash('success_message', 'Member added successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error_message', $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->route('members.home');
    }

    public function editMember(Member $member)
    {
        $catchments = Catchment::all();
        $data = [
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

    public function importMembers()
    {
        
    }

    public function addVisitor()
    {
        $catchments = Catchment::all();
        return view('visitors.add_visitor', compact('catchments'));
    }
    public function saveVisitor(Request $request)
    {
        
    }
}
