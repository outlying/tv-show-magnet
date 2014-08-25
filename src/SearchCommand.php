<?php
namespace TvMagnet;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class SearchCommand extends Command implements ISearch {

	const ARG_SEARCH = "search";

    /**
     *
     **/
	protected function configure(){
		
		$this->setDescription("search engine - override description");

		$this->setHelp("help example");

		$this->addArgument(self::ARG_SEARCH, InputArgument::REQUIRED, "search phrase");
    }
}