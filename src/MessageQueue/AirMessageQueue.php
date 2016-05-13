<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\MessageQueue;


use Mystifly\MystiflyWSDL;

class AirMessageQueue extends MystiflyWSDL
{

    const CATEGORY_CANCELLED = 'Cancelled';
    const CATEGORY_CHANGED = 'ScheduleChange';
    const CATEGORY_TICKETED = 'Ticketed';
    const CATEGORY_URGENT = 'Urgent';

    public $SessionId;
    public $CategoryId;

    public function __construct($sessionId)
    {
        parent::__construct();
        $this->SessionId = $sessionId;
    }

    public function getCanceled()
    {
        $this->CategoryId = self::CATEGORY_CANCELLED;
        return $this->getResult();
    }

    public function getChanged()
    {
        $this->CategoryId = self::CATEGORY_CHANGED;
        return $this->getResult();
    }

    public function getTicketed()
    {
        $this->CategoryId = self::CATEGORY_TICKETED;
        return $this->getResult();
    }

    public function getUrgent()
    {
        $this->CategoryId = self::CATEGORY_URGENT;
        return $this->getResult();
    }

    public function getResult()
    {
        if($this->CategoryId == null){
            throw new \Exception('no category is specified, use getCancelled(), getUrgent() , etc..');
        }
        $this->response = $this->getSoapClient()->MessageQueues([self::RQ => $this]);
    }


}