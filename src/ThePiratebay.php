<?php
namespace TvMagnet;

class ThePiratebay extends SearchCommand {

	const URL = "http://thepiratebay.se/search/%s/0/7/0";

	const PATTERN_MAGNET = '"(magnet:\?.+?)"';

    /**
     *
     **/
	protected function configure(){
		parent::configure();
		
		$this->setDescription("search within The Pirate Bay");

        $this->setName('piratebay');
    }

    /**
     *
     **/
    protected function execute($input, $output){

    	$query = $input->getArgument(self::ARG_SEARCH);

    	if(strlen($query) < 2){
    		return 0;
    	}

    	$resource = "/search/" . urlencode($query) . "/0/7/0";
    	$url = "http://thepiratebay.se" . $resource;

    	$output->writeln($url);

    	fopen("cookies.txt", "w");

    	$ch = curl_init();

    	$header=array(

    		'GET /search/wilfred/0/7/0 HTTP/1.1',
			'Host: thepiratebay.se',
			'Connection: keep-alive',
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
			'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',
			'Accept-Encoding: gzip,deflate,sdch',
			'Accept-Language: pl,en-US;q=0.8,en;q=0.6',
			'Cookie: PHPSESSID=ef503f110c9565caf99d8ab5132706c0; language=pl_PL; symfony=24f8381762966313f6ce730f2caff058; tpbpop=1%7CSun%2C%2024%20Aug%202014%2023%3A48%3A31%20GMT',
		);

    	// Configure download
    	curl_setopt( $ch, CURLOPT_URL, $url );
    	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 0 );
	    curl_setopt( $ch, CURLOPT_COOKIESESSION, true );

	    curl_setopt( $ch, CURLOPT_COOKIEFILE, 'cookies.txt' );
	    curl_setopt( $ch, CURLOPT_COOKIEJAR, 'cookies.txt' );
	    curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );

    	$searchResult = curl_exec($ch);

    	curl_close($ch);

    	var_dump($searchResult);

    	return 0;
    }
}