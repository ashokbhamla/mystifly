<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;


use Mystifly\MystiflyWSDL;

class AirLowFareSearch extends MystiflyWSDL
{

    const REQUEST_OPTION_FIFTY = "Fifty";

    public $SessionId;

    public $OriginDestinationInformations = [];

    public $TravelPreferences = [];

    public $PricingSourceType = 'All';

    public $IsRefundable;

    public $PassengerTypeQuantities = [];

    public $RequestOptions = self::REQUEST_OPTION_FIFTY;

    public $NearByAirports = false;

    function getResult()
    {
        $this->response = $this->getSoapClient()->AirLowFareSearch(['rq'=>$this]);
        return  $this->response;
    }


    public function getListFlight()
    {
        if(!$this->response)
            return null;

        if($this->response->AirLowFareSearchResult->Success != true)
            throw new \Exception('Request Failed please try again');

       // if($this->response->AirLowFareSearchResult->Errors)
        $listFlight  = $this->response->AirLowFareSearchResult->PricedItineraries->PricedItinerary;
        return $listFlight;
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

    /**
     * @param array $passengers
     */
    public function setPassengers(array $passengers)
    {
        foreach ($passengers as $passenger){
            $this->PassengerTypeQuantities[] = new PassengerTypeQuantity($passenger['type'], $passenger['quantity']);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getPassengerTypeQuantities()
    {
        return $this->PassengerTypeQuantities;
    }


    /**
     * @param $originDestination
     * @return $this
     */
    public function setOriginDestinationInformations($originDestination)
    {
        foreach ($originDestination as $item){
            $this->OriginDestinationInformations[] = new OriginDestinationInformation(
                $item['OriginLocationCode'],
                $item['DestinationLocationCode'],
                $item['DepartureDateTime']
            );
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getOriginDestinationInformations()
    {
        return $this->OriginDestinationInformations;
    }

    /**
     * @param array $TravelPreferences
     */
    public function setTravelPreferences($travelPreferences)
    {
        $this->TravelPreferences = new TravelPreferences($travelPreferences);
    }

    /**
     * @return array
     */
    public function getTravelPreferences()
    {
        return $this->TravelPreferences;
    }

  

    /**
     * @return string
     */
    public function getPricingSourceType()
    {
        return $this->PricingSourceType;
    }

    /**
     * @param string $PricingSourceType
     */
    public function setPricingSourceType($PricingSourceType)
    {
        $this->PricingSourceType = $PricingSourceType;
    }

    /**
     * @return mixed
     */
    public function getIsRefundable()
    {
        return $this->IsRefundable;
    }

    /**
     * @param mixed $IsRefundable
     */
    public function setIsRefundable($IsRefundable)
    {
        $this->IsRefundable = $IsRefundable;
    }

    /**
     * @return string
     */
    public function getRequestOptions()
    {
        return $this->RequestOptions;
    }

    /**
     * @param string $RequestOptions
     */
    public function setRequestOptions($RequestOptions)
    {
        $this->RequestOptions = $RequestOptions;
    }

    /**
     * @return boolean
     */
    public function isNearByAirports()
    {
        return $this->NearByAirports;
    }

    /**
     * @param boolean $NearByAirports
     */
    public function setNearByAirports($NearByAirports)
    {
        $this->NearByAirports = $NearByAirports;
    }



}