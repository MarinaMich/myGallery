@extends('layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<img src="/{{$imageInView->image}}" alt="" class="img-thumbnail">
				<form action="/update/{{$imageInView->id}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-control">
						<input type="file" name="image">
					</div>
					<button type="submit" class="btn btn-warning my-button">Edit</button>
				</form>
			</div>
		</div>
	</div>
@endsection