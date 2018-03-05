<?php

class tweet extends basemodel
{
  public  function getPost()
  {
    $res = postTable::getPostById($this->post);
    
    if($res === false)
    {
        return false ;
    }      

    return $res ;
  
  }

  public static function getParrent()
  {
       

        $res = utilisateurTable::getUserById($this->parent);

        if($res === false)
        {
            return false ;
        }      

        return $res ;
  }

  public static function getLikes()
  {
      $connection = new dbconnection() ;
      $sql = "select count(DISTINCT V.utilisateur) from jabaianb.vote V where V.tweet =  ".$this->id ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
    {
        return false ;
    }      

    return $res ; // tweet->nbVotes
  }
}
