<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ImageController extends Controller
{
    public function findJson(Request $request)
    {
        $image = Image::find($request->id);
        if ($image) {
            $imageInfo = [
                'id' => $image->id,
                'name' => $image->name,
                'created_at' => $image->created_at
            ];
            $jsonResponse = json_encode($imageInfo);
        } else {
            return response()->json(['error' => 'Файл с указанным ID не найден'], 404);
        }
        return view('findjson',compact('jsonResponse'));

    }
    public function json()
    {
        $files = glob('uploads/*');
        $fileInfo = [];
        foreach ($files as $file) {
            $fileInfo[] = [
                'name' => basename($file),
                'created_at' => filemtime($file),
            ];
        }
        echo json_encode($fileInfo);
    }



    public function Zip(Request $request)
    {
        $name = $request->name;
        $zip = new ZipArchive;
        if ($zip->open($name.'.archive.zip', ZipArchive::CREATE) === TRUE) {
            $zip->addFile(public_path('/uploads/' . $name), $name);
            $zip->close();
        }
        return response()->download($name.'.archive.zip');
    }



    public function index()
    {
        $images = Image::all();
        return view('index',compact('images'));
    }
    public function sort(Request $request)
    {
        $orderBy = $request->get('order_by','name');
        $orderDirection = $request->get('order_direction','asc');
        $images = Image::orderBy($orderBy,$orderDirection)->get();

        return view('index',compact('images'));
    }

    public function create()
    {
        return view('create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'imageName' => 'required',
            'imageName' => 'max:5',
            'imageName.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        if ($request->hasfile('imageName')) {
            foreach ($request->file('imageName') as $file) {
                $name = strtolower(Helpers\translit($file->getClientOriginalName()));
                $exists = Image::where('name',$name)->exists();
                if ($exists) {
                    $name = Str::uuid()->toString().'.jpg';
                }
                $file->move(public_path() . '/uploads/', $name);
                $imgData = $name;
                $fileModal = new Image();
                $fileModal->name = $imgData;
                $fileModal->save();
                $imgData=null;
            }
            return redirect('/');
        }
    }
}
