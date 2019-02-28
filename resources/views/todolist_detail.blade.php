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
									<select class="form-control form-control-sm">
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
									<ul>
										@foreach ($todoaction->users as $user)
											<li>{{ $user->name }}</li>
										@endforeach
									</ul>
								</div>
								<button type="button" class="btn btn-outline-info mx-2">Détail</button>
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
