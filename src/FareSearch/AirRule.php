<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;


use Mystifly\MystiflyWSDL;

class AirRule extends MystiflyWSDL
{

    public $SessionId;
    public $FareSourceCode;

    public function __construct($sessionId, $fareSourceCode)
    {
        parent::__construct();
        $this->SessionId = $sessionId;
        $this->FareSourceCode = $fareSourceCode;
    }

    function getResult()
    {
        return $this->getSoapClient()->FareRules1_1(['rq'=>$this]);
    }
}