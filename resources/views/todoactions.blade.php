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
                <div class="card-header">Mes Tâches</div>

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
                				</div>
								<div class="card-body">
									<p class="text-center">{{ $todoaction->status[0]->label }}</p>
									<ul>
										@foreach ($todoaction->users as $user)
											<li>{{ $user->name }}</li>
										@endforeach
									</ul>
								</div>
								<button type="button" class="btn btn-outline-info mx-2">Détail</button>
								<small class="text-center">Dernière MAJ {{ $todoaction->updated_at }}</small>
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
