<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use Session;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $university = University::get();
        return view('admin.university.university')->with(compact('university'));
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
        $university = new University;
        $university->name_en = $request->input('name_en');
        $university->name_zh = $request->input('name_zh');
        $university->phone = $request->input('phone');
        $university->email = $request->input('email');
        $university->fax = $request->input('fax');
        $university->save();

        return redirect('admin/university')->with('success_message', 'University added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {    
        if ($request->isMethod('post')) {
            // Handle the POST request
    
            $data = $request->all();
    
            // name Pages validation
            $rules = [
                'name_en' => 'required',
                'name_zh' => 'required',
                // Add other validation rules as needed
            ];
            $this->validate($request, $rules);
    
            if ($id == "") {
                $name_en = "Add University";
                $university = new University;
                $message = "University added successfully";
            } else {
                $name_en = "Edit University";
                $university = University::find($id);
                $message = "University updated successfully";
    
              }
    
            $university->name_en = $data['name_en'];
            $university->name_zh = $data['name_zh'];
            $university->phone = $data['phone'];
            $university->email = $data['email'];
            $university->fax = $data['fax'];
            $university->save();
    
            return redirect('admin/university')->with('success_message', $message);
        }
    
        // Handle the GET request
        if ($id == "") {
            $name_en = "Add name";
            $university = new University;
            $message = "University added successfully";
        } else {
            $name_en = "Edit name";
            $university = University::findorFail($id);
            $message = "University updated successfully";
        }
    
        return view('admin.university.add_edit_university')->with(compact('name_en', 'university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'uuid' => 'required|unique:university,uuid,' . $city->id,
            // Add other validation rules as needed
        ]);

        $university->uuid = $request->input('uuid');
        $university->name_en = $request->input('name_en');
        $university->name_zh = $request->input('name_zh');
        $university->phone = $request->input('phone');
        $university->email = $request->input('email');
        $university->fax = $request->input('fax');
        $university->save();
        return response()->json(['message' => 'University updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        University::where('id',$id)->delete();
        return redirect()->back()->with('success_message','University Deleted Successfully');
     }
}
