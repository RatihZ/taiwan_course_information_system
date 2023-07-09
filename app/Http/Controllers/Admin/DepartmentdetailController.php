<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departmentdetail;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Language;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use Session;

class DepartmentdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departmentdetail = Departmentdetail::with('parentuniversity', 'parentfaculty', 'parentdepartment','parentlanguage')->get();
        return view('admin.departmentdetail.departmentdetail')->with(compact('departmentdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departmentdetail = new Departmentdetail;
        $departmentdetail->uuid = (string) Str::uuid(); // Generate UUID
        $departmentdetail->university_id = $request->input('university');
        $departmentdetail->faculty_id = $request->input('faculty');
        $departmentdetail->department_id = $request->input('department');
        $departmentdetail->language_id = $request->input('language');
        $departmentdetail->save();

        return redirect('admin/departmentdetail')->with('success_message', 'Department detail added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departmentdetail  $departmentdetail
     * @return \Illuminate\Http\Response
     */
    public function show(Departmentdetail $departmentdetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departmentdetail  $departmentdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $getuniversities = University::all();
        $getfaculties = Faculty::all();
        $getdepartments = Department::all();
        $getlanguages = Language::all();
        $university = null;
        $faculty = null;
        $department = null;
        $language = null;

    
        if ($request->isMethod('post')) {
            // Handle the POST request
    
            $data = $request->all();
    
            if ($id == "") {
                $university_id = "Add Department Detail";
                $departmentdetail = new Departmentdetail;
                $message = "Department Detail added successfully";
            } else {
                $university_id = "Edit Department Detail";
                $departmentdetail = Departmentdetail::with('parentuniversity', 'parentfaculty', 'parentdepartment', 'parentlanguage')->findOrFail($id);
                $message = "Department Detail updated successfully";
    
                // Automatically fill the existing university, city, and country data
                $university = $departmentdetail->parentuniversity;
                $faculty = $departmentdetail->parentfaculty;
                $department = $departmentdetail->parentdepartment;
                $language = $departmentdetail->parentlanguage;
            }
    
            $departmentdetail->university_id = $data['university'];
            $departmentdetail->faculty_id = $data['faculty'];
            $departmentdetail->department_id = $data['department'];
            $departmentdetail->language_id = $data['language'];
            $departmentdetail->save();
    
            return redirect('admin/departmentdetail')->with('success_message', $message);
        }
    
        // Handle the GET request
        if ($id == "") {
            $university_id = "Add Department Detail";
            $departmentdetail = new Departmentdetail;
            $message = "Department Detail added successfully";
        } else {
            $university_id = "Edit Department Detail";
            $departmentdetail = Departmentdetail::with('parentuniversity', 'parentfaculty', 'parentdepartment', 'parentlanguage')->findOrFail($id);
            $message = "Department Detail updated successfully";
    
            // Automatically fill the existing university, city, and country data
            $university = $departmentdetail->parentuniversity;
            $faculty = $departmentdetail->parentfaculty;
            $department = $departmentdetail->parentdepartment;
            $language = $departmentdetail->parentlanguage;
        }
    
        return view('admin.departmentdetail.add_edit_departmentdetail')->with(compact( 'departmentdetail', 'getuniversities', 'getfaculties', 'getdepartments','getlanguages', 'university', 'faculty', 'department', 'language'));
    }    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departmentdetail  $departmentdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departmentdetail $departmentdetail)
    {
        $request->validate([
            'uuid' => 'required|unique:departmentdetail,uuid,' . $departmentdetail->id,
            // Add other validation rules as needed
        ]);

        $address->uuid = $request->input('uuid');
        $departmentdetail->university_id = $request->input('university');
        $departmentdetail->faculty_id = $request->input('faculty');
        $departmentdetail->department_id = $request->input('department');
        $departmentdetail->language_id = $request->input('language');

        // Update the address
        $departmentdetail->save();

        // Return a success response
        return response()->json(['message' => 'Department Detail updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departmentdetail  $departmentdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departmentdetail::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Department Detail Deleted Successfully');
    }
}
