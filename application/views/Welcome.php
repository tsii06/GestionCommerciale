<!DOCTYPE html>
<html lang="en">
<head>
	<title>Human Resource</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url("assets/img/icons/favicon.ico");?>" >
	<link href="<?php echo base_url("assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/css/main.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/css/util.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/fonts/simple-line-icons.min.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("assets/fonts/ionicons.min.css");?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/pillar-1.css") ?>">
	<style>
        .service-options, .employer-options, .departement-option {
            display: none;
        }
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?php echo base_url("assets/img/bg-01.jpg"); ?>);">
					<span class="login100-form-title-1">
						LOGIN
					</span>
				</div>

				<form class="login100-form validate-form" id="mainForm" method="post">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Type d'utilisateur requis">
						<label for="userType" class="label-input100">Utilisateur</label>
						<select class="form-control" id="userType" onchange="showOptions()">
							
							<option value="DG">Directeur General</option>
							<option value="service">Service</option>
							<option value="finance">Finance</option>
							<option value="achat">Departement Achat</option>
							<option value="departement">Departement</option>

						</select>
					</div>

					<div class="wrap-input100 service-options">
						<div class="validate-input m-b-18">
							<label for="serviceType" class="label-input100">Service</label>
							<select class="form-control" name="service" id="serviceType">
								<?php for ($i=0; $i < count($listeService); $i++) { ?>
									<option value="<?=$listeService[$i]['idservice'] ?>"><?=$listeService[$i]['nomservice'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="validate-input m-b-26">
							<label for="servicePassword" class="label-input100">Password</label>
							<input class="form-control" name="servicePassword" type="password" id="servicePassword">
						</div>
					</div>

					<div class="wrap-input100 employer-options">
						<div class="validate-input m-b-18">
							<label for="matricule" class="label-input100">Matricule</label>
							<input class="form-control" name="matricule" type="text" id="matricule">
						</div>
					</div>
					
					<div class="wrap-input100 validate-input m-b-18 departement-option">
						<div class="validate-input m-b-18">
							<label for="email" class="label-input100">Email</label>
							<input class="form-control" name="email" type="email" id="email">
						</div>
						<div class="validate-input m-b-18">
							<label for="mdpDepartement" class="label-input100">Password</label>
							<input class="form-control" name="mdpDepartement" type="password" id="mdpDepartement">
						</div>
					</div>

					<div class="wrap-input100 validate-input m-b-18 DG-option">
						<div class="validate-input m-b-18">
							<label for="rhPassword" class="label-input100">Password</label>
							<input class="form-control" name="mdp" type="password" id="rhPassword">
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="Validate()">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
    function showOptions() {
        var userType = document.getElementById("userType").value;
        var serviceOptions = document.querySelector('.service-options');
        var departementOption = document.querySelector('.departement-option');
        var DGOption = document.querySelector('.DG-option');

        serviceOptions.style.display = 'none';
        departementOption.style.display = 'none';
		DGOption.style.display = 'none';

        if (userType === "service") {
            serviceOptions.style.display = 'block';
        }
		else if (userType === "departement") {
            departementOption.style.display = 'block';
        }
        else{
            DGOption.style.display = 'block';
        }
        
    }
	function Validate() {
		event.preventDefault();
		
        var userType = document.getElementById("userType").value;
		var mainForm = document.getElementById("mainForm");
		const baseUrl = "http://localhost/Gestion_Commerciale/index.php/";
		if (userType === "service") {
			mainForm.action = baseUrl+ "CrudService/loginService";
			mainForm.submit();
        } else if (userType === "achat") {
			mainForm.action = baseUrl+ "CrudService/achatLogin";
			mainForm.submit();
        } else if (userType === "finance") {
			mainForm.action = baseUrl+ "CrudService/financeLogin";
			mainForm.submit();
        } else if (userType === "DG") {
			mainForm.action = baseUrl+ "CrudService/DGLogin";
			mainForm.submit();
        }
        else if (userType === "departement") {
			mainForm.action = baseUrl+ "CrudService/departementLogin";
			mainForm.submit();
        }
	}
	</script>
</body>
</html>
