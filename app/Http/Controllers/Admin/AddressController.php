<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::with('parentuniversity', 'parentcity', 'parentcountry')->get();
        return view('admin.pages.address')->with(compact('address'));
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
        $address = new Address;
        $address->uuid = (string) Str::uuid(); // Generate UUID
        $address->address_en = $request->input('address_en');
        $address->address_zh = $request->input('address_zh');
        $address->university_id = $request->input('university');
        $address->city_id = $request->input('city');
        $address->country_id = $request->input('country');
        $address->save();

        return redirect('admin/address')->with('success_message', 'Address added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $getuniversities = University::all();
        $getcities = City::all();
        $getcountries = Country::all();
        $university = null;
        $city = null;
        $country = null;
    
        if ($request->isMethod('post')) {
            // Handle the POST request
    
            $data = $request->all();
    
            // Address Pages validation
            $rules = [
                'address_en' => 'required',
                'address_zh' => 'required',
                // Add other validation rules as needed
            ];
            $this->validate($request, $rules);
    
            if ($id == "") {
                $address_en = "Add Address";
                $address = new Address;
                $message = "Address added successfully";
            } else {
                $address_en = "Edit Address";
                $address = Address::with('parentuniversity', 'parentcity', 'parentcountry')->findOrFail($id);
                $message = "Address updated successfully";
    
                // Automatically fill the existing university, city, and country data
                $university = $address->parentuniversity;
                $city = $address->parentcity;
                $country = $address->parentcountry;
            }
    
            $address->address_en = $data['address_en'];
            $address->address_zh = $data['address_zh'];
            $address->university_id = $data['university'];
            $address->city_id = $data['city'];
            $address->country_id = $data['country'];
            $address->save();
    
            return redirect('admin/address')->with('success_message', $message);
        }
    
        // Handle the GET request
        if ($id == "") {
            $address_en = "Add Address";
            $address = new Address;
            $message = "Address added successfully";
        } else {
            $address_en = "Edit Address";
            $address = Address::with('parentuniversity', 'parentcity', 'parentcountry')->findOrFail($id);
            $message = "Address updated successfully";
    
            // Automatically fill the existing university, city, and country data
            $university = $address->parentuniversity;
            $city = $address->parentcity;
            $country = $address->parentcountry;
        }
    
        return view('admin.pages.add_edit_address')->with(compact('address_en', 'address', 'getuniversities', 'getcities', 'getcountries', 'university', 'city', 'country'));
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'uuid' => 'required|unique:address,uuid,' . $address->id,
            // Add other validation rules as needed
        ]);

        $address->uuid = $request->input('uuid');
        $address->address_en = $request->input('address_en');
        $address->address_zh = $request->input('address_zh');
        $address->university_id = $request->input('university');
        $address->city_id = $request->input('city');
        $address->country_id = $request->input('country');

        // Update the address
        $address->save();

        // Return a success response
        return response()->json(['message' => 'Address updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Address Deleted Successfully');
    }
}
