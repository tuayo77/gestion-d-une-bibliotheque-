@extends('account.index')

@section('content')

<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="module module-login span4 offset1">
				<form class="form-vertical" action="{{ URL::route('account-sign-in-post') }}" method="POST">
					<div class="module-head">
						<h3>Bibliothécaire / Administrateur Connexion</h3>
					</div>
					<div class="module-body">
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="text" name="username" placeholder="Username" value="{{ Input::old('login') }}" autofocus>
								@if($errors->has('user_login'))
									{{ $errors->first('login')}}
								@endif									
							</div>
						</div>
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="password" name="password" placeholder="Password">
								@if($errors->has('password'))
									{{ $errors->first('password')}}
								@endif									
							</div>
						</div>
					</div>
					<div class="module-foot">
						<div class="control-group">
							<div class="controls clearfix">
								<button type="submit" class="btn btn-primary pull-right"> Connexion </button>
								{{ Form::token() }}
								<label class="checkbox">
									<input type="checkbox" name="remember" id="remember"> Souviens-toi de moi
								</label>
							</div>
						</div>
						{{-- <a href="{{ URL::route('account-create') }}">Nouveau bibliothécaire ? S'inscrire</a> --}}
					</div>
				</form>
			</div>
			<div class="module module-login span4 offset2">
				<div class="module-head">
					<h3>Section étudiante</h3>
				</div>
				<div class="module-body">
                    <p><a href="{{ URL::route('student-registration') }}"><strong>Formulaire d'inscription des étudiants</strong></a></p>
                    <p><a href="{{ URL::route('search-book') }}"><strong>Rechercher un livre</strong></a></p>
				</div>
			</div>
        </div>
	</div>
</div>

@stop