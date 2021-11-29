@extends('layout')

@section('content')
	<div class="container">
		<div align="center">
			<h1>My Gallery</h1>	
		</div>
		<div class="row">
			@foreach($imagesInView as $image)
				<div class="col-md-3 gallery-item">
					<img src="/{{$image->image}}" class="img-thumbnail" alt="">
					<a href="/show/{{$image->id}}" class="btn btn-success my-button">Viewing</a>
					<a href="/delete/{{$image->id}}" class="btn btn-danger my-button" onclick="return confirm('are you sure?')">Deletion</a>
					<a href="/edit/{{$image->id}}" class="btn btn-warning my-button">Edit</a>
				</div>
			@endforeach
		</div>	
	</div>

@endsection