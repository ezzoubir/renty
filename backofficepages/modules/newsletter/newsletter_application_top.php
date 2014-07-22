<?php
  if(isset($_POST['SEND_NEWSLETTER']))
  {

      // public
      if(isset($_POST['public']))
      {
        
         // on traite la langue
        if(isset($_POST['langue']))
        {
        
          $condition='';
          $conditionwhere='';
          $conditionand='';
          if($_POST['langue']!='all')
          {
          $lang=$_POST['langue'];
          $condition=' where language="'.$lang.'"';
          $conditionwhere=' where language="'.$lang.'"';
          $conditionand=' and language="'.$lang.'"';
          }
          else
          {
            $lang='Toutes';
          }
          $Public='TOUS - ';
          
          if(isset($_POST['pays']))
          {
              if($_POST['pays']!='all')
              {
                  if($_POST['pays']=='france')
                  {
                     $Public='FRANCE - ';
                      if($condition=='')
                      {
                          $condition.=' where pays like "%rance%" ';
                          $conditionwhere.=' where pays like "%rance%" ';
                          $conditionand.=' and pays like "%rance%" ';
                      }
                      else
                      {
                          $condition.=' and pays like "%rance%" ';
                          $conditionwhere.=' and pays like "%rance%" ';
                          $conditionand.=' and pays like "%rance%" ';
                      }
                  }
                  if($_POST['pays']=='etranger')
                  {
                     $Public='ETRANGER - ';
                      if($condition=='')
                      {
                          $condition.=' where pays!="France" and pays!="france" ';
                          $conditionwhere.=' where pays!="France" and pays!="france" ';
                          $conditionand.=' and  (pays!="France" and pays!="france") ';
                      }
                      else
                      {
                          $condition.=' and  (pays!="France" and pays!="france")  ';
                          $conditionwhere.=' and  (pays!="France" and pays!="france")  ';
                          $conditionand.=' and  (pays!="France" and pays!="france")  ';
                      }
                  }
              }
          
          }
          
          switch($_POST['public'])
          {
                case 'all':
                // membres inscrits ou non à la lettre
               /* $sql='select email from '.PREFIXE_BDD.'membres '.$condition.' order by email';
                echo $sql;
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                    
                    //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                */
                //les inscrits à la lettre
                $sql='select * from '.PREFIXE_BDD.'newsletter_emails '.$conditionwhere.' order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                 //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Tous';
                break;
                
                 case '1':
                //membres avec privilèges
                // membres inscrits ou non à la lettre
                $sql='select email from '.PREFIXE_BDD.'membres where language="'.$lang.'" order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                    
                    //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Membres';
                break;
                
                
                case '2':
                //membres avec privilèges
                // membres inscrits ou non à la lettre
                $sql='select email from '.PREFIXE_BDD.'membres where language="'.$lang.'" and privilege="1" order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                    
                    //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Membres avec privilèges';
                break;
                
                 case '3':
                //membres sans privilèges
                // membres inscrits ou non à la lettre
                $sql='select email from '.PREFIXE_BDD.'membres where language="'.$lang.'" and privilege="0" order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                    
                    //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Membres sans privilèges';
                break;
                
                case '4':
                // liste des membres inscrits à la newsletter
                $sql='select M.email from '.PREFIXE_BDD.'membres M,'.PREFIXE_BDD.'newsletter_emails N  where M.email=N.email and M.language="'.$lang.'" order by M.email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                    //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Membres inscrits à la newsletter';
                break;
                
                case '6':
                //les inscrits à la lettre
                $sql='select * from '.PREFIXE_BDD.'newsletter_emails where type_inscription="site" '.$conditionand.'  order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                 //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Inscrits à la newsletter';
                break;
                
                 case '7':
                //les inscrits à la lettre
                $sql='select * from '.PREFIXE_BDD.'newsletter_emails where type_inscription="ev1" '.$conditionand.'  order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                 //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Evènement 1';
                break;
                
                 case '8':
                //les inscrits à la lettre
                $sql='select * from '.PREFIXE_BDD.'newsletter_emails where type_inscription="ev2" '.$conditionand.'  order by email';
                $res=mysql_query($sql);
                while($ro=mysql_fetch_array($res))
                {
                 //on teste si pas deja present
                    $sql_test='select email from  '.PREFIXE_BDD.'newsletter_sending_tmp where email="'.$ro['email'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==0)
                    {
                        //insertion
                        $sql='insert into '.PREFIXE_BDD.'newsletter_sending_tmp (email) values("'.$ro['email'].'")';
                        mysql_query($sql);
                    }
                }
                $Public.='Evènement 2';
                break;
                
                
          
          }
          $objet_newsletter=addslashes($_POST['objet']);
          $message_newsletter=addslashes($_POST['content']);
          
          $sql='insert into '.PREFIXE_BDD.'newsletter_archive (objet,texte,statut,language,date_expedition,Public) values("'.$objet_newsletter.'","'.$message_newsletter.'","0","'.$lang.'","'.date('Y-m-d').'","'.$Public.'")';
         
          mysql_query($sql);
        }
      }
  
  }

?>