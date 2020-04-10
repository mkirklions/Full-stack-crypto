

@extends ('layout')


@section('content')


<div id="fh5co-pricing" data-section="about">
	<div class="container">


		<div class="frontPageNote">
			<h2> Payment</h2>
		</div>

		<div id="fh5co-testimonials" >		
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<form method="POST" action=/update> 
							{{csrf_field()}}
							<div class="form-group">
								<label for="first_name">First Name: </label>
								<input type="text" class="form-control" id="first_name" name='first_name' aria-describedby="textHelp" placeholder="Enter your First Name" required>
							</div>
							<div class="form-group">
								<label for="last_name">Last Name: </label>
								<input type="text" class="form-control" id="last_name" name='last_name' aria-describedby="textHelp" placeholder="Enter your Last Name" required>
							</div>
							<div class="form-group">
								<label for="street_address">Friend's Nickname: </label>
								<input type="text" class="form-control" id="street_address" name='street_address' aria-describedby="textHelp" placeholder="Enter your Street Address" required>
								<small id="textHelp" class="form-text text-muted">Include apartment or building number</small>
							</div>
							<div class="form-group">
								<label for="city">City: </label>
								<input type="text" class="form-control" id="city" name='city' aria-describedby="textHelp" placeholder="Enter your City" required>
							</div>
							<div class="form-group">
								<label for="postal_code">Postal Code: </label>
								<input type="number" class="form-control" id="postal_code" name='postal_code' aria-describedby="textHelp" placeholder="Enter your Postal Code" required>
							</div>
							<div class="form-group">
								<label for="associated_number">SSN: </label>
								<input type="text" class="form-control" id="associated_number" name='associated_number' aria-describedby="textHelp" placeholder="Enter your SSN" required>
								<small id="textHelp" class="form-text text-muted">Tax purposes only</small>
							</div>
							<div class="form-group">
								<label for="phone_number">Phone Number: </label>
								<input type="text" class="form-control" id="phone_number" name='phone_number' aria-describedby="textHelp" placeholder="Enter your Phone Number" required>
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

