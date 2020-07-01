@if($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif

@if(count($errors) > 0 )
<div class="alert alert-danger">
	<strong>Whoooppss !!</strong> There were some problem with your input. <br>
	<ul>
		@foreach($errors->all() as $error)
			<li> {{ $error }} </li>
		@endforeach
	</ul>
</div>
@endif
