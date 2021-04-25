<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une annonce') }}
        </h2>
    </x-slot>
    <br/>
    <div class="container">
        <div class="row justify-content-around" >
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (count($announces) == 0 || $announces == null)
            <h2> Il n'y a aucune correspondance !</h2>
        @else
            @foreach ($announces as $announce)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage') }}/{{ $announce->picture }}" class="card-img-top" alt="image d'annonce" style="margin: 8px 0px; border: double 5px lightgray;">
                <div class="card-body">
                    <h5 class="card-title">{{ $announce->title }}</h5>
                    <p class="card-text">{{ $announce->description }}</p>
                    <p class="card-text">Localisation : {{ $announce->localisation }}</p>
                    <p class="card-text">Prix : {{ $announce->price }}€</p>
                    @foreach ($users as $user)
                        @if ($user['id'] == $announce->user_id)
                        <p class="card-text">Utilisateur : {{ $user['name'] }}</p>
                        @endif
                    @endforeach
                    <p><small><i>{{ Carbon\Carbon::parse($announce->created_at)->diffForHumans() }}</i></small></p>
                    <a href="#" class="btn btn-success">Acheter</a>
                    @if ($announce->user_id == $my_id)
                        <a href="{{ route('ad.update', ['id' => $announce->id], ['announceInfos' => $announce] ) }}" class="btn btn-info">Modifier</a>
                        <a href="{{ route('ad.delete', ['id' => $announce->id] ) }}" class="btn btn-danger">X</a>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
</x-app-layout>