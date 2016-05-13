<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\Session;

use Mystifly\MystiflyWSDL;

class EndSession extends MystiflyWSDL
{
    public $SessionId;

    public function __construct($sessionId)
    {
        parent::__construct();
        $this->SessionId = $sessionId;
    }

    function getResult()
    {
        return $this->getSoapClient()->EndSession([self::RQ=>$this]);
    }


}