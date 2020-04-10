
<!DOCTYPE html>
<html>
<head>

window.Laravel = {
    csrf-token: '{{csrf_token()}}'
} 

    <script>
            window.Laravel = <?php echo json_encode([
                'csrf-token' => csrf_token(),
            ]); ?>
        </script>

	<title>MySPY</title>

	@include ('header')
	
	@include('navbar')

</head>
<body>




		@yield('content')

	</div>
 
	@include('footer')
</body>
</html>