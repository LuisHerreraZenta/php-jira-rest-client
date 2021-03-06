<?php

namespace JiraRestApi\User;

/**
* Class to perform all user related queries.
*
* @author Anik
*/
class UserService extends \JiraRestApi\JiraClient
{
   private $uri = '/user/assignable';

   /**
    * Function to get user.
    *
    * @param array $paramArray Possible values for $paramArray 'username', 'key'.
    *   "Either the 'username' or the 'key' query parameters need to be provided".
    *
    * @return User class
    */
   public function get($paramArray)
   {
       $queryParam = '?'.http_build_query($paramArray);

       $ret = $this->exec($this->uri.$queryParam, null);

       $this->log->addInfo("Result=\n".$ret);

       return $this->json_mapper->map(
               json_decode($ret), new User()
       );
   }

   public function getLogin($paramArray)
   {
     $uri2 = '/user?';
       $queryParam = http_build_query($paramArray);

       $ret = $this->exec($this->uri2.$queryParam, null);

       $this->log->addInfo("Result=\n".$ret);

       return $this->json_mapper->map(
               json_decode($ret), new User()
       );
   }

   public function search($param)
   {
       //$queryParam = '?'.http_build_query($paramArray);

       $ret = $this->exec($this->uri.'/search?project='.$param, null);

       $this->log->addInfo("Result=\n".$ret);

       $userData = json_decode($ret);
       $users = [];

       foreach($userData as $user) {
           $users[] = $this->json_mapper->map(
               $user, new User()
           );
       }
       return $users;
   }
}