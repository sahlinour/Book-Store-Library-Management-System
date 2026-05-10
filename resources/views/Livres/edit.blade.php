@extends('layouts.layout')

@section('style') 
    <style>
        .custom-form {
            border: 3px solid #917354;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
            width: 100%;
            background-color: #4b362190;
            margin: auto;
            border-radius: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            overflow: hidden;
            width: 900px;
        }

        
        .form-group input {
            width: 48%;
            float: left;
            margin-right: 4%;
            border: 2px solid #6c5741;
            border-radius: 4px;
            box-sizing: border-box;  
            background-color: #d0c6bbe5;
            color: #050403
        }
        .form-control::placeholder {
              color: #000000; 
         }

        .form-group input:last-child {
            margin-right: 0;
          
        }
        
        .btn {
            background-color: #937449;
            color: #fff;
            padding-left: 70px;
           padding-right: 70px;
           padding-bottom: 10px;
           padding-top: 10px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin-left: 720px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #886e49;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">

        <form action="{{ route('livres.update',  $livre->id) }}" method="POST" enctype="multipart/form-data" class="custom-form">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="titre" required placeholder="Titre" value="{{ $livre ? $livre->titre : '' }}">
                        @error('titre')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="année_publication" required placeholder="Année Publication" value="{{ $livre ? $livre->année_publication : '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="genre" required placeholder="Genre" value="{{ $livre ? $livre->genre : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="resume" required placeholder="resume" value="{{ $livre ? $livre->resume : '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="langue" required placeholder="Langue" value="{{ $livre ? $livre->langue : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="number" class="form-control" name="nombre_exemplaires" step="1" required placeholder="Nombre d'exemplaires" value="{{ $livre ? $livre->nombre_exemplaires : '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="disponible" value="1" {{ $livre && $livre->disponible ? 'checked' : '' }}>
                            <label class="form-check-label" for="disponible">Cochez si disponible</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nom" required placeholder="Nom de l'auteur" value="{{ $livre ? $livre->auteur_id : '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="prenom" required placeholder="Prenom de l'auteur" value="{{ $livre ? $livre->auteur_id : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="file" class="form-control" name="image_couverture" placeholder="Image Couverture">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col eng">
                    <button type="submit" class="btn">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>

@endsection
