<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoTable;
use Illuminate\Support\Facades\DB;

class InfoTableController extends Controller
{
    public function index(){
        $allData = DB::table('info_table')->get();
        $users = DB::table('users')->get();
        return view('dashboard.dashboard',compact('allData','users'));
    }
    public function add(){
        return view('dashboard.add');
    }

    public function create(Request $request){
        
        InfoTable::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            
        ]);
        return redirect('/dashboard')->with('status','Data Added Successfully');
        
    }

    public function edit($id){
        $data = InfoTable::where('id',$id)->first();
        return view('dashboard.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = InfoTable::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->mobile = $request->input('mobile');
        $data->update();
        return redirect('/dashboard')->with('status','Data Updated Successfully');
    }


    public function destroy(Request $request, $id)
    {
        
        $data = InfoTable::find($id);
        $data->delete();
        return redirect('/dashboard')->with('status','Data Deleted Successfully');
    }
}
