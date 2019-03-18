<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Choix aléatoir d'un élève - By Marine</title>

    <meta name="author" content="https://github.com/marineeee">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<br>
			<h3 class="text-info text-center">
				Choix aléatoir d'un élève.
			</h3>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item active">
						<a href="index.php">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Gen</a>
					</li>
					<li class="breadcrumb-item">
						Dernièr tirage :		
						<strong>

						</strong>	
					</li>
				</ol>
			</nav>

			<?php

			if(isset($_GET['success']) && !empty($_GET['success']) && is_string($_GET['success']))
			{
				echo 
				'<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
				<strong>Warning!</strong> ' . htmlspecialchars(strip_tags($_GET['success'])) . '
				</div>';
			}

			if(isset($_GET['error']) && !empty($_GET['error']) && is_string($_GET['error']))
			{
				echo 
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
				<strong>Warning!</strong> ' . htmlspecialchars(strip_tags($_GET['error'])) . '
				</div>';
			}

			?>

			<div class="row">
				<div class="col-md-5">
						<h5>
								Liste des élèves de la classe.
					</h5>
					<table class="table">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									Prénom
								</th>
								<th>
									Nom
								</th>
							</tr>
						</thead>
						<tbody>
						<tr>
									<td>
										' . htmlsame'])) . '
									</td>
									<td>
										<a href="">' . htmlspecial$y]['name'])) . '</a>
								</tr>
						</tbody>
					</table>
					
				</div>
				<div class="col-md-2">
						
					<form role="form" method="POST" action="rand.php">
						<div class="form-group">
							
							<label for="rand">
								Nombre d'élèves à tirer au sort
							</label>
							<input type="text" class="form-control" id="rand" name="rand" style="text-align: center; display: inline-block;" required>
						</div>
						<div class="form-group">
							
							<label for="missing">
							Élève(s) absent(s)
							</label>
							<input type="text" class="form-control" id="missing" name="missing" style="text-align: center; display: inline-block;" placeholder="Ex: Mazia, RomainR, Quentin" required>
						</div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary">
									Tirer au sort
							</button>
						</div>

					</form>
					
				</div>
			</div>

		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>