<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\BookFlight;


use Mystifly\MystiflyWSDL;

class TripDetails extends MystiflyWSDL
{

    public $SessionId;
    public $UniqueID;

    public function __construct($sessionId, $uniqueId)
    {
        parent::__construct();
        $this->SessionId = $sessionId;
        $this->UniqueID = $uniqueId;
    }

    public function getResult()
    {
        $this->response = $this->getSoapClient()->TripDetails([self::RQ=>$this]);
        return $this->response;
    }


}