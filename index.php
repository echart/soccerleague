<?
session_start();
require_once('helpers/__autoload.php');
$con=Connection::getInstance();

$user= new Authentication();
if($user->verifyAuthentication()===true){
	header('location: /home/');
}
$refeer= $_GET['refeer']?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Title, tags and meta-->
	<title>Soccer League - The Soccer Management Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon2.png">

	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
 	<meta name="theme-color" content="‪#‎393E41">

</head>
<body>
	<main>
		<div class='signup'>
			<div class='grid-35'>
				<h1>Crie uma equipe!</h1>
				<form>
					<div class='form-field'>
						<label for='login-input'>Nome do clube:</label>
						<input id='login-input' type='text' name='userpass' placeholder='Digite seu email'>
					</div>
					<div class='form-field'>
						<label for='login-input'>Email:</label>
						<input id='login-input' type='text' name='userpass' placeholder='Digite seu email'>
					</div>
					<div class='form-field'>
						<label for='login-input'>Senha:</label>
						<input id='login-input' name='userpass' type='password' placeholder='Digite sua senha'>
					</div>
					<div class='form-field'>
						<label for='login-input'>Repetir senha:</label>
						<input id='login-input' name='userpass' type='password' placeholder='Digite sua senha'>
					</div>
					<div class='form-field'>
						<label for='login-input'>Selecione um país:</label>
						<select class="" name="">
							<option>Selecione um país</option>
							<option value='1'>Brasil (Campeonato Brasileiro)</option>
						</select>
					</div>
					<div class='form-field'>
						<button type='button' >Cadastrar</button>
					</div>
				</form>
			</div>
			<div class='grid-65'>
				<div id='map'></div>
			</div>

		</div>
		<div class='login'>
			<div class='form'>
				<h1>Entrar</h1>
				<form>
					<div class='form-field'>
						<label for='login-input'>Email:</label>
						<input id='login-input' type='text' name='userpass' placeholder='Digite seu email'>
					</div>
					<div class='form-field'>
						<label for='login-input'>Senha:</label>
						<input id='login-input' name='userpass' type='password' placeholder='Digite sua senha'>
					</div>
					<div class='form-field'>
						<button type='button' >Login</button>
					</div>
					<div class='form-field right'>
						<a href=''>Esqueceu a senha?</a>
					</div>
				</form>
			</div>
		</div>
		<header>
			<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
			<nav>
				<ul>
					<li><a href=''>O que é?</a></li>
					<li><a href=''>Regras</a></li>
					<li><a href='#'  onclick='callSignup()' class='signup'>Cadastrar</a></li>
				</ul>
			</nav>
			<button onclick='callLogin()' class='btn-login'>Entrar</button>
		</header>
		<div class='video'>
			<video preload='none' loop="loop" muted>
				<source src="assets/video/splash_home2.mp4" type="video/mp4">
			</video>
			<div class="pattern"></div>
			<div class='cadastro'>
				<h3>Nós amamos futebol! <i class="football"></i><i class="heart"></i></h3>
				<h4>e nós vamos fazer o melhor jogo de gerenciamento de futebol, com você! Crie um clube e ajude no desenvolvimento.</h4>
			</div>
			<!-- <div class='down'><a href='#description'><img src="assets/img/login/down.png"></a></div> -->
		</div>
	</main>

	<!-- CSS -->
	<link href="assets/css/login.css" rel='stylesheet'>
	<link href="assets/css/grid.css" rel='stylesheet'>
	<!-- JS -->
	<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4&signed_in=true"></script>
	<script src='assets/js/home.js'></script>
</body>
</html>
