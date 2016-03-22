<?php


/**
* 
*/
class MediaManagerTest extends PHPUnit_Framework_TestCase
{

	public function setUp(){

		$this->managerClass = new MediaManager();

	}


	public function addMeidaToLocationTest(){

		$arrayTest = array('1','2','3','4');
		$le = count($arrayTest);
		$results = $this->managerClass->addMeidaToLocation($le,$arrayTest,'4',$dbconn,'jimmy');
		$this->assertEquals(true,$results);

	}

	public function getMediaOfLocationTest(){

		$results = $this->managerClass->getMediaOfLocation('1','jimmy');
		$this->assertNotEmpty($results);

	}

	public function meidaDescriptionTest(){

		$results = $this->managerClass->meidaDescription('1','This is an image',$dbconn);
		$this->assertEquals(true,$results);
	}

	public function deleteMediaOfLocation(){

		$results = $this->managerClass->deleteMediaOfLocation('2','4',$dbconn,'jimmy');
		$this->assertEquals(true,$results);
	}



}





?>