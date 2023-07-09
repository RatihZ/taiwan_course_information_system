<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Intervention\Image\Facades\Image;
use Session;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professor = Professor::get();
        return view('admin.professor.professor')->with(compact('professor'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        if ($id == "") {
            $name_en = "Add Professor";
            $professor = new Professor;
            $message = "Professor added successfully";
        } else {
            $name_en = "Edit Professor";
            $professor = Professor::findOrFail($id);
            $message = "Professor updated successfully";
        }
        if ($request->isMethod('post')) {
            // Handle the POST request

            $data = $request->all();
           /*echo"<pre>"; print_r($data); die;*/

            if($request->hasFile('photo_path')){
                $image_tmp = $request->file('photo_path');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();

                    $imageName = rand(111,99999).'.'.$extension;
                    $image_path = 'storage/front/professors/'.$imageName;

                    Image::make($image_tmp)->save($image_path);
                    $professor->photo_path = $imageName;
                }
            }else {
                $imageName = "";
            }
            $professor->uuid = $request->input('uuid');
            $professor->name_en = $request->input('name_en');
            $professor->name_zh = $request->input('name_zh');
            $professor->email = $request->input('email');
            $professor->save();
            return redirect('admin/professor')->with('success_message',$message);
        }
        return view('admin.professor.add_edit_professor')->with(compact('name_en'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'uuid' => 'required|unique:professor,uuid,' . $professor->id,
            // Add other validation rules as needed
        ]);

        $professor->uuid = $request->input('uuid');
        $professor->name_en = $request->input('name_en');
        $professor->name_zh = $request->input('name_zh');
        $professor->email = $request->input('email');
        $professor->photo_path = $request->input('photo_path');
        $professor->save();
        return response()->json(['message' => 'Professor list updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Professor::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Professor Deleted Successfully');
    }
}