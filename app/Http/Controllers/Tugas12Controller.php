<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tugas12;

class Tugas12Controller extends Controller
{
    public function getData(){

        $data = Tugas12::get();

        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['value'] = $data;

            return response($res);
        }else{
            $res['message'] = "Empty!";

            return response($res);
        }
    }

    public function store(Request $request){

        $this->validate($request, [
            'foto' => 'required|max:2048'
        ]);

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();

        $tujuan_upload = 'data_file';

        if($file->move($tujuan_upload, $nama_file)){
            $data = Tugas12::create([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'foto' => $nama_file
            ]);

            $res['message'] = "Success!";
            $res['values'] = $data;

            return response($res);
        }
    }

    public function update(Request $request){

        if(!empty($request->foto)){
            $this->validate($request, [
                'foto' => 'required|max:2048'
            ]);

            $file = $request->file('foto');

            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'data_file';

            $file->move($tujuan_upload, $nama_file);
            $data = Tugas12::where('id', $request->id)->get();

            foreach($data as $data){
                @unlink(public_path('data_file/'.$data->foto));
                $ket = Tugas12::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'umur' => $request->umur,
                    'alamat' => $request->alamat,
                    'foto' => $nama_file
                ]);

                $res['message'] = "Success!";
                $res['values'] = $ket;

                return response($res);            
            }

        }else{

            $data = Tugas12::where('id', $request->id)->get();

            foreach($data as $data){
                $ket = Tugas12::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'umur' => $request->umur,
                    'alamat' => $request->alamat
                ]);

                $res['message'] = "Success!";
                $res['values'] = $ket;

                return response($res);
            }
        }
    }

    public function delete($id){

        $data = Tugas12::where('id', $id)->get();

        foreach($data as $data){

            if(file_exists(public_path('data_file/'.$data->foto))){

                @unlink(public_path('data_file/'.$data->foto));
                Tugas12::where('id', $id)->delete();
                $res['message'] = "Success!";
                
                return response($res);
            }else{
                $res['message'] = "Empty!";

                return response($res);
            }
        }
    }

    public function getDetail($id){

        $data = Tugas12::where('id', $id)->get();

        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['value'] = $data;

            return response($res);
        }else{
            $res['message'] = "Empty!";

            return response($res);
        }
    }
}
