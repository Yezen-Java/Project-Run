<?php

require 'Classes/TourClass.php';
include 'Connect.php';


class TourClassTest extends PHPUnit_Framework_TestCase{


	public function setUp()
    
    {
        $this->tourClass = new TourClass();
    
    }

   public function testTourInsertion(){

   	    $result = $this->tourClass->insertTour('TourTest', 'tourunittest','00-00-0000','jimmy');
        $this->assertEquals(ture, $result);

   }





}




?>