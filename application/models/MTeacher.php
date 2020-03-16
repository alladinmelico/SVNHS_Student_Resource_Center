<?php
class MUser extends CI_Model{
    public function __construct(){
		  parent::__construct();
		  if(!isset($_SESSION)){
            session_start();
		}
  }
}
?>
