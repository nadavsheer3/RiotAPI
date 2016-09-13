<?php

/**
* summoner-v1.4
* Basic summoner information
**/
namespace RiotAPI\Summoner;

class Summoner extends RiotApiController{
	
	// Get summoner objects mapped by standardized summoner name for a given list of summoner names
	// Comma-separated list of summoner names or standardized summoner names associated with summoners to retrieve. Maximum allowed at once is 40
	static public function summonerByName($summoner, $server){
		
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
	static public function summonersById($summoners, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/'.$summoners.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonersById'] = $request;
	}

	// Get mastery pages mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40
	static public function masteriesById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/masteries/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerMasteries'] = $request;
	}

	// Get summoner names mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoner names to retrieve. Maximum allowed at once is 40
	static public function summonerNameById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/name/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerName'] = $request;
	}
	
	// Get rune pages mapped by summoner ID for a given list of summoner IDs
	// Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40
	static public function runesById($id, $server){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/runes/'.$id.'?api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summonerRunes'] = $request;
	}
}