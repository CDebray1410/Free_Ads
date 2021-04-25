<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recherche') }}
        </h2>
    </x-slot>
    <br/>
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('search.name') }}">
            <legend style="text-align: center;">Recherche par nom</legend>
                @csrf
                <div class="form-group">
                    <label for="name">Entrez le nom</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required />
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                    @endif
                </div><br/>
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <hr/>
            </form>

            <form method="POST" action="{{ route('search.localisation') }}">
            <legend style="text-align: center;">Recherche par localisation</legend>
                @csrf
                <div class="form-group">
                    <label for="localisation">Entrez la localisation</label>
                    <input type="text" name="localisation" id="localisation" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required />
                    @if ($errors->has('localisation'))
                        <span class="invalid-feedback">{{ $errors->first('localisation') }}</span>
                    @endif
                </div><br/>
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <hr/>
            </form>

            <form method="POST" action="{{ route('search.price') }}">
            <legend style="text-align: center;">Recherche par prix</legend>
                @csrf
                <div class="form-group">
                    <label for="nom">Entrez prix min</label>
                    <input type="number" name="min" id="min" class="form-control {{ $errors->has('min') ? 'is-invalid' : '' }}" />
                    @if ($errors->has('min'))
                        <span class="invalid-feedback">{{ $errors->first('min') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nom">Entrez prix max</label>
                    <input type="number" name="max" id="max" class="form-control {{ $errors->has('max') ? 'is-invalid' : '' }}" />
                    @if ($errors->has('max'))
                        <span class="invalid-feedback">{{ $errors->first('max') }}</span>
                    @endif
                </div><br/>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
    </div>
</x-app-layout>