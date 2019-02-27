@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{ session('status') }}</strong>Vous êtes connecté {{ Auth::user()->name }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="container">	
    <div class="row justify-content-center">
    	<div class="col-md-5">
    		<div class="card">
                <div class="card-header">Ajouter une To-Do List</div>

                <div class="card-body">
                    
                	<form method="POST" action="{{ route('add_todolist') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="label" class="col-md-4 col-form-label text-md-right">Titre</label>

                            <div class="col-md-6">
                                <input id="label" type="text" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" name="label" value="{{ old('label') }}" required autofocus>

                                @if ($errors->has('label'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('label') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="users" class="col-md-4 col-form-label text-md-right">Utilisateurs</label>

                            <div class="col-md-6">
                                <select>
                                @foreach($users as $user)
                                	<option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <input type="hidden" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ Auth::id() }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
