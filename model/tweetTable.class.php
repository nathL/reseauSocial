<?php

class postTable
{ 
    public $classPath;
    
    public function __construct()
    {
        $this->classPath = "/ourApp/model/tweet";
    }
     public static function getTweets()
    {
         $connection = new dbconnection() ;
        $sql = "select * from jabaianb.tweet" ;

        $res = $connection->doQueryObject( $sql, $this->classPath ); // a tester

        if($res === false)
        {
            return false ;
        }      

        return $res ;
        
    }
    public static function getPostedBy($id)
    {
        $connection = new dbconnection() ;
        $sql = "select * from jabaianb.tweet where parent=".$id ;

         $res = $connection->doQueryObject( $sql, $this->classPath ); // a tester

        if($res === false)
        {
            return false ;
        }      

        return $res ;
        
    }

}
