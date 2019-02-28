@extends('layouts.app')

@section('content')

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
                <div class="card-header"><a href="{{ route('show_todolists', ['id' => Auth::id()]) }}" class="badge badge-pill badge-secondary pt-1 pr-1">	&lt;</a>{{ $todolist_label[0]->label }}</div>
                <div class="card-body">
                    
                    <div class="row justify-content-around">
                    	@foreach ($todoactions as $todoaction)
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">{{ $todoaction->label }}
									<form action="{{ route('todoactions.destroy', ['todoaction_id' => $todoaction->id]) }}" method="post">
                						<input type="hidden" name="label" value="{{ $todoaction->label }}">
                						{{ method_field('delete') }}
                						@csrf
                						<button type="submit" class="badge badge-pill badge-secondary pt-1 pr-1">X</button>
                					</form>
								</div>
								<div class="card-body">
									<p class="text-center">Status : </p>
									<form action="{{ route('updateStatus', ['id' => $todoaction->id]) }}" method="POST">
									@csrf
                        			{{ method_field('put') }}
									<select class="form-control form-control-sm" name="status_id" id="status_select" onchange="this.form.submit()">
										<option value="{{ $todoaction->status_id }}" selected>{{ $todoaction->status[0]->label }}</option>
										@for($i = 1; $i <= 4; $i++)
											@if($i != $todoaction->status_id)
												@if($i == 1)
													<option value="1">A faire</option>
												@endif
												@if($i == 2)
												<option value="2">En cours</option>
												@endif
												@if($i == 3)
												<option value="3">Achevé</option>
												@endif
												@if($i == 4)
												<option value="4">Archivé</option>
												@endif
											@endif
										@endfor
									</select>
									</form>
									<p class="text-center mt-2">Utilisateurs : </p>
									<ul>
										@foreach ($todoaction->users as $user)
											<li>{{ $user->name }}
												<form action="{{ route('todoactionsUserDestroy', ['id' => $todoaction->id]) }}" method="post">
                									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
                									{{ method_field('delete') }}
                									@csrf
                									<button type="submit" class="badge badge-pill badge-secondary pt-1 pr-1">X</button>
                								</form>
											</li>
										@endforeach
									</ul>
								</div>
								<button type="button" class="btn btn-outline-info mx-2 btn-sm"><a href="{{ route('show_todoaction_comments', ['todoaction_id' => $todoaction->id]) }}">Commentaires</a></button>
								<button type="button" class="btn btn-outline-secondary btn-sm mx-2 mt-1" data-toggle="modal" data-target="#exampleModal{{ $todoaction->id }}">Modifier</button>
								<!-- Modal -->
								<div class="modal fade" id="exampleModal{{ $todoaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Modifier la tâche {{ $todoaction->label }}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST" action="{{ route('todoactions.update', ['id' => $todoaction->id]) }}">
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
								<small class="text-center">Dernière MAJ {{ Carbon\Carbon::parse($todoaction->updated_at)->format('d-m-Y à H:i:s') }}</small>
							</div>
                    	</div>
                    	@endforeach
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">Nouvelle Tâche</div>
								<div class="card-body">
									<form method="POST" action="{{ route('add_todoaction', ['id' => Auth::id()]) }}">
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
                        					<input type="hidden" class="form-control{{ $errors->has('todolist_id') ? ' is-invalid' : '' }}" name="todolist_id" value="{{ $todolist_id }}">

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
