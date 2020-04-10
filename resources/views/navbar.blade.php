	<!--///// HEADER-NAVIGATION BAR START  /////-->
		<header role="banner" id="fh5co-header">
			
				<nav class="navbar navbar-default">
					<div class="navbar-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
				
						<a href="http://movetosuccesspt.com/" data-nav-section="home" class="special" style="display:inline-block;">MySPY</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">

							<li><a href="http://movetosuccesspt.com/muscle-injuries/"><span>Privacy</span></a></li>
							<li><a href="http://movetosuccesspt.com/muscle-injuries/"><span>FAQ</span></a></li>
							
						@if (Auth::check())
							<form method="POST" action=/logout>
									{{csrf_field()}}
								<button type="submit" class="btn btn-primary">logout</button>
							</form>
							<li><a href="http://movetosuccesspt.com/blog/" class="sub"><span>{{Auth::user()->nickname}}</span></a></li>
						@endif
						</ul>
					</div>
				</nav>
			
		</header>