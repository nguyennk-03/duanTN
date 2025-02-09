<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\danhmuc;
use App\Models\sanpham;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function adminSP(){
        $danhmucs = danhmuc::orderBy('tendm','ASC')->get();
        $sanphams = sanpham::orderBy('id','DESC')->paginate(10); 
        return view('admin.adminSP',compact('danhmucs','sanphams'));
    }
    public function adminDM(){
        $danhmucs = danhmuc::orderBy('tendm','ASC')->get();
        $danhmucs = danhmuc::orderBy('id','DESC')->paginate(10); 
        return view('admin.adminDM',compact('danhmucs','danhmucs'));
    }
    public function sanphamadd(Request $request){
        $validatedData = $request->validate([
            'tendm' => 'required|string|max:255',
            'price' => 'required|numeric',
            'danhmuc_id' => 'required|integer|exists:danhmucs,id',
            'img' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('img')) {
            $imgName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imgName);
            $validatedData['img'] = $imgName;
        }
        
        $sanphams = sanpham::create($validatedData);

        return redirect() ->route('sanphamadmin');
    }
    public function sanphamdelete($id) {
        $sanpham = sanpham::find($id);
        $imgpath = "uploads/" . $sanpham->img;
        if (file_exists($imgpath)) {
            unlink($imgpath);
        }
        $sanpham->delete();
        return redirect()->route('sanphamadmin');
    }
    public function adminSPcapnhat($id){
        $danhmucs = danhmuc::orderBy('name','ASC')->get();
        $sanphams = sanpham::orderBy('id','DESC')->paginate(10); 
        $sanphams = sanpham::find($id);
        return view('admin.adminSPcapnhat', compact('danhmucs', 'sanpham'));
    }
    public function sanphamupdate(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'danhmuc_id' => 'required|integer|exists:danhmucs,id',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);
    
        $sanpham = sanpham::find($id);
    
        if ($request->hasFile('img')) {
            $imgPath = 'uploads/' . $sanpham->img;
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
            $imgName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imgName);
            $validatedData['img'] = $imgName;
        } else {
            unset($validatedData['img']);
        }
    
        $sanpham->update($validatedData);
    
        return redirect()->route('sanphamadmin')->with('success', 'Cập nhật sản phẩm thành công');
    }
    
    public function users(){
        return view('admin.adminND');
    }
    public function update(){
        return view('admin.update');
    }
}
