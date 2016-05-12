<?php
/**
 * Created by  jkhaled.
 */

namespace Mystifly\Session;


use Mystifly\MystiflyWSDL;

class CreateSession extends MystiflyWSDL 
{
    
    public $AccountNumber = "MCN001047";
    public $UserName = "HIDHXML";
    public $Password = "HIDH2016_xml";

    /**
     * @return mixed
     */
    function getResult()
    {
        return $this->getSoapClient()->CreateSession(['rq'=> $this]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getSessionId(){
        $result = $this->getResult();
        if($result->CreateSessionResult->SessionStatus !==  true){
            throw new \Exception('cannot get session id, connexion pb');
        }
        return $result->CreateSessionResult->SessionId;
    }

}