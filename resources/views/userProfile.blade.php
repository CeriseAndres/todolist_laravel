@extends('layouts.app')



@section('content')

@if (session('update-ok'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
	<strong>{{ session('update-ok') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="container">
    <div class="row m-y-2">
        <!-- edit form column -->
        <div class="col-lg-4 text-lg-center">
            <h2>Mise à jour du profil</h2>
        </div>
        <div class="col-lg-8 push-lg-4 personal-info">
        	<small class="text-center">Dernière MAJ {{ Carbon\Carbon::parse(Auth::user()->updated_at)->format('d-m-Y à H:i:s') }}</small>
             <form action="{{ route('users.update', ['id' => Auth::id()]) }}" method="post">
 	            {{ csrf_field() }}
            	{{ method_field('PUT') }}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Nom</label>
                    <div class="col-lg-9">
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" value="{{ Auth::user()->name }}" name="name" />
                    	{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Adresse Mail</label>
                    <div class="col-lg-9">
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" value="{{ Auth::user()->email }}" name="email" />
                    	{!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Mot de passe</label>
                    <div class="col-lg-9">
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" value="" name="password" />
                    	{!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Confirmation du mot de passe</label>
                    <div class="col-lg-9">
                        <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" value="" name="password_confirmation"/>
                    	{!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Annuler" />
                        <input type="submit" class="btn btn-primary" value="Sauvegarder"/>
                        
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
            <form action="{{ route('users.destroy', ['id' => Auth::id()]) }}" method="post">
				<input type="hidden" name="label" value="{{ Auth::user() }}">
				{{ method_field('delete') }}
				@csrf
				<button type="submit" class="btn btn-warning">Supprimer utilisateur</button>
			</form>
        </div>
    </div>
</div>
<hr />

@endsection