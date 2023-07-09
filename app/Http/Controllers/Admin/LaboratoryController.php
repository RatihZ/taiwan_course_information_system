<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use App\Models\Departmentdetail;
use App\Models\Professor;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use Session;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratory = Laboratory::with('parentdepartmentdetail', 'parentlaboratory')->get();
        return view('admin.laboratory.laboratory')->with(compact('laboratory'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        $laboratory = new Laboratory;
        $laboratory->uuid = (string) Str::uuid(); // Generate UUID
        $laboratory->name_en = $request->input('name_en');
        $laboratory->name_zh = $request->input('name_zh');
        $laboratory->room = $request->input('room');
        $laboratory->department_detail_id = $request->input('departmentdetail');
        $laboratory->professor_id = $request->input('professor');
        $laboratory->save();

        return redirect('admin/laboratory')->with('success_message', 'Laboratory added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $getdepartmentdetails = Departmentdetail::all();
        $getprofessors = Professor::all();
        $departmentdetail = null;
        $professor = null;
    
        if ($request->isMethod('post')) {
            // Handle the POST request
    
            $data = $request->all();
    
            // lab$laboratory Pages validation
            $rules = [
                'name_en' => 'required',
                'name_zh' => 'required',
                // Add other validation rules as needed
            ];
            $this->validate($request, $rules);
    
            if ($id == "") {
                $name_en = "Add Laboratory";
                $laboratory = new Laboratory;
                $message = "Laboratory added successfully";
            } else {
                $name_en = "Edit Laboratory";
                $laboratory = Laboratory::with('parentdepartmentdetail', 'parentprofessor')->findOrFail($id);
                $message = "Laboratory updated successfully";
    
                // Automatically fill the existing depart$laboratory, professor, and country data
                $laboratory = $laboratory->parentdepartmentdetail;
                $professor = $laboratory->parentprofessor;
            }
    
            $laboratory->name_en = $data['name_en'];
            $laboratory->name_zh = $data['name_zh'];
            $laboratory->room = $data['room'];
            $laboratory->department_detail_id = $data['departmentdetail'];
            $laboratory->professor_id = $data['professor'];
            $laboratory->save();
    
            return redirect('admin/laboratory')->with('success_message', $message);
        }
    
        // Handle the GET request
        if ($id == "") {
            $name_en = "Add Laboratory";
            $laboratory = new Laboratory;
            $message = "Laboratory added successfully";
        } else {
            $name_en = "Edit Laboratory";
            $laboratory = Laboratory::with('parentdepartmentdetail', 'parentprofessor')->findOrFail($id);
            $message = "Laboratory updated successfully";
    
            // Automatically fill the existing departmentdetail, professor, and country data
            $laboratory = $laboratory->parentdepartmentdetail;
            $professor = $laboratory->parentprofessor;
        }
    
        return view('admin.laboratory.add_edit_laboratory')->with(compact('name_en', 'laboratory', 'getdepartmentdetails', 'getprofessors', 'departmentdetail', 'professor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        $request->validate([
            'uuid' => 'required|unique:laboratory,uuid,' . $laboratory->id,
            // Add other validation rules as needed
        ]);

        $laboratory->uuid = $request->input('uuid');
        $laboratory->name_en = $request->input('name_en');
        $laboratory->name_zh = $request->input('name_zh');
        $laboratory->room = $request->input('room');
        $laboratory->department_detail_id = $request->input('departmentdetail');
        $laboratory->professor_id = $request->input('professor');

        // Update the Laboratory
        $laboratory->save();

        // Return a success response
        return response()->json(['message' => 'Laboratory updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy($getDepartmentdetails)
    {
        Laboratory::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Laboratory Deleted Successfully');
    }
}
