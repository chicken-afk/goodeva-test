<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index()
    {
        $row['datas'] = DB::table('categories')->join('users', 'users.id', 'categories.user_id')
            ->select('categories.id', 'categories.category_name', 'categories.is_active', 'categories.created_at', 'users.name')
            ->where('categories.is_active', 1)
            ->get();
        return view('main.category', compact('row'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // Insert to DB
        $insert = DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id(),
            'is_active' => 1,
            'created_at' => now()
        ]);

        if ($insert) {
            Alert::success('Success', 'Berhasil Menambah Data');
        } else {
            Alert::error('Error', 'Gagal Menambahkan Data');
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteCategory($id)
    {
        $delete = DB::table('categories')->where('id', $id)->update([
            'is_active' => 0,
            'updated_at' => now()
        ]);

        if ($delete) {
            Alert::success('Success', 'Berhasil Menghapus Data');
        } else {
            Alert::error('Error', 'Gagal Menghapus Data');
        }
        return redirect()->back()->with('success', true);
    }

    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // Insert to DB
        $insert = DB::table('categories')->where('id', $request->id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::id(),
            'updated_at' => now()
        ]);

        if ($insert) {
            Alert::success('Success', 'Berhasil Mengubah Data');
        } else {
            Alert::error('Error', 'Gagal Mengubah Data');
        }

        return redirect()->back()->with('success', true);
    }
}
