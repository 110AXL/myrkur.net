// This is your database. Fill out the credentials in the connect() method
// I use PDO because I think personally it's easier to use
class   DatabaseConfig
    {
        private static  $singleton;

        public  function __construct()
            {
                if(empty(self::$singleton))
                    self::$singleton    =   $this->connect();

                return self::$singleton;
            }
        // This is the method that creates the database connection
        public  function connect($host = "localhost", $username = "u445255185_zc4r", $password = "Dim&mur%Dalur", $database = "u445255185_sweet")
            {
                // Create connection options
                // 1) Make PDO Exception errors, 2) Do real binding 3) By default prefer fetching associative arrays
                $opts   =   array(  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                    PDO::ATTR_EMULATE_PREPARES => false,
                                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
                $conn   =   new PDO('mysql:host='.$host.';dbname='.$database, $username, $password,$opts);
                // Send back the database connection. You can use a "utf-8" character setting here as well...
                return $conn;
            }
    }
