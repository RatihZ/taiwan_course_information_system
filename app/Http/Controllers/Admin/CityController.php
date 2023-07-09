<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::with('parentcountry')->get();
        return view('admin.city.city')->with(compact('city'));
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
        $city = new City;
        $city->uuid = (string) Str::uuid(); // Generate UUID
        $city->name_en = $request->input('name_en');
        $city->name_zh = $request->input('name_zh');
        $city->country_id = $request->input('country');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $getcountries = Country::all();
        $country = null;
    
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
                $name_en = "Add City";
                $city = new City;
                $message = "City added successfully";
            } else {
                $name_en = "Edit City";
                $city = City::with('parentcountry')->findOrFail($id);
                $message = "City updated successfully";
    
                // Automatically fill the existing university, city, and country data
                $country = $city->parentcountry;
            }
    
            $city->name_en = $data['name_en'];
            $city->name_zh = $data['name_zh'];
            $city->country_id = $data['country'];
            $city->save();
    
            return redirect('admin/city')->with('success_message', $message);
        }
    
        // Handle the GET request
        if ($id == "") {
            $name_en = "Add name";
            $city = new City;
            $message = "City added successfully";
        } else {
            $name_en = "Edit name";
            $city = City::with('parentcountry')->findOrFail($id);
            $message = "City updated successfully";
    
            // Automatically fill the existing university, city, and country data
            $country = $city->parentcountry;
        }
    
        return view('admin.city.add_edit_city')->with(compact('name_en', 'city', 'getcountries', 'country'));
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'uuid' => 'required|unique:city,uuid,' . $city->id,
            // Add other validation rules as needed
        ]);

        $city->uuid = $request->input('uuid');
        $city->name_en = $request->input('name_en');
        $city->name_zh = $request->input('name_zh');
        $city->country_id = $request->input('country');
        $city->save();
        return response()->json(['message' => 'City updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::where('id',$id)->delete();
        return redirect()->back()->with('success_message','City Deleted Successfully');
    }
}
