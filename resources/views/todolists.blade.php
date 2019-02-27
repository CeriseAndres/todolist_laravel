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
    	<div class="col-md-11">
    		<div class="card">
                <div class="card-header">Mes To-Do Lists</div>

                <div class="card-body">
                    
                    <div class="row justify-content-around">
                    	@foreach ($todolists as $todolist)
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">{{ $todolist->label }}<a href="#" class="badge badge-pill badge-secondary pt-1 pr-1">X</a></div>
								<div class="card-body">
									<ul>
										@foreach($todolist->users as $user)
											<li>{{ $user->name }}</li>
										@endforeach
									</ul>
								</div>
								<button type="button" class="btn btn-outline-info mx-2">Détail</button>
								<small class="text-center">Dernière MAJ {{ $todolist->updated_at }}</small>
							</div>
                    	</div>
                    	@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
