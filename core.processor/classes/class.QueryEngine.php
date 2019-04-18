<?php
// This is a simple query engine. It allows for binding (or not binding)
class   QueryEngine
    {
        private $results;

        private static  $singleton;

        public  function __construct()
            {
                if(empty(self::$singleton))
                    self::$singleton    =   $this;

                return self::$singleton;
            }
        // This method sends queries to your database
        public  function query($sql = false,$bind = false)
            {
                $this->results  =   0;
                // Create database connection
                $db     =   new DatabaseConfig();
                // Attempt to connect and fetch data
                try {
                        // Bind or not bind, provided there is a bind array
                        // This is important to look up!
                        if(!empty($bind)) {
                                $query  =   $db ->connect()
                                                ->prepare($sql);
                                $query->execute($bind);
                            }
                        else {
                                $query  =   $db ->connect()
                                                ->query($sql);
                            }

                        $this->results  =   $query;
                    }
                catch (PDOException $e)
                    {
                        die($e->getMessage());
                    }

                return $this;
            }
        // This method will fetch an the associative array if used with select statement
        public  function fetch()
            {
                while($row = $this->results->fetch())
                    $result[]   =   $row;

                return (!empty($result))? $result : 0;
            }
    }
?>
