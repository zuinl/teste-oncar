<?php

    class Database {
        private $host = 'localhost';
        private $db = 'teste_oncar';
        private $username = 'root';
        private $password = '';

        public function connect()
        {
            $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
            if(!$connection) {
                die('Houve um erro ao conectar à base de dados');
            }

            return $connection;
        }
    }

?>