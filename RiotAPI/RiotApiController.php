<?php

/**
* Riot API easy-access class
* Author - Nadav Sheer
*/
namespace RiotAPI;
use \RiotAPI\Summoner\Summoner as Summoner;
use \RiotAPI\Stats\Stats as Stats;

class RiotApiController{

	//Insert your API key
	private $API_KEY = 'RGAPI-59A291E8-F0E0-41A0-BF82-D2C5A972B710';
	
	//Summoner info
	public $summoner = [];

	//Information array
	public $callback = [];

	//Get summoner ID by name and server, no need to use this one
	function __construct($summoner, $server){
		Summoner::summonerByName($summoner, $server, $this->API_KEY);
		Summoner::summonersById($this->summoner['summoner_id'], $this->summoner['server'], $this->API_KEY);
		Stats::rankedStatsById($this->summoner['summoner_id'], $this->summoner['server'], $this->API_KEY);
		Stats::summaryStatsById($this->summoner['summoner_id'], $this->summoner['server']. $this->API_KEY);
	}

	private function apiFetch($url){

		$url = $url;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);
		curl_close($curl);

		$result = json_decode($result, true);

		return $result;
	}

//***** Helpers *****//

	public function view($x, $die = false){
		echo "<pre>";
		var_dump($x);
		echo "</pre>";
		if($die == true){
			die;
		}
	}
}
