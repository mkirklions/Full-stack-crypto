

@extends ('layout')


@section('content')


<div id="fh5co-pricing" data-section="about">
	<div class="container">


		<div class="frontPageNote">
			<h2> Login</h2>
		</div>

		<div id="fh5co-testimonials" >		
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<form method="POST" action=/login> 
							{{csrf_field()}}
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
							</div>


							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
							</div>

						<div class="form-group"> 
 						<button type="submit" class="btn btn-primary">Submit</button>
 					</div>
 						 
 						@include('errors')

 					</form>

 					
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection('content')

