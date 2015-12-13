<?php
	session_start();
	if (isset($_SESSION['screen']))
		header("Location: dashboard.php");
	
	$screens_json = file_get_contents("http://projectnadia.windowshelpdesk.co.uk/Server/getscreens.php?showpin=1");
	$screens = json_decode($screens_json, true);
	
	if (isset($_POST['screen']) && isset($_POST['pin']))
	{
		foreach ($screens as $s)
		{
			if ($s['id'] == $_POST['screen'] && $s['pin'] == $_POST['pin'])
			{
				$_SESSION['screen'] = $s['id'];
				$_SESSION['pin'] = $s['pin'];
				$_SESSION['screen_name'] = $s['name'];
				$_SESSION['screen_location'] = $s['location'];
				header("Location: dashboard.php");
			}
		}
	}
	
	
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
				<h1>Music Chooser</h1><hr>
				<h5>Connect to Screen</h5>
				<div class="container">
					<form class="form-horizontal" action="index.php" method="POST">
						<div class="form-group">
							<label class="col-sm-1 control-label">Screen:</label>
							<div class="col-sm-5">
								<select class="form-control" name="screen">
									<?php
										foreach ($screens as $screen)
										{
											echo '<option value="' . $screen['id'] . '">' . $screen['location'] . " - " . $screen['name'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">PIN:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control input-large" name="pin" placeholder="Enter PIN from the TV">
							</div>
						</div>
						<button type="submit" class="btn btn-default col-sm-offset-1">Connect &raquo;</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>