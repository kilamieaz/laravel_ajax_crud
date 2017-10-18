<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use Redirect;
use DataTables;
// use Yajra\Datatables\Facades\Datatables;
// use Yajra\Datatables\Html\Builder;
// use Yajra\Datatables\Datatables;

class ProdukController extends Controller
{
    protected $pesan = array(
      'nama.required' => 'Isi Nama Produk',
      'kategori.required' => 'Pilih kategori',
      'harga.required' => 'Isi Harga Jual',
    );
   
   protected $aturan = array(
      'nama' => 'required',
      'kategori' => 'required',
      'harga' => 'required',
    );

   public function listData()
   {
    $produk = Produk::join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
    ->orderBy('produk.id_produk', 'desc')
    ->get();
     $no = 0;
     $data = array();
     foreach($produk as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->nama_produk;
       $row[] = $list->nama_kategori;
       $row[] = $list->harga_jual;
       $row[] = "<a onclick='editForm(".$list->id_produk.")' class='btn btn-primary'>Edit</a>
               <a onclick='deleteData(".$list->id_produk.")' class='btn btn-danger'>Hapus</a>";
       $data[] = $row;
     }
     
     return DataTables::of($data)->escapeColumns([])->make(true);
   }

    public function index()
    {
        $batas = 5;
        $produk = Produk::join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->orderBy('produk.id_produk', 'desc')
                ->paginate($batas);
              
        $no = $batas * ($produk->currentPage() - 1);
      
        return view('produk.index', compact('produk', 'no'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->aturan, $this->pesan);
      
        $produk = new Produk;
        $produk->nama_produk = $request['nama'];
        $produk->id_kategori = $request['kategori'];
        $produk->harga_jual = $request['harga'];
        $produk->save();
      
        return Redirect::route('produk.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategori = Kategori::all();
        $produk   = Produk::find($id);
        return view('produk.edit', compact('kategori', 'produk'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->aturan, $this->pesan);
      
        $produk = Produk::find($id);
        $produk->nama_produk = $request['nama'];
        $produk->id_kategori = $request['kategori'];
        $produk->harga_jual = $request['harga'];
        $produk->update();

        return Redirect::route('produk.index');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return Redirect::route('produk.index');
    }
}
