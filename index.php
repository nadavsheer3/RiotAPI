<?php 

include 'app.php';
use \RiotAPI\RiotApiController as RiotAPI;
use \RiotAPI\Summoner as Summoner;
use \RiotAPI\Stats as Stats;

$error = '';

if($_REQUEST){

	if($_GET['submit']){
		
		if($_GET['server'] !== '-1' && !empty($_GET['summoner_name'])){

			$summoner = rawurlencode(strtolower($_GET['summoner_name']));
			$server = $_GET['server'];
			
			$riotAPI = new RiotAPI($summoner, $server);
			//$stuff = $riotAPI->summonerByName();
			$riotAPI->view($riotAPI->callback, 1);
			//$init = $riotAPI->getSummonerId($summoner, $server);
			//$data = summoner_id_by_summoner_name($summoner,$server);
		}else{
			$error = '* Please insert a valid summoner name and select a region.';
		}
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>ggpo</title>
</head>
<body>
	<div class="input">
		<form action="" method="get">
			<input name="summoner_name" type="text" placeholder="Summpner Name">
			<select name="server">
				<option value="-1">Region</option>
				<option value="euw">EUW</option>
				<option value="kr">KR</option>
				<option value="eune">EUNE</option>
				<option value="na">NA</option>
			</select>
			<input type="submit" name="submit" value="Submit">
			<?= $error ?>
		</form>
	</div>
	<div class="output">
		<?php if(isset($init)):?>
			<h2><?= $init['summoner_name'] ?></h2>
			<p><?= $init['summoner_id'] ?></p>
			<p><?= $server ?></p>
			<div>
				

				
			</div>
		<?php endif ?>
	</div>

</body>
</html>