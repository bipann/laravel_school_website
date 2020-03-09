<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\DB;
use App\Attendance;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');

        $this->middleware(function ($request, $next){
            return $next($request);

        });
    }
    public function attendanceHome()
    {
        $this->date['title']='attendanceHome';
        return view('Attendance.attendanceHome',$this->date);
    }

    public function record()
    {
        $userData = News::orderBy('id', 'asc')->get();
        $this->data['title'] = 'recordAttendance';
        return view('Attendance.recordAttendance', $this->data, compact('userData'));
    }

    public function addrecordAttendance(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
            'date' => 'required|unique:attendance,date']);
            $attendance=new Attendance;
            $firstdata=DB::table('usertable')->get('id')->first();
            $lastdata=DB::table('usertable')->get('id')->last();
            $first=$firstdata->id;
            $last=$lastdata->id;
            $value=false;
            for ($i = $first; $i <= $last; $i++) {
                $name = 'name' . $i;
                $attendance = 'attendance' . $i;
                $data['name'] = $request->$name;
                $data['attendance'] = $request->$attendance;
                $data['date'] = $request->date;
                if($data['name'] == null)
                {
                    continue;
                }
                else
                    {
                    if (Attendance::create($data))
                        {
                            $value=true;
                        }
                    }
                }
            if ($value==true)
                {
                    return redirect()->route('recordAttendance')->with('success', 'Record inserted successfully!');

                }
            }

        }


        public function viewAttendance()
        {
            $this->data['title'] = 'viewAttendance';
            $userData=[];
            $absentLength=0;
            return view('Attendance.viewAttendance', $this->data, compact('userData','absentLength'));
        }

        public function searchAttendance(Request $request)
        {
            $this->data['title']='searchAttendance';
            $userData=Attendance::all();
            $absentLength=0;
            $name=$request->search_name;
            $start_date=$request->start_date;
            $end_date=$request->end_date;
            if ($name==null){
                $userData=DB::table('attendance')->whereBetween('date',[$start_date,$end_date])->get();
            }
            else{
                $userData=DB::table('attendance')->where('name',$name)->whereBetween('date',[$start_date,$end_date])->get();
                $absentDays=DB::table('attendance')->where('name',$name)->where('attendance','absent')->whereBetween('date',[$start_date,$end_date])->get();
                $absentLength=count($absentDays);
//                return redirect()->route('searchAttendance')->with('fail','the student has been absent for');
            }
            return view('Attendance.viewAttendance', $this->data, compact('userData','absentLength'));



        }



}
