<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;

use Mystifly\MystiflyWSDL;

class AirRevalidate extends MystiflyWSDL
{

    public $FareSourceCode;
    public $SessionId;

    public function __construct($sessionId, $fareSourceCode)
    {
        parent::__construct();
        $this->SessionId = $sessionId;
        $this->FareSourceCode = $fareSourceCode;
    }

    function getResult()
    {
        $this->response = $this->getSoapClient()->AirRevalidate(['rq'=>$this]);
        return $this->response;
    }

    public function isValid()
    {
        if($this->response)
            return $this->response->AirRevalidateResult->IsValid;
        else
            throw new \Exception('response is null');
    }

    /**
     * @return mixed
     */
    public function getFareSourceCode()
    {
        return $this->FareSourceCode;
    }

    /**
     * @param mixed $FareSourceCode
     */
    public function setFareSourceCode($FareSourceCode)
    {
        $this->FareSourceCode = $FareSourceCode;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->SessionId;
    }

    /**
     * @param mixed $SessionId
     */
    public function setSessionId($SessionId)
    {
        $this->SessionId = $SessionId;
    }


}