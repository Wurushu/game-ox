<?php
	$pdo = new PDO('mysql:host=localhost;dbname=ox','root','');  //用PHP和資料庫連線
	$pdo->exec('set names `utf8`');
	
	$result = $pdo->query("select * from `rank` order by `id` DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TIC-TAC-TOE</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<style type="text/css">
	/* style for user image (overwrite .o) */
	.o {
		background-size: 60px !important; 
		border-radius: 50%; 
		border: 1px solid rgba(0, 0, 0, .2) !important;
	}
	</style>
	<!-- put any js-code into this file -->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/app.js"></script>
</head>
<body>
	<section class="container-game">
		<article class="title-row">
			<h1>TIC-TAC-TOE</h1>
		</article>
		<article class="row initial-page">
			<article class="col">
				<article class="subtitle-row">
					<h2>Instructions</h2>
				</article>
				<article class="container-row">
					Instructions of game:
					<ul>
						<li>Select Photo (optional)</li>
						<li>Press "Start New Game"</li>
						<li>Play Game: try to mark three fields in a vertical, horizontal or diagonal row one move before the computer</li>
					</ul>
				</article>
				<article class="subtitle-row">
					<h2>High Scores</h2>
				</article>
				<article class="container-row high scroll">
					<article class="scroll-view">
						<?php
							while($row = $result->fetch()){
						?>
								<article class="score">
									<div style="background-image: <?=str_replace("`","'",$row['photo'])?>; background-size: cover; width:25px; height:25px; display: inline-block;"></div><h4 class="name-high"><?=$row['name']?></h4>
									<p><span class="date-high"><?=$row['game_date']?></span><span class="time-high"><?=$row['game_time']?></span></p>
								</article>
						<?php
							}
						?>
					</article>
				</article>
			</article>
			<article class="col border-line col-game-spacing" id="page_1">
				<article class="subtitle-row">
					<h2>Start new game</h2>
				</article>
				<article class="container-row form">
					<form id="form_1"  class="form-content" action="step/1.php" enctype="multipart/form-data" method="post">
						<label for="photo">Upload photo <span class="optional right"> Optional </span></label>
						<input id="photo" type="file" name="photo"><br>
						<input type="hidden" name="template" id="" class="" value="1">
						<input type="button" name="" id="" onclick="start();" value="START NEW GAME">
					</form>
					<p id="wait-alert-1" hidden>We are preparing....</p>
					<article class="alert-spacing-error" hidden>
						<article class="alert"><span class="underline">Error uploading photo:</span> Verify size or type of file!!</article>
					</article>
				</article>
			</article>
			<article class="col col-game-spacing" id="page_2" style="display:none;">
				<article class="subtitle-row">
					<h2>Playing game...</h2>
					<article class="alert-spacing">
						<article class="alert game-alert win-alert">You Win!!</article>
					</article>
					<article class="alert-spacing alert-spacing-error">
						<article class="alert game-alert lose-alert">You Lose...</article>
					</article>
					<figure class="container-photo circle img_tic o"></figure>
					<figure class="container-photo circle img_tic x"></figure>
					<p class="dates">Time: <span class="time"></span></p>
					<h3 class="relative-pos-game">
						<span class="points"><span class="nameuser">Player: <span class="usermoves moves">3</span></span></span><span class="points"><span class="computer">Computer: <span class="computermoves moves">2</span></span></span>
					</h3>
				</article>
				<article class="container-row relative-pos-game">
					<article class="game">
						<article class="field"><button id="1" class="btn img_tic"></button></article>
						<article class="field"><button id="2" class="btn img_tic"></button></article>
						<article class="field"><button id="3" class="btn img_tic"></button></article>
						<article class="field"><button id="4" class="btn img_tic"></button></article>
						<article class="field"><button id="5" class="btn img_tic"></button></article>
						<article class="field"><button id="6" class="btn img_tic"></button></article>
						<article class="field"><button id="7" class="btn img_tic"></button></article>
						<article class="field"><button id="8" class="btn img_tic"></button></article>
						<article class="field"><button id="9" class="btn img_tic"></button></article>
					</article>
				</article>
				<article class="container-row center form win-form">
					<article class="form-win">
						<form>
							<label for="nickname">Enter your Nickname </label>
							<input id="nickname" type="text" name="name" placeholder="Nickname">
							<input type="button" name="" id="" class="" value="Submit" onclick="rank_send();">
						</form>
					</article>
					<br>
				</article>
				<div class="button-start">
					<a href="index.php"><button>START NEW GAME</button></a>
				</div>
			</article>
		</article>
	</section>
</body>
</html>















