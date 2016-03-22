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

   //Inorder to perform the following test, need to insert exsiting tour id,

   public function deleteTourTest(){

   	    $result = $this->tourClass->deleteTour('56TY89');
   	    $this->assertEquals(ture, $result);
   }

   //in order to perform the following test, the tour id should be valid and linked to a user. 
   public function EditTourNameTest(){

   	    $result = $this->tourClass->EditTourName('TOR123');
   	    $this->assertEquals(ture, $result);
   }





}