<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreprofilRequest;
use App\Http\Requests\UpdateprofilRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprofilRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        return view('Profil/profil',['user'=> $User]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        $this->authorize('update',$User->profil);

        return view('Profil/edit-profil',['user'=> $User]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $User)
    {
        $this->authorize('update',$User->profil);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required ',
            'image'=> 'image'
        ]);
        
        if (request('image')){

            $imagePath = request('image')->store('profil','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image->save();
            $oldImagePath = $User->image;
            $User->update(['image' => $imagePath]);
            ProfilController::deleteOldImage($oldImagePath);
        }
        
        
        
        $User->profil->update($data);

        return redirect('/profil/'.$User->id);
    }
    public function deleteOldImage(string $image)
    {
        if ($image == 'profil/images.jfif'){
            return;
        }
        Storage::delete('public/'.$image);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profil $profil)
    {
        //
    }
}
