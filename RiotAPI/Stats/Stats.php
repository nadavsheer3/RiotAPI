<?php

/**
* stats-v1.3
* Summoner ranked and overall stats
**/
namespace RiotAPI\Stats;

class Stats extends RiotApiController{

	//	Get ranked stats by summoner ID
	// 	ID of the summoner for which to retrieve ranked stats ordered by champion id
	//	If specified, stats for the given season are returned. Otherwise, stats for the current season are returned
	static public function rankedStatsById($id, $server, $season = 'SEASON2016'){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.3/stats/by-summoner/'.$id.'/ranked?season='.$season.'&api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['rankedStats'] = $request;
	}

	//	Get player stats summaries by summoner ID
	//	ID of the summoner for which to retrieve player stats
	//	If specified, stats for the given season are returned. Otherwise, stats for the current season are returned
	static public function summaryStatsById($id, $server, $season = 'SEASON2016'){
		
		$url ='https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.3/stats/by-summoner/'.$id.'/summary?season='.$season.'&api_key='.$this->API_KEY;
		$request = $this->apiFetch($url);

		$this->callback['summaryStats'] = $request;
	}
}
