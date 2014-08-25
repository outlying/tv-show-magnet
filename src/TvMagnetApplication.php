<?php
namespace TvMagnet;

use Exception;
use Herrera\Cli\Application;

class TvMagnetApplication extends Application {
	
	private $config = array(

        'app.name' => 'TvMagnet',
        'app.version' => '0.0.1',
    );

    private $searchArray = array();

	/**
     * @override
     */
    public function __construct(){
        parent::__construct($this->config);

        $this->addSearch(new ThePiratebay());
    }

    /**
     * Adds another search engine as command
     **/
    public final function addSearch(SearchCommand $searchCommand){

    	if(!($searchCommand instanceof SearchCommand)){
    		throw new Exception("Invalid argument", 1);
    	}

    	$this['console']->add($searchCommand);    	
    }
}