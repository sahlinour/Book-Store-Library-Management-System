@extends('layouts.layout')

@section('style') 
    <style>
        button {
            background-color: #8b4513;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-left: 0px;
            margin-top: 0;
        }
        .card{
            height: 500px;
        }
        .card-book {
    background-color: #4b362190; 
    color: #ecf0f1; 
    border-radius: 15px; 
    border:3px solid #856d5b;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); 
    padding: 30px; 
    margin-top: 40px;
    margin-bottom: 20px;
}

.card-book h1 {
    font-size: 24px;
    margin-bottom: 30px; 
}

.card-book p {
    font-size: 16px;
    margin-bottom: 10px; 
}

.card-book img {
    max-width: 100%; 
    border-radius: 10px;
    margin-top: 0px; 
    width: 300px;
    height: 400px;
    margin-left: 150px;
}

 
.btn-download {
            background-color: #937657;
            color: #fff;
           padding-left: 40px;
           padding-right: 40px;
           padding-bottom: 10px;
           padding-top: 10px;
            margin-left: 10px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .btn-download:hover {
            background-color: #625644;
            color: #fff;
        }
.col1{
    margin-top: 20px;
}
</style>
@endsection

@section('content')
    <div class="container">
         <div class="card-book ">
            
            <div class="card-body">
                 <div class="row">
                    <div class="col-6 col1">
                        <p class=""><strong>Titre:</strong> {{$livre->titre}}</p>
                        <p class=""><strong>Année de publication:</strong> {{$livre->année_publication}}</p>
                        <p class=""><strong>Genre:</strong> {{ $livre->genre }}</p>
                        <p class=""><strong>Résumé:</strong> {{ $livre->resume }}</p>
                        <p class=""><strong>Langue:</strong> {{ $livre->langue }}</p>
                        <p class=""><strong>Nombre d'exemplaires:</strong> {{ $livre->nombre_exemplaires }}</p>
                        <p class=""><strong>Disponible:</strong> {{ $livre->disponible }}</p>
                        <p class=""><strong>Auteur:</strong>  @if($livre->auteur)
                            {{ $livre->auteur->nom }}
                        @else
                            N/A
                        @endif</p>
                    </div>
                    <div class="col-sm-6">
                        <img class="img-thumbnail" src="{{asset('/storage/'.$livre->image_couverture)}}" alt="livre image">
                    </div>
                    <div class="bouttons">
                        <div class="mt-4">
                            <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-download">Modifier</a>
                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-download ml-2"> Supprimer</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endsection