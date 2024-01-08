<?php 

    class DB{
        private $DBhost = 'localhost';
        private $DBusername = 'root';
        private $DBpassword = '';
        private $DBname = 'cashpinas';

        protected function database(){
            $con = new mysqli($this->DBhost , $this->DBusername , $this->DBpassword , $this->DBname);
            if(!$con->connect_error){
                return $con;
            }
        }
    }

?>