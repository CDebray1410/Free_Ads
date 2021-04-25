<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messagerie') }}
        </h2>
    </x-slot>
    <br/>
    <div class="container">
        <div class="row justify-content-center">
        @if (count($messages) == 0 || $messages == null)
            <h2> Vous n'avez reçu ou envoyé aucun message !</h2>
        @else

            @foreach ($messages as $message)
                @if ($message->user_id == $my_id)
                <div class="card text-white bg-success mb-3 col-9" >
                @else
                <div class="card text-white bg-primary mb-3 col-9">
                @endif
                    <div class="card-header">
                        {{ $message->sender_name }}
                        @if ($message->user_id == $my_id)
                        <a href="{{ route('message.delete', ['id' => $message->id] ) }}" class="btn btn-danger"  style="margin-left: 10px;">X</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $message->content }}</p><hr/>
                        <p class="card-text">
                            <i>Envoyé le : {{ date("d/m/Y H:i:s", strtotime($message->created_at)) }}</i>
                            @if ($message->created_at != $message->updated_at)
                                <i>Modifié le : {{ date("d/m/Y H:i:s", strtotime($message->updated_at)) }}</i>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
        <div class="row justify-content-center">

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @elseif (session()->has('problem'))
                <div class="alert alert-danger">
                    {{ session()->get('problem') }}
                </div>
            @endif
            <form method="POST" action="{{ route('message.store') }}">
                @csrf
                <div class="form-group">
                    <label for="destination">Ecrivez le destinataire</label>
                    <input type="text" class="form-control {{ $errors->has('destination') ? 'is-invalid' : '' }}" id="destination" aria-describedby="destination" name="destination">
                    @if ($errors->has('destination'))
                        <span class="invalid-feedback">{{ $errors->first('destination') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="message">Ecrivez votre message</label>
                    <textarea name="message" id="message" class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" cols="20" rows="10"></textarea>
                    @if ($errors->has('message'))
                        <span class="invalid-feedback">{{ $errors->first('message') }}</span>
                    @endif
                </div><br/>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</x-app-layout>