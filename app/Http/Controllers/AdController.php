<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdStore;
use App\Http\Requests\AdUpdate;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function search()
    {
        return view('search');
    }

    public function delete($id)
    {
        $delete = DB::table('ads')
        ->where('id', $id)
        ->delete();

        return redirect('annonce/showAnnounce')->with('success', 'L\'annonce a bien été supprimée !');
    }

    public function showAnnounce()
    {
        $users = User::all();
        $annouces = Ad::all();

        return view('announceDisplay', ['announces' => $annouces, 'users' => $users, 'my_id' => auth()->id()]);
    }

    public function showAnnounceUpdate($id)
    {

        $annouces = Ad::all();
        $annouceInfos = $annouces->find($id);

        return view('modifyAnnounce', ['announceInfos' => $annouceInfos]);
    }

    public function store(AdStore $request)
    {
        $validated = $request->validated();

        $path = $request->file('picture')->store('public/announces');
        $pathSave = $request->file('picture')->store('/announces');

        $ad = new Ad();
        $ad->user_id = auth()->id();
        $ad->title = $validated['title'];
        $ad->description = $validated['description'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->picture = $pathSave;

        $ad->save();
        return redirect('annonce/showAnnounce')->with('success', 'L\'annonce a bien été crée !');
    }

    public function update($id, AdUpdate $request)
    {
        $validated = $request->validated();
        $ad = new Ad();
        $adPicture = $ad->find($id)->picture;
        $pathSave;

        if(empty($request->file('picture')) ) {
            $pathSave = $adPicture;
        } else {
            $path = $request->file('picture')->store('public/announces');
            $pathSave = $request->file('picture')->store('/announces');
        }


        $annouceInfos = $ad->find($id)->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'localisation' => $validated['localisation'],
            'picture' => $pathSave
        ]);

        return redirect('annonce/showAnnounce')->with('success', 'L\'annonce a bien été modifiée !');
    }

    public function searchName(Request $request)
    {
        $ad = new Ad();
        $getAds = DB::table('ads')->where('title','LIKE','%'.$request['name'].'%')
                ->get(); 
        $users = User::all();

        return view('searchResult', ['announces' => $getAds, 'users' => $users, 'my_id' => auth()->id()]);
    }

    public function searchPrice(Request $request)
    {
        $ad = new Ad();
        
        $annouces = Ad::all();
        if (empty($request['min'])) {
            $request['min'] = 0;
        } elseif (empty($request['max'])) {
            $request['max'] = 1000000000000000000000;
        }
        $getAds = $annouces->whereBetween('price', [$request['min'], $request['max']]);
        $users = User::all();

        return view('searchResult', ['announces' => $getAds, 'users' => $users, 'my_id' => auth()->id()]);
    }

    public function searchLocalisation(Request $request)
    {
        $ad = new Ad();
        $getAds = DB::table('ads')->where('localisation','LIKE','%'.$request['localisation'].'%')
                ->get(); 
        $users = User::all();

        return view('searchResult', ['announces' => $getAds, 'users' => $users, 'my_id' => auth()->id()]);
    }
}
