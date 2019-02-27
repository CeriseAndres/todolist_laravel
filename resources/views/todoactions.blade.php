@extends('layouts.app')

@section('content')

<div class="container">
	
    <div class="row justify-content-center">
    	<div class="col-md-11">
    		<div class="card">
                <div class="card-header">To-Do List</div>

                <div class="card-body">
                    
                    <div class="row justify-content-around">
                    	@foreach ($todoactions as $todoaction)
                    	<div class="col-md-3">
                    		<div class="card mb-3">
                				<div class="card-header">{{ $todoaction->label }}<a href="#" class="badge badge-pill badge-secondary">X</a></div>
								<div class="card-body">
									<p class="text-center">{{ $todoaction->status }}</p>
									<ul>
										@foreach ($todoaction->users as $users)
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
