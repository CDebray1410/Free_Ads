<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier une annonce') }}
        </h2>
    </x-slot>
    <br/>
    <div class="container">
        <div class="row justify-content-center">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('ad.updateAd' , ['id' => $announceInfos['id']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Titre de l'annonce</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" aria-describedby="title" value="{{$announceInfos['title']}}" name="title">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Descrivez de l'annonce</label>
                    <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10" >{{$announceInfos['description']}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <input type="text" class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" id="localisation" name="localisation" value="{{$announceInfos['localisation']}}">
                    @if ($errors->has('localisation'))
                        <span class="invalid-feedback">{{ $errors->first('localisation') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" name="price" value="{{$announceInfos['price']}}">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="picture">Image</label>
                    <input type="file" class="form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture" name="picture" value="{{$announceInfos['picture']}}">
                    @if ($errors->has('picture'))
                        <span class="invalid-feedback">{{ $errors->first('picture') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <p>Ancienne image de l'annonce</p>
                    <img src="{{ asset('storage') }}/{{ $announceInfos['picture'] }}" class="img-thumbnail" alt="image d'annonce" style="margin: 8px 0px; border: double 5px lightgray;">
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</x-app-layout>