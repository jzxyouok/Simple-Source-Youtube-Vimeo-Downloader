<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script>
	$(document).ready(function() {
		$("#downloader").on('submit', function(e){ 
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'env.php',
				data: $(this).serialize(),
				success: function(data) {
					$("#result").empty();
					$.each(data, function(i, obj) {
						$("#result").append(
							'Download: <a href="'+ obj.url +'">' + obj.quality + '</a><br>'
						);
					})
				},
				error: function() {
					$('#result').text('Please try again, something went wrong!');
				}
			});
		});
	});
	</script>
</head>
<body>
<form id="downloader" autocomplete="off">
	<select id="video" name="video">
		<option value="youtube">Youtube</option>
		<option value="vimeo">Vimeo</option>
	</select>
	<input id="url" type="text" name="url">
	<input type="submit" name="submit" value="submit">
</form>
<div id="result"></div>
</body>
</html>