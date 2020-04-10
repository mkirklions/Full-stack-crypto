

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

						<form method="POST" action=/txns> 
							{{csrf_field()}}
							<div class="form-group">
								<label for="nickname">Friend's Nickname: </label>
								<input type="text" class="form-control" id="nickname" name='nickname' aria-describedby="textHelp" placeholder="Enter your Friend's Nickname" required>
								<small id="textHelp" class="form-text text-muted">Your friend can find this on their Home screen</small>
							</div>
							<div class="form-group">
								<label for="myspy_to_send">Send MySPY to your friend:</label>
								<input type="number" max="1000" min="0" step="any" class="form-control" id="myspy_to_send" name="myspy_to_send" placeholder="Enter MySPY to send" >
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

