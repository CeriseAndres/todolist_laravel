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

@if (session('update-ok'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
	<strong>{{ session('update-ok') }}</strong>
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
								<button type="button" class="btn btn-outline-info btn-sm mx-2"><a href="{{ route('show_todolist_detail', ['todolist_id' => $todolist->id]) }}">Détail</a></button>
								<button type="button" class="btn btn-outline-secondary btn-sm mx-2 mt-1" data-toggle="modal" data-target="#exampleModal">Modifier</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Modifier la liste {{ $todolist->label }}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<div class="modal-body">
										<form method="POST" action="{{ route('todolists.update', ['id' => $todolist->id]) }}">
                        					@csrf
                        					{{ method_field('put') }}
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
                        					<div class="form-group row mb-0 justify-content-center">
                            					<div class="col-md-6">
                                					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            					</div>
                            					<div class="col-md-6">
                                					<button type="submit" class="btn btn-primary">Enregistrer</button>
                            					</div>
                        					</div>
                    				</form>
      </div>
    </div>
  </div>
</div>
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

                        					<div class="form-group row mb-0 justify-content-center">
                            					<div class="col-md-12">
                                					<button type="submit" class="btn btn-sm btn-outline-info m-2">
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
