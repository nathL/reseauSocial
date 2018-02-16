<?php

define ('HOST', 'pedago02a.univ-avignon.fr') ;
define ('USER', 'uapv1800810'  ) ;
define ('PASS', 'MV7PPO' ) ;
define ('DB', 'etd' ) ;

class dbconnection
{
  private $link, $error ;

  public function __construct()
  {
    $this->link = null;
    $this->error = null;
    try{
        //$this->link = new PDO("host=".HOST." dbname=".DB." user=".USER." password=".PASS);
        $this->link = new PDO("pgsql:dbname=".DB.";host=".HOST, USER, PASS); 
        //$dbh = new PDO("pgsql:dbname=$dbname;host=$host", $username, $password ); 
        
        //$this->link = new PDO(''); 
       // ici on crée une insance de l''objet PDO pour établir une connexion avec la base de données 
       // cette nouvelle instnace sera assigné à $this->link 
    }catch(PDOException $e){
        $this->error =  $e->getMessage();
    }
}

  public function getLastInsertId($att)
  {
    return $this->link->lastInsertId($att."_id_seq");
  }

  public function doExec( $sql )
  {
    $prepared = $this->link->prepare( $sql );
    return $prepared->execute();
  }

  public function doQuery( $sql )
  {
    $prepared = $this->link->prepare( $sql );
    $prepared->execute();
    $res = $prepared->fetchAll( PDO::FETCH_ASSOC );
   
    return $res;
  }

  public function doQueryObject( $sql, $className )
  {
  }

  public function __destruct()
  {
    $this->link = null;
  }
}
