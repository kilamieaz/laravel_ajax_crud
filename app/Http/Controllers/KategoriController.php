<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function listData()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
          $no = 0;
          foreach($kategori as $list){
             $no ++;
             $row = array();
             $row[] = $no;
             $row[] = $list->nama_kategori;
             $row[] = '<a onclick="editForm('.$list->id_kategori.')" class="btn btn-primary">Edit</a>
                        <a onclick="deleteData('.$list->id_kategori.')" class="btn btn-danger">Hapus</a>';
             $data[] = $row;
          }
        
          $output = array("data" => $data);
          return response()->json($output);
          //echo json_encode($output);
    }

    public function index()
    {
        return view('kategori.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
         $kategori = new Kategori;
         $kategori->nama_kategori = $request['nama'];
         $kategori->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        echo json_encode($kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request['nama'];
        $kategori->update();
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}
