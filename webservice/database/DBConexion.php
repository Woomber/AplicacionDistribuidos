<?php 

    Class DBConexion {

        private $host = "localhost";
        //private $host = "IP Address DB Server #1";
        private $base = "coco";
        private $user = "root";
        private $pwd = "";
        private $charset = "utf8";

        private $host2 = "localhost";
        //private $host2 = "IP Address DB Server #2";
        private $base2 = "coco";
        private $user2 = "root";
        private $pwd2 = "";
        private $charset2 = "utf8";

        protected $pdo;
        public $status;

        protected function start(){
            try {
                $this->pdo = new PDO(
                    'mysql:host='.$this->host.';dbname='.$this->base.';charset='.$this->charset,
                    $this->user,
                    $this->pwd
                );
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->status = 202;
                return true;
            } catch (PDOException $ex) {
                try {
                     $this->pdo = new PDO(
                        'mysql:host='.$this->host2.';dbname='.$this->base2.';charset='.$this->charset2,
                        $this->user2,
                        $this->pwd2
                    );
                    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                    $this->status = 203;
                    return true;
                } catch (PDOException $pdoex) {
                    $this->pdo = null;
                    $this->status = 503;
                    return false;
                }
            }
        }

        protected function stop(){
            $this->pdo = null;
        }
        
        public function getConnection () {
            return $this->pdo;
        }

    }

?>
