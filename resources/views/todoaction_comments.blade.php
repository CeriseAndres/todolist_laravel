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
                
                <div class="card-header">
                	<span>Commentaires pour la tâche {{ $todoaction_label[0]->label }}</span>
                	<a href="{{ route('show_todolist_detail', ['id' => $todolist_id[0]->todolist_id]) }}" class="badge badge-pill badge-secondary pt-1 pr-1 float-right mt-1">	&lt;</a>
                </div>                

                <div class="card-body">
                    
                    <table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Auteur</th>
								<th scope="col">Message</th>
								<th scope="col">Date</th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
						@foreach ($comments as $comment)
							<tr>
								<th scope="row">{{ $comment->user[0]->name }}</th>
								<td>{{ $comment->text }}</td>
								<td><small>{{ Carbon\Carbon::parse($comment->updated_at)->format('d-m-Y à H:i:s') }}</small></td>
								<td>
									<button type="button" class="btn btn-outline-secondary btn-sm mx-2" data-toggle="modal" data-target="#exampleModal{{ $comment->id }}">Modifier</button>
								<!-- Modal -->
								<div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Modifier le commentaire n° {{ $comment->id }}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST" action="{{ route('comments.update', ['id' => $comment->id]) }}">
                        						@csrf
                        						{{ method_field('put') }}
                        						<div class="form-group row">
                            						<label for="label" class="col-md-12 col-form-label text-md-center">Message</label>
                            						<div class="col-md-12">
                                						<textarea id="label" type="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" value="{{ old('text') }}" required></textarea>

                                						@if ($errors->has('text'))
                                    					<span class="invalid-feedback" role="alert">
                                        					<strong>{{ $errors->first('text') }}</strong>
                                    					</span>
                                						@endif
                            						</div>
                        						</div>                        
                        						
                        						<div class="form-group row mb-0 justify-content-center">
                            						<div class="col-md-6">
                                						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            						</div>
                            						<div class="col-md-6">
                                						<button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                            						</div>
                        						</div>
                    						</form>
										</div>
									</div>
								</div>
							</div>
								</td>
								<td>
									<form action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="post">
                						{{ method_field('delete') }}
                						@csrf
                						<button type="submit" class="btn btn-outline-danger mx-2 btn-sm">X</button>
                					</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<form method="POST" action="{{ route('comments.store') }}">
    	             	@csrf
						<div class="form-group row">
                       		<label for="label" class="col-md-12 col-form-label text-md-center">Message</label>
                       		<div class="col-md-12">
                           		<textarea id="label" type="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" value="{{ old('text') }}" required></textarea>
                              	@if ($errors->has('text'))
                                <span class="invalid-feedback" role="alert">
                                  	<strong>{{ $errors->first('text') }}</strong>
                                </span>
                               	@endif
                       		</div>
                   		</div>
                        
                   		<input type="hidden" class="form-control{{ $errors->has('todoaction_id') ? ' is-invalid' : '' }}" name="todoaction_id" value="{{ $todoaction_id }}">
                   		<input type="hidden" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ Auth::id() }}">
              			<div class="form-group row mb-0 justify-content-center">
                			<div class="col-md-12">
                				<button type="submit" class="btn btn-block btn-outline-info">
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
