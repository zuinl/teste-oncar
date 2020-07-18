<?php
    include 'Database.php';
    class QueryHelper extends Database {
        private $connection;

        public function execSQL($sql)
        {
            $this->connection = $this->connect();
            return mysqli_query($this->connection, $sql);
        }
    }

?>