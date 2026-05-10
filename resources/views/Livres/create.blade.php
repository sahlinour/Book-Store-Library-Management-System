@extends('layouts.layout')

@section('style') 
    <style>

        .custom-form {
            border: 3px solid #917354;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
            
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
            background-color: ;
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
            margin-left: 666px;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #886e49;
        }
       .f1{
        margin-left: 305px;
       }
       
    </style>
@endsection

@section('content')
    <div>
    <form action="{{ route('import.excel') }}" method="post" enctype="multipart/form-data" class="mt-3 f1">
        @csrf
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="fichier" class="custom-file-input" id="inputFile">
                    <label class="custom-file-label" for="inputFile">Choisir un fichier</label>
                </div>
                <div class="input-group-append">
                    <button type="submit" class="">Importer</button>
                </div>
            </div>
        </div>
    </form>
    
    <div class="container mt-5">
        
        <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
            @csrf
            @method('POST')
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="titre" required placeholder="Titre">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="année_publication" required placeholder="Année Publication">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="genre" required  placeholder="Genre">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="resume" required  placeholder="resume">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="langue" required placeholder="Langue">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="number" class="form-control" name="nombre_exemplaires" step="0.01" required placeholder="Nombre d'exemplaires">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="disponible"  placeholder="Disponible" checkedy>
                            <label class="form-check-label" for="disponible">Cochez si disponible</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nom" required placeholder="Nom de l'auteur">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="prenom" required placeholder="Prenom de l'auteur">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="file" class="form-control" name="image_couverture" placeholder="Image Couverture" accept="png,jpg,jpeg">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn ">Enregistrer</button>
                </div>
                
            </div>
    
        </form>
       
    </div>
</div>
   

@endsection