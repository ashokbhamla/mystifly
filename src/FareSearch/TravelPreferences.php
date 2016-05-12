<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;


class TravelPreferences
{

    const MAX_STOP_QUANTITY_DIRECT = "Direct";
    const MAX_STOP_QUANTITY_ONESTOP = "OneStop";
    const MAX_STOP_QUANTITY_ALL = "All";

    const CABIN_PREFERENCE_ECONOMY = 'Y';
    const CABIN_PREFERENCE_FIRST = 'F';
    const CABIN_PREFERENCE_BUSINESS = 'C';

    const AIR_TRIP_TYPE_ONEWAY = "OneWay";
    const AIR_TRIP_TYPE_RETURN = "Return";
    const AIR_TRIP_TYPE_CICLE = "Circle";
    const AIR_TRIP_TYPE_OPENJAW = "OpenJaw";

    protected $availableAirType = [
        self::AIR_TRIP_TYPE_ONEWAY,
        self::AIR_TRIP_TYPE_RETURN,
        self::AIR_TRIP_TYPE_CICLE,
        self::AIR_TRIP_TYPE_OPENJAW,
    ];

    protected $availableCabin =[
        self::CABIN_PREFERENCE_BUSINESS,
        self::CABIN_PREFERENCE_ECONOMY,
        self::CABIN_PREFERENCE_FIRST,
    ];

    protected $availableSTopQuantity = [
      self::MAX_STOP_QUANTITY_ALL,
      self::MAX_STOP_QUANTITY_ONESTOP,
      self::MAX_STOP_QUANTITY_DIRECT,
    ];

    public $MaxStopsQuantity = self::MAX_STOP_QUANTITY_ONESTOP;
    public $CabinPreference = self::CABIN_PREFERENCE_ECONOMY;
    public $AirTripType = self::AIR_TRIP_TYPE_ONEWAY;

    /**
     * TravelPreferences constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if(is_array($data)){

            if (isset($data['AirTripType']) && !in_array($data['AirTripType'], $this->availableAirType ))
                throw new \InvalidArgumentException(sprintf('AirTripType required and available value %s', implode(',', $this->availableAirType)));            
            $this->AirTripType = $data['AirTripType'];

            if (!isset($data['CabinPreference']) && !in_array($data['CabinPreference'], $this->availableCabin ))
                throw new \InvalidArgumentException(sprintf('CabinPreference required and available value %s', implode(',', $this->availableCabin)));
            $this->CabinPreference = $data['CabinPreference'];

            if (!isset($data['MaxStopsQuantity']) && !in_array($data['MaxStopsQuantity'], $this->availableSTopQuantity ))
                throw new \InvalidArgumentException(sprintf('MaxStopsQuantity required and available value %s', implode(',', $this->availableSTopQuantity)));
            $this->MaxStopsQuantity = $data['MaxStopsQuantity'];
        }
    }

}