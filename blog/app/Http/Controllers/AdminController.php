<?php
namespace App\Http\Controllers;
use App\Admin;
use App\Parents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
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
    public function login()
    {

        $this->data['title'] = 'login';
        return view('login', $this->data);
    }

//    public function logme(Request $request)
//    {
//        if ($request->isMethod('get')) {
//            return redirect()->back();
//        }
//        if ($request->isMethod('post')) {
//            $email = $request->input('email');
//            $password = $request->input('password');
//            $hashedPassword = DB::table('admin_table')->where('email',$email)->value('password');
//
//            if (Hash::check($password, $hashedPassword)) {
//
//                $checkLogin = DB::table('admin_table')->where(['email' => $email])->get();
//                if (count($checkLogin) > 0) {
//                    return redirect()->route('home')->with('success', 'Login Successfully!');
//
//                } else {
//                    return redirect()->route('login')->with('success', 'Login Failed!');
//
//                }
//            }
//            else {
//                return redirect()->route('login')->with('success', 'Login Failed!');
//
//            }
//
//
//        }
//    }


    public function register_admin()
    {

        $userData = Parents::orderBy('id', 'desc')->get();
        $this->data['title'] = 'Registration';
        return view('register_admin', $this->data, compact('userData'));
    }

    public function addAdmin(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:parent_table,email',
                'password' => 'required|min:5|confirmed',
                'profilepicture' => 'required'
            ], [
                'name.required' => 'Plz enter your name.'
            ]);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['Contact_no']=$request->Contact_no;
            $data['Address']=$request->Address;
            $data['password'] = bcrypt($request->password);
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
            if (Parents::create($data)) {
                return redirect()->route('register_admin')->with('success', 'Record inserted successfully!');
            }

        }
    }


    public function deleteWithImage($id)
    {
        $userData = Parents::findOrFail($id);
        $userImage = $userData->image;
        $deletePath = public_path('lib/images' . '/' . $userImage);
        if (file_exists($deletePath) && is_file($deletePath)) {
            return unlink($deletePath);
        }
        return true;
    }


    public function deleteAdmin(Request $request)
    {
        $id = $request->userid;
        $value=Parents::findorfail($id);
        if($value->email=='bipans@gmail.com'){
            return redirect()->route('register_admin')->with('fail','Cannot delete the record of the Super Admin');
        }
        else {
            if ($this->deleteWithImage($id) && Parents::findOrFail($id)->delete()) {
                return redirect()->route('register_admin')->with('success', 'Deleted Successfully!');
            }
        }
    }


    public function updateAdmin(Request $request)
    {
        $this->data['title'] = 'updateAdmin';
        $id = $request->userid;
        $userData = Parents::orderBy('id', 'desc')->where('id',$id)->get();
        return view('Admin.updateAdmin', $this->data,compact('userData'));
    }

    public function updateRecordAdmin(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();

        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                    'name' => 'min:3',
                    'email' => 'email',

                    'profilepicture' => 'mimes:jpeg,jpg,png']
                , ['name.required' => 'plz enter your name.']
            );
            $this->data['title'] = 'updateRecordAdmin';
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['Contact_no'] = $request->Contact_no;
            $data['Address'] = $request->Address;

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

            if (Parents::where('id', $id)->update($data)) {
                $userData = Parents::orderBy('id', 'desc')->where('id', $id)->get();
                return view('Admin.updateAdmin', $this->data, compact('userData'));
            }
        }
    }



















}
