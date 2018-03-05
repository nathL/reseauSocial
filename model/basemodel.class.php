<?php

abstract class basemodel
{
    public $data; // ça devrait pas etre en public, notmalment c'est en protected ! 
    public function __construct(array $row = null)
    {
        if($row === null)
        {
            //sans param
            
        }else
        {
            //avec param
            foreach ($row as $key => $value) {
              $this->$key = $value;  
            }
        }
        
    }
    public function __set($key,$value)
    {
        if(array_key_exists($key, $this->data))
        {
            $this->data[$key] = $value;
        }else
        {
            $temp = array($key=>$value);
            $this->data = array_merge($this->data,$temp);
        }
    }
    
        public function __get($key)
    {
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }else
        {
           return null; // we should raise an exception
        }
    }

 public function save()
  {
    $connection = new dbconnection() ;

    if($this->id)
    {
      $sql = "update ".get_class($this)." set " ;

      $set = array() ;
      foreach($this->data as $att => $value)
        if($att != 'id' && $value)
          $set[] = "$att = '".$value."'" ;

      $sql .= implode(",",$set) ;
      $sql .= " where id=".$this->id ;
    }
    else
    {
      $sql = "insert into ".get_class($this)." " ;
      $sql .= "(".implode(",",array_keys($this->data)).") " ;
      $sql .= "values ('".implode("','",array_values($this->data))."')" ;
    }

    $connection->doExec($sql) ;
    $id = $connection->getLastInsertId("jabaianb.".get_class($this)) ;

    return $id == false ? NULL : $id ; 
  }

}
