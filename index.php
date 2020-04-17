<?
if ($_SERVER['REQUEST_URI'] == "/") $page = 'home';
	else {
		$page = substr($_SERVER['REQUEST_URI'],1);
		if ( !preg_match('/^[A-z0-9]{3,15}$/', $page)) exit('error url'); 
}
//------подключение к бд -------------

$CONNECT = mysqli_connect('localhost','cj99963_cityru','27081982','cj99963_cityru');
	if ( !$CONNECT ) exit('Mysql error');
//------подключение к бд -----end;
session_start();

if ( file_exists('all/'.$page.'.php')) include'all/'.$page.'.php';

else if ($_SESSION['ulogin'] == 1 and file_exists('auth/'.$page.'.php')) include'auth/'.$page.'.php';

else if	( $_SESSION['ulogin'] != 1 and file_exists('guest/'.$page.'.php')) include'guest/'.$page.'.php';

else exit('Странница 404');

// окно ошибок 
function message( $text ) {

	exit('{"message" : "'.$text.'" }');
}

function go( $url ) {

	exit('{"go" : "'.$url.'" }');
}
// ---- end

//----------генератор пароля случайных символов---
function random_str($num = 30) {
	return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0 , $num);
}
//----------генератор пароля случайных символов---end;

// ---форма обработчика для каптчи---

function captcha_show() {

	$questions = array(

		1 => 'Столица России?',
		2 => 'Столица Украины?',
		3 => 'Столица США?',
		4 => 'Король поп музыки?',
		5 => 'Разработчики  GTA 5?',
	);

	$num = mt_rand(1, count($questions) );
	$_SESSION['captcha'] = $num;

	echo $questions[$num];
}

function captcha_valid() {

	$answers = array(

		1 => 'москва',
		2 => 'киев',
		3 => 'вашингтон',
		4 => 'майкл',
		5 => 'RockStarGames',
	);

	if ( $_SESSION['captcha'] != array_search( mb_strtolower($_POST['captcha']), $answers))
		message('Ответ на вопрос указан не верно');

}

//------проверка на sql-иньекции----
function email_valid() {
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		message('E-mail указан не верно');
	
	
}

function password_valid() {
	if ( !preg_match('/^[A-z0-9]{10,30}$/',$_POST['password']))
		message('Пароль указан не верно и может содержать 10-30 символов A-z0-9');
	$_POST['password'] = md5($_POST['password']);
	
}


//------проверка на sql-иньекции----end;

		




// ---форма обработчика для каптчи---end

function top($title){
	echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="/style.css">
	<script
  src="https://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
  <script src="/script.js"></script>
</head>
<body>
<div class="wrapper">

	<header class="header">
	<a href="/"><h1>PlavskCity.ru</h1></a>
	<div class="header-menu">
	<a href="/">Главная</a>
	<a href="register">Регистрация</a>
	<a href="login">Вход</a>
	<a href="/">Контакты</a>
	</div>
	</header><!-- .header-->';}

	function right_menu() {

		echo 
		'<div class="right-sidebar">
		<div class="menu-bar1">
		<ul>
		<li><a href="/">Больница</a></li>
		<li><a href="/">Кафе</a></li>
		<li><a href="/">Акции</a></li>
		<li><a href="/">Кинотеатр</a></li>
		<li><a href="/">Автосервис</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		<li><a href="/">Главная</a></li>
		</ul>
		</div>
			
		</div><!-- .right-sidebar -->';
	}

	

	



function bottom(){
	echo '
	<footer class="footer">
		
	</footer><!-- .footer -->
	</div><!-- .wrapper -->
	</body>
	</html>';
}






	

?>
