<?php

namespace App\Http\Controllers;

use App\News;
use App\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
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
    public function index()
    {
        return redirect()->route('home');
    }

    public function register()
    {
        $userData = News::orderBy('id', 'desc')->get();
        $guardians=Parents::orderBy('id', 'desc')->get();
        $this->data['title'] = 'Registration';
        return view('register', $this->data, compact('userData','guardians'));
    }

    public function addUser(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'DOB' => 'required',
                'gender' => 'required',
                'guardian' => 'required',
                'Contact_no' => 'required',
                'profilepicture' => 'required'
            ], [
                'name.required' => 'Plz enter your name.'
            ]);
            $data['name'] = $request->name;
            $data['DOB'] = $request->DOB;
            $data['gender'] = $request->gender;
            $data['Guardian'] = $request->guardian;
            $data['Contact_no'] = $request->Contact_no;

            if ($request->hasFile('profilepicture')) {
                echo "image";
                $image = $request->file('profilepicture');
                $ext = $image->getClientOriginalExtension();
                $imageName = str_random() . '.' . $ext;
                $uploadPatd = public_path('lib/images');
                if (!$image->move($uploadPatd, $imageName)) {
                    return redirect()->back();
                }

                $data['image'] = $imageName;

            }
            if (News::create($data)) {
                return redirect()->route('student_register')->with('success', 'Record inserted successfully!');
            }
        }
    }

    public function deleteWithImage($id)
    {
        $userData = News::findOrFail($id);
        $userImage = $userData->image;
        $deletePath = public_path('lib/images' . '/' . $userImage);
        if (file_exists($deletePath) && is_file($deletePath)) {
            return unlink($deletePath);
        }
        return true;

    }

    public function deleteUser(Request $request)
    {
        $id = $request->userid;
        if ($this->deleteWithImage($id) && News::findOrFail($id)->delete()) {
            return redirect()->route('student_register')->with('success', 'Deleted Successfully!');
        }
    }

    //for search
    public function search(Request $request)
    {
        $this->data['title'] = 'search';
        $search_name = $request->get('search_name');
        $userData = DB::table('usertable')->where('name', $search_name)->get()->all();
        if ($userData != null) {
            return view('register', $this->data, compact('userData'));
        } else {
            return view('register', $this->data, compact('userData'));
        }
    }

    public function home()
    {
        $this->data['title'] = 'home';
        return view('home', $this->data);
    }


    public function updateUser(Request $request)
    {
        $this->data['title'] = 'updateUser';
        $id = $request->userid;
        $userData = News::orderBy('id', 'desc')->where('id', $id)->get();
        return view('User.updateUser', $this->data, compact('userData'));
    }

    public function updateRecord(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();

        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                    'name' => 'required|min:3',
                    'DOB' => 'required',
                    'gender' => 'required',
                    'Guardian' => 'required',
                    'Contact_no' => 'required',

                    'profilepicture' => 'mimes:jpeg,jpg,png']
                , ['name.required' => 'plz enter your name.']
            );
            $this->data['title'] = 'updateRecord';
            $data['name'] = $request->name;
            $data['DOB'] = $request->DOB;
            $data['gender'] = $request->gender;
            $data['Guardian'] = $request->Guardian;
            $data['Contact_no'] = $request->Contact_no;
            $id = $request->get('userid');
            if ($request->hasFile('profilepicture')) {

                $image = $request->file('profilepicture');
                $ext = $image->getClientOriginalExtension();
                $imageName = str_random() . '.' . $ext;
                $uploadPatd = public_path('lib/images');
                if ($this->deleteWithImage($id) && $image->move($uploadPatd, $imageName)) {
                    $data['image'] = $imageName;
                }

                $data['image'] = $imageName;
            }

            if (News::where('id', $id)->update($data)) {
                $userData = News::orderBy('id', 'desc')->where('id', $id)->get();
                return view('User.updateUser', $this->data, compact('userData'));
            }
        }


    }


}


