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

@if (session('add-ok'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{ session('add-ok') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if (session('del-ok'))
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
	<strong>{{ session('del-ok') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<div class="container">	
    <div class="row justify-content-center">
    	<div class="col-md-11">
    		<div class="card">
                <div class="card-header">Mes To-Do Lists</div>

                <div class="card-body">
                    
                    <div class="row justify-content-around">
                    	@foreach ($todolists as $todolist)
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">{{ $todolist->label }}
                				
<!--                 				<a href="{{ route('delete_todolist', ['id' => $todolist->id, 'user_id' => Auth::id()]) }}" class="badge badge-pill badge-secondary">X</a> -->
                				
                				<form action="{{ route('todolists.destroy', ['todolist_id' => $todolist->id]) }}" method="post">
                					<input type="hidden" name="label" value="{{ $todolist->label }}">
                					{{ method_field('delete') }}
                					@csrf
                					<button type="submit" class="badge badge-pill badge-secondary pt-1 pr-1">X</button>
                				</form>
                				
                				</div>
								<div class="card-body">
									<ul>
										@foreach($todolist->users as $user)
											<li>{{ $user->name }}</li>
										@endforeach
									</ul>
								</div>
								<a href="{{ route('show_todoactions', ['id' => $todolist->id]) }}"><button type="button" class="btn btn-outline-info mx-2">Détail</button></a>
								<small class="text-center">Dernière MAJ {{ $todolist->updated_at }}</small>
							</div>
                    	</div>
                    	@endforeach
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">Nouvelle To-Do List</div>
								<div class="card-body">
									<form method="POST" action="{{ route('add_todolist', ['id' => Auth::id()]) }}">
                        				@csrf

                        					<div class="form-group row">
                            					<label for="label" class="col-md-12 col-form-label text-md-center">Titre</label>

                            					<div class="col-md-12">
                                					<input id="label" type="text" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" name="label" value="{{ old('label') }}" required>

                                				@if ($errors->has('label'))
                                    			<span class="invalid-feedback" role="alert">
                                        		<strong>{{ $errors->first('label') }}</strong>
                                    			</span>
                                				@endif
                            					</div>
                        					</div>
                        
                        					<input type="hidden" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ Auth::id() }}">

                        					<div class="form-group row mb-0">
                            					<div class="col-md-12 offset-md-4">
                                					<button type="submit" class="btn btn-outline-info m-2">
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
            </div>
        </div>
    </div>
</div>
@endsection
