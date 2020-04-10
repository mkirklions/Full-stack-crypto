

@extends ('layout')


@section('content')


<div id="fh5co-pricing" data-section="about">
	<div class="container">


		<div class="frontPageNote">
			<h2> Register</h2>
		</div>

		<div id="fh5co-testimonials" >		
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<form method="POST" action=/register> 
							{{csrf_field()}}
							<div class="form-group">
								<label for="nickname">Your Nickname people will see and enter: </label>
								<input type="text" class="form-control" id="nickname" name='nickname' aria-describedby="textHelp" placeholder="Enter Nickname" required>
								<small id="textHelp" class="form-text text-muted">For your privacy, transactions will contain only Nicknames allowing annominity.</small>
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
							</div>


							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
							</div>

							<div class="form-group">
								<label for="password_confirmation">Password:</label>
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password" required>
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

