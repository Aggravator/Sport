// Comment from clone
//Comment from origin
<?php
    class MySQLUser{
        public function __construct($login,$password){
            $this->login=$login;
            $this->password=$password;
        }
        public $password;
        public $login;
    }
    abstract class AppUser{
        public $id;
        public $type;
        public function __construct($id,$type){
            $this->id=$id;
            $this->type=$type;
        }
        public function getPersonInfo(){
            $result=Application::$connection->query("select name,surname,patronymic,about,club_id+0 as club from users where id=".$this->id.";");
            $arraya=$result->fetch_array();
            $result->close();
            return $arraya;
        }
    }
        
    class AthleteUser extends AppUser{
        public function __construct($id,$type){
            parent::__construct($id,$type);
        }
    }
    class CouchUser extends AppUser{
        public function __construct($id,$type){
            parent::__construct($id,$type);
        }
    } 
    class DirectorUser extends AppUser{
        public function __construct($id,$type){
            parent::__construct($id,$type);
        }        
    }
    class AdminUser extends AppUser{
        public function __construct($id,$type){
            parent::__construct($id,$type);
        }
    }
    class Application{
        static $user;
        static $guardian;
        static $connection;
        static $dbname="sambo";
        static $LoginPage="/Sport/signin.php";
        static $mainPage="/Sport/main.php";
        static $siteroot="C:\\\\wamp\\www\\FirstAptana";
        public function __construct(){
            self::$guardian=new MySQLUser("auth","VЦщкUш0;AЪsCЖmищБtaL2н*ЕZЕ]йOB!-7м-E+Ьгн]шmjдjВЕfY");
            self::$connection=new mysqli('localhost',self::$guardian->login,self::$guardian->password,self::$dbname);
            if(($udata=self::isAuthoried())!=false){
                switch ($udata['type']) {
                    case 1:
                        self::$user=new AthleteUser($udata['id'],1);
                        
                        break;
                    case 2:
                        self::$user=new CouchUser($udata['id'],2);
                        break;
                    case 3:
                        self::$user=new DirectorUser($udata['id'],3);
                        break;
                    case 4:
                        self::$user=new AdminUser($udata['id'],4);
                        break;
                }
            }else{
                if(isset($_GET['qtype'])&& $_GET['qtype'] == 'ajax') {
                    echo 'exit';
                    exit();
                }
                if($_SERVER['PHP_SELF']!=self::$LoginPage){
                    header("Location: ".self::$LoginPage);
                    exit();
                }else self::$user=NULL;
            }
        }
        public function __destruct(){
            self::$connection->close();
        }
        protected function isAuthoried(){
            if(isset($_COOKIE["session_id"],$_COOKIE["freonol"])){
                $trueid=$_COOKIE["freonol"]+11;
                $result=self::$connection->query("Select id,login,type+0 as type,ssesionid,useragent,remoteaddr,lasttime from userstemp where id=".$trueid.";");
                if($result->num_rows==1){
                    $row=$result->fetch_array();
                    $utype=$row['type'];
                    if(isset($row['ssesionid'],$row['useragent'],$row['remoteaddr'],$row['lasttime'])){
                        $bf=new DateTime($row['lasttime']);
                        $inter=time()-$bf->getTimestamp();
                        $inter/=60;
                        if($inter<=30){
                            if($_COOKIE["session_id"]==$row['ssesionid'] && $_SERVER['HTTP_USER_AGENT']==$row['useragent'] && $_SERVER['REMOTE_ADDR']==$row['remoteaddr']){
                                $result->close();
                                $bf->setTimestamp(time());
                                self::$connection->query("update userstemp set lasttime='".$bf->format('Y-m-d H:i:s')."' where id=".$trueid.";");
                                return array('id' => $trueid,'type'=>$utype);
                            }
                        }
                    }
                }
            }
        }
    }
    $app=new Application();
?>
