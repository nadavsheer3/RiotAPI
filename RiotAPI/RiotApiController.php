<?php

/**
* Riot API easy-access class
* Author - Nadav Sheer
*/
namespace RiotAPI
use RiotAPI\Summoner as Summoner;
use RiotAPI\Stats as Stats;

class RiotApiController {

	//Insert your API key
	private $API_KEY = 'RGAPI-59A291E8-F0E0-41A0-BF82-D2C5A972B710';
	
	//Summoner info
	public $summoner = [];

	//Information array
	public $callback = [];

	//Get summoner ID by name and server, no need to use this one
	function __construct($summoner, $server){
		Summoner::summonerByName($summoner, $server);
		Summoner::summonersById($this->summoner['summoner_id'], $this->summoner['server']);
		Stats::rankedStatsById($this->summoner['summoner_id'], $this->summoner['server']);
		Stats::summaryStatsById($this->summoner['summoner_id'], $this->summoner['server']);
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

	/**
	* summoner-v1.4
	* Basic summoner information
	**/

	// Get summoner objects mapped by standardized summoner name for a given list of summoner names
	// Comma-separated list of summoner names or standardized summoner names associated with summoners to retrieve. Maximum allowed at once is 40
	public function summonerByName($summoner, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/'.$summoner.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$summoner_name = str_replace(' ', '', rawurldecode($summoner));

		$this->summoner['summoner_id'] = $request[$summoner_name]['id'];
		$this->summoner['summoner_name'] = $request[$summoner_name]['name'];
		$this->summoner['profileIconId'] = $request[$summoner_name]['profileIconId'];
		$this->summoner['server'] = $server;
	}

	// Get summoner objects mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40
	public function summonersById($summoners, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/'.$summoners.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonersById'] = $request;
	}

	// Get mastery pages mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40
	public function masteriesById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/masteries/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerMasteries'] = $request;
	}

	// Get summoner names mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoner names to retrieve. Maximum allowed at once is 40
	public function summonerNameById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/name/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerName'] = $request;
	}
	
	// Get rune pages mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40
	public function runesById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/runes/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerRunes'] = $request;
	}

	/**
	* stats-v1.3
	* Summoner ranked and overall stats
	**/

	//	Get ranked stats by summoner ID
	// 	ID of the summoner for which to retrieve ranked stats ordered by champion id
	//	If specified, stats for the given season are returned. Otherwise, stats for the current season are returned
	public function rankedStatsById($id, $server, $season = 'SEASON2016'){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.3/stats/by-summoner/'.$id.'/ranked?season='.$season.'&api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['rankedStats'] = $request;
	}

	//	Get player stats summaries by summoner ID
	//	ID of the summoner for which to retrieve player stats
	//	If specified, stats for the given season are returned. Otherwise, stats for the current season are returned
	public function summaryStatsById($id, $server, $season = 'SEASON2016'){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.3/stats/by-summoner/'.$id.'/summary?season='.$season.'&api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summaryStats'] = $request;
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
