<?php
namespace App\Http\Controllers;

use App\Admin;
use App\News;
use App\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');

        $this->middleware(function ($request, $next){
            return $next($request);

        });
    }
    protected $data = [];


    public function parentRegister()
    {
        $userData = Parents::orderBy('id', 'desc')->get();
        $this->data['title'] = 'Parent Registration';
        return view('Parents.parent_register', $this->data, compact('userData'));
    }

    public function addParents(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'Contact_no' =>'required',
                'Address'=>'required',
                'email' => 'required|email|unique:parent_table,email',
                'password' => 'required|min:5|confirmed',
                'profilepicture' => 'required'
            ], [
                'name.required' => 'Plz enter your name.'
            ]);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['Contact_no'] = $request->Contact_no;
            $data['Address'] = $request->Address;
            $data['password'] = bcrypt($request->password);
            $data['role']="parent";




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
                return redirect()->route('parent_register')->with('success', 'Record inserted successfully!');
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

    public function deleteParent(Request $request)
    {
        $id = $request->userid;
        if ($this->deleteWithImage($id) && Parents::findOrFail($id)->delete()) {
            return redirect()->route('parent_register')->with('success', 'Deleted Successfully!');
        }
    }

    //for search
    public function searchParent(Request $request)
    {
        $this->data['title'] = 'search';
        $search_name = $request->get('search_name');
        $userData= DB::table('parent_table')->where('name',$search_name)->get()->all();
        if($userData!=null){
            return view('Parents.parent_register', $this->data,compact('userData'));
        }
        else{
            return view('Parents.parent_register', $this->data,compact('userData'));
        }
    }

    public function updateParent(Request $request)
    {
        $this->data['title'] = 'updateParent';
        $id = $request->userid;
        $userData = Parents::orderBy('id', 'desc')->where('id',$id)->get();
        return view('Parents.updateParent', $this->data,compact('userData'));
    }

    public function updateParentRecord(Request $request)
    {
        if($request->isMethod('get')){
            return redirect()->back();

        }
        if($request->isMethod('post')) {
            $this->validate($request, [
                    'name' => 'min:3',
                    'email' => 'email',

                    'profilepicture' => 'mimes:jpeg,jpg,png']
                , ['name.required' => 'plz enter your name.']
            );
            $this->data['title'] = 'updateParentRecord';
            $data['name'] = $request->name;
            $data['email'] = $request->email;
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
                return view('Parents.updateParent',$this->data, compact('userData'));
            }
        }
    }

    public function parentLogin()
    {

        $this->data['title'] = 'Parentlogin';
        return view('Parents.parentLogin', $this->data) ;
    }

    public function parentLogme(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $password = $request->input('password');
            $hashedPassword = DB::table('parent_table')->where('email',$email)->value('password');

            if (Hash::check($password, $hashedPassword)) {

                $checkLogin = DB::table('parent_table')->where(['email' => $email])->get();
                if (count($checkLogin) > 0) {
                    return redirect()->route('parentRegister')->with('success', 'Login Successfully!');

                } else {
                    return redirect()->route('parentLogin')->with('success', 'Login Failed!');

                }
            }
            else {
                return redirect()->route('parentLogin')->with('success', 'Login Failed!');

            }


        }
    }
}
