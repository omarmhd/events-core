<?php

namespace App\Http\Controllers;

use App\Models\EventInvitation;
use App\Models\InvitationQr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceManagement extends Controller
{
    public function index(Request $request)
    {
        $query = EventInvitation::with('InvitationQrs')
            ->whereHas('InvitationQrs');
        if ($request->filled('searchInput')) {
            $search = $request->searchInput;

            $query->where(function ($q) use ($search) {
                $q->where('invitee_name', 'like', "%$search%")
                    ->orWhere('invitee_email', 'like', "%$search%")
                    ->orWhere('invitee_phone', 'like', "%$search%")
                    ->orWhere('invitee_position', 'like', "%$search%")
                    ->orWhere('invitee_nationality', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");

            });
        }
        $stats = InvitationQr::selectRaw("
        COUNT(*) as total,
        SUM(is_used = 1) as checked,
        SUM(is_used = 0) as not_checked
    ") ->first();

        $rows = $query->latest()->paginate(6);





        return view('admin.attendance_management.index', compact('rows','stats'));
    }
    public function checked_in(Request $request){



        $invitationQr = InvitationQr::find($request->id);


        // تم استخدامه مسبقًا
        if ($invitationQr->is_used) {
            return redirect()->back()->with("error","This guest has already checked in");

        }

        // تسجيل الحضور
        $invitationQr->update([
            'is_used' => true,
            'used_at' => Carbon::now()
        ]);


        return redirect()->back()->with("success","Check-in successful");


//        if($request->qrData){
//            $ticket=Ticket::where("id",$request->qrData??$id)->update([
//                "checked_in_at"=>Carbon::now()
//            ]);
//            return response()->json(["success"=>true,"message"=>"success"]);
//        }
//        if($id){
//            $ticket=Ticket::where("id",$id)->update([
//                "checked_in_at"=>Carbon::now()
//            ]);
//            return back();
//
//        }

    }


}
