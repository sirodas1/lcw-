<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Zone;
use App\Models\Member;
use Validator;
use DB;
use Log;
use Hash;

class ZoneLeadersController extends Controller
{
    public function home()
    {
        $members = Member::all();
        $zone_leaders = User::where('user_type', 'Zone Leader')->get();
        $data = [
            'members' => $members,
            'zones' => Zone::all(),
            'zone_leaders' => $zone_leaders,
        ];
        return view('zone_leaders.home', $data);
    }

    public function saveLeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
            'member_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            $member = Member::find($array['member_id']);
            $array['name'] = $member->firstname.' '.$member->lastname.' '.$member->othername;
            $array['password'] = Hash::make($array['password']);
            $leader = User::create($array);
            $zone = Zone::find($array['zone_id']);
            $zone->update(['leader_id' => $leader->id]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }

        return back();
    }

    public function updateLeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leader_id' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required|string',
            'member_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', $validator->messages());
            return back();
        }

        DB::beginTransaction();
        try {
            $array = $request->all();
            $member = Member::find($array['member_id']);
            $array['name'] = $member->firstname.' '.$member->lastname.' '.$member->othername;
            $array['password'] = Hash::make($array['password']);
            
            $leader = User::find($array['leader_id']);
            $leader->update($array);

            if($leader->zone->id != $array['zone_id']){
                $leader->zone->update(['leader_id' => null]);
                $zone = Zone::find($array['zone_id']);
                $zone->update(['leader_id' => $leader->id]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }

        return back();
    }
}
