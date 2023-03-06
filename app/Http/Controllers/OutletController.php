<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class OutletController extends Controller
{



    public function index() {
        $row["datas"] = DB::table('outlets')->where('outlets.is_active', 1)->join('users', 'users.id', 'outlets.user_id')
        ->select('outlets.id', 'users.name', 'outlets.outlet_name', 'outlets.created_at', 'outlets.is_active')->get();

        return view('main.outlets', compact('row'));
    }

    public function add(Request $request) {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // Insert to DB
        $insert = DB::table('outlets')->insert([
            'outlet_name' => $request->outlet_name,
            'company_id' => 1,
            'user_id' => 1,
            'is_active' => 1,
            'created_at' => now()
        ]);

        if($insert) {
            Alert::success('Success','Berhasil Menambah Data');
        } else{
            Alert::error('Error', 'Gagal Menambahkan Data');
        }
        
        return redirect()->back()->with('success', true);
    }

    public function deleteOutlet($id) {
        $delete = DB::table('outlets')->where('id', $id)->update([
            'is_active' => 0,
            'updated_at' => now()
        ]);

        if($delete) {
            Alert::success('Success','Berhasil Menghapus Data');
        } else{
            Alert::error('Error', 'Gagal Menghapus Data');
        }
        return redirect()->back()->with('success', true);
    }

    public function updateOutlet(Request $request) {
        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // Insert to DB
        $insert = DB::table('outlets')->where('id', $request->id)->update([
            'outlet_name' => $request->outlet_name,
            'user_id' => 1,
            'updated_at' => now()
        ]);

        if($insert) {
            Alert::success('Success','Berhasil Mengubah Data');
        } else{
            Alert::error('Error', 'Gagal Mengubah Data');
        }
        
        return redirect()->back()->with('success', true);
    }

}
