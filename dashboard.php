<?php
	session_start();
	if (!(isset($_SESSION['screen']) && isset($_SESSION['pin'])))
	{
		header("Location: index.php");
		die();
	}
	
	$tracks_json = file_get_contents("/Server/getsongs.php?screen=" . $_SESSION['screen']);
	$tracks = json_decode($tracks_json, true);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Music Chooser</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cyborg/bootstrap.min.css" rel="stylesheet" integrity="sha256-ZgJYmqb5jZ8WCDqIYHlUarCVI7NDkBCeFnMW1gfihwY= sha512-yK8VlGnQXDlAH4aaZwd0EfmkYwv/XwZaA7VcT9JDO1YeZSvzu94p7/btLABkerIR26o7uYIiEmY59gQv/w/itA==" crossorigin="anonymous">
		<style>
			body
			{
				padding-top: 20px;
			}
		</style>	
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<h1>Music Chooser - <?php echo $_SESSION['screen_name']; ?><</h1>
				<h4><em>Welcome to <?php echo $_SESSION['screen_location']; ?></em></h4><hr>
				<h5>Add New Song</h5>
				<div class="container">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-1 control-label">Artist:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control input-large" name="artist" placeholder="Enter artist here">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">Song:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control input-large" name="track" placeholder="Enter track here, or leave blank for default">
							</div>
						</div>
						<button type="submit" class="btn btn-default col-sm-offset-1">Request &raquo;</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="well">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Artist</th>
							<th>Track</th>
							<th>Votes</th>
							<th><span class="glyphicon glyphicon-thumbs-up"></span></th>
							<th><span class="glyphicon glyphicon-thumbs-down"></span></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($tracks as $track)
							{
								echo '<tr><td>' . $track['artist']
								. '</td><td>' . $track['track'] . '</td><td>'
								. $track['votes'] . '</td><td><span class="glyphicon glyphicon-thumbs-up">
								</span></td><td><span class="glyphicon glyphicon-thumbs-down"></span></td></tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- Loading the JS at the bottom for faster page loading -->
		<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>