// This class deals with functions that should happen before the page outputs to the browswer
class   HeaderProcessor
    {
        private static  $userData;

        // This method just sits and waits for actions to happen
        // This method should expand with whatever you plan to do in the future
        public  static  function eventListener($array = array())
            {
                if(isset($array['action'])) {
                        if($array['action'] == 'login') {
                                if(self::getLogin($array['username'],$array['password'])) {
                                        if(self::setSession(self::$userData)) {
                                                $_SESSION['password']   =   NULL;
                                            }
                                        header("Location: home.php");
                                        exit;
                                    }
                            }
                        elseif($array['action'] == 'logout') {
                                session_destroy();
                                header("Location: loggedout.php");
                                exit;
                            }
                    }
            }
        // Process login
        private static  function getLogin($user,$pass)
            {
                $query      =   new QueryEngine();
                $getUser    =   $query  ->query("SELECT * FROM `users` WHERE `username` = :0",array($user))
                                        ->fetch();

                if($getUser == 0)
                    return false;

                self::$userData =   $getUser[0];
                // Verify the password hash (this is why you need to store your passwords differently in your db
                return password_verify($pass,$getUser[0]['password']);
            }
        // Assign session variables
        private static  function setSession($userData)
            {
                $_SESSION   =   array_filter(array_merge($userData,$_SESSION));

                return true;
            }
        // This can set options for your site, I just threw in timezone
        // as well as the class autoloader
        public  static  function initApp($settings = false)
            {
                $timezone   =   (!empty($settings['timezone']))? $settings['timezone'] : 'America/Los_Angeles';
                include_once(FUNCTIONS_DIR."/function.autoLoader.php");

                date_default_timezone_set($timezone);
            }
    }
