<?php
/**
 * Created by  jkhaled.
 */

namespace Mystifly;


abstract class MystiflyWSDL extends  \stdClass implements \ArrayAccess,\Iterator,\Countable
{

    const RQ = 'rq';
    
    protected $soapClient;

    protected $config;

    protected $isInitialized;

    public $Target = 'Test';

    protected $response;

    abstract function getResult();

    public function __construct()
    {
        $this->loadConfig();
    }

    public function inistializeClient(){
        if(!$this->isInitialized){
            $this->soapClient = new \SoapClient(
                $this->config['wsdl_url'],
                $this->config['wsdl_options']
            );
            $this->isInitialized = true;
        }
        return $this;
    }

    public function getRequest(){
        $this->inistializeClient();
        return  $this->soapClient->__getLastRequest();
    }

    /**
     * @return mixed
     */
    public function getSoapClient()
    {
        $this->inistializeClient();
        return $this->soapClient;
    }

    /**
     * @param mixed $soapClient
     */
    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getIsInitialized()
    {
        return $this->isInitialized;
    }

    /**
     * @param mixed $isInitialized
     */
    public function setIsInitialized($isInitialized)
    {
        $this->isInitialized = $isInitialized;
    }

    public function loadConfig(){
        $this->config = include __DIR__."/../config/config.php";
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->Target;
    }

    /**
     * @param string $Target
     */
    public function setTarget($Target)
    {
        $this->Target = $Target;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    
    

    public function count()
    {
        return $this->getInternArrayToIterateIsArray()?count($this->getInternArrayToIterate()):-1;
    }
    /**
     * Method returning the current element
     * @uses MystiflyWsdlClass::offsetGet()
     * @return mixed
     */
    public function current()
    {
        return $this->offsetGet($this->internArrayToIterateOffset);
    }
    /**
     * Method moving the current position to the next element
     * @uses MystiflyWsdlClass::getInternArrayToIterateOffset()
     * @uses MystiflyWsdlClass::setInternArrayToIterateOffset()
     * @return int
     */
    public function next()
    {
        return $this->setInternArrayToIterateOffset($this->getInternArrayToIterateOffset() + 1);
    }
    /**
     * Method resetting itemOffset
     * @uses MystiflyWsdlClass::setInternArrayToIterateOffset()
     * @return int
     */
    public function rewind()
    {
        return $this->setInternArrayToIterateOffset(0);
    }
    /**
     * Method checking if current itemOffset points to an existing item
     * @uses MystiflyWsdlClass::getInternArrayToIterateOffset()
     * @uses MystiflyWsdlClass::offsetExists()
     * @return bool true|false
     */
    public function valid()
    {
        return $this->offsetExists($this->getInternArrayToIterateOffset());
    }
    /**
     * Method returning current itemOffset value, alias to getInternArrayToIterateOffset
     * @uses MystiflyWsdlClass::getInternArrayToIterateOffset()
     * @return int
     */
    public function key()
    {
        return $this->getInternArrayToIterateOffset();
    }
    /**
     * Method alias to offsetGet
     * @see MystiflyWsdlClass::offsetGet()
     * @uses MystiflyWsdlClass::offsetGet()
     * @param int $_index
     * @return mixed
     */
    public function item($_index)
    {
        return $this->offsetGet($_index);
    }
    /**
     * Default method adding item to array
     * @uses MystiflyWsdlClass::getAttributeName()
     * @uses MystiflyWsdlClass::__toString()
     * @uses MystiflyWsdlClass::_set()
     * @uses MystiflyWsdlClass::_get()
     * @uses MystiflyWsdlClass::setInternArrayToIterate()
     * @uses MystiflyWsdlClass::setInternArrayToIterateIsArray()
     * @uses MystiflyWsdlClass::setInternArrayToIterateOffset()
     * @param mixed $_item value
     * @return bool true|false
     */
    public function add($_item)
    {
        if($this->getAttributeName() != '' && stripos($this->__toString(),'array') !== false)
        {
            /**
             * init array
             */
            if(!is_array($this->_get($this->getAttributeName())))
                $this->_set($this->getAttributeName(),array());
            /**
             * current array
             */
            $currentArray = $this->_get($this->getAttributeName());
            array_push($currentArray,$_item);
            $this->_set($this->getAttributeName(),$currentArray);
            $this->setInternArrayToIterate($currentArray);
            $this->setInternArrayToIterateIsArray(true);
            $this->setInternArrayToIterateOffset(0);
            return true;
        }
        return false;
    }
    /**
     * Method to call when sending data to request for *array* type class
     * @uses MystiflyWsdlClass::getAttributeName()
     * @uses MystiflyWsdlClass::__toString()
     * @uses MystiflyWsdlClass::_get()
     * @return mixed
     */
    public function toSend()
    {
        if($this->getAttributeName() != '' && stripos($this->__toString(),'array') !== false)
            return $this->_get($this->getAttributeName());
        else
            return null;
    }
    /**
     * Method returning the first item
     * @uses MystiflyWsdlClass::item()
     * @return mixed
     */
    public function first()
    {
        return $this->item(0);
    }
    /**
     * Method returning the last item
     * @uses MystiflyWsdlClass::item()
     * @uses MystiflyWsdlClass::length()
     * @return mixed
     */
    public function last()
    {
        return $this->item($this->length() - 1);
    }
    /**
     * Method testing index in item
     * @uses MystiflyWsdlClass::getInternArrayToIterateIsArray()
     * @uses MystiflyWsdlClass::getInternArrayToIterate()
     * @param int $_offset
     * @return bool true|false
     */
    public function offsetExists($_offset)
    {
        return ($this->getInternArrayToIterateIsArray() && array_key_exists($_offset,$this->getInternArrayToIterate()));
    }
    /**
     * Method returning the item at "index" value
     * @uses MystiflyWsdlClass::offsetExists()
     * @param int $_offset
     * @return mixed
     */
    public function offsetGet($_offset)
    {
        return $this->offsetExists($_offset)?$this->internArrayToIterate[$_offset]:null;
    }
    /**
     * Method useless but necessarly overridden, can't set
     * @param mixed $_offset
     * @param mixed $_value
     * @return null
     */
    public function offsetSet($_offset,$_value)
    {
        return null;
    }
    /**
     * Method useless but necessarly overridden, can't unset
     * @param mixed $_offset
     * @return null
     */
    public function offsetUnset($_offset)
    {
        return null;
    }

    /**
     * Method setting current result from Soap call
     * @param mixed $_result
     * @return mixed
     */
    protected function setResult($_result)
    {
        return ($this->result = $_result);
    }
    /**
     * Method returning last errors occured during the calls
     * @return array
     */
    public function getLastError()
    {
        return $this->lastError;
    }
    /**
     * Method setting last errors occured during the calls
     * @param array $_lastError
     * @return array
     */
    private function setLastError($_lastError)
    {
        return ($this->lastError = $_lastError);
    }
    /**
     * Method saving the last error returned by the SoapClient
     * @param string $_methoName the method called when the error occurred
     * @param SoapFault $_soapFault l'objet de l'erreur
     * @return bool true|false
     */
    protected function saveLastError($_methoName,SoapFault $_soapFault)
    {
        return ($this->lastError[$_methoName] = $_soapFault);
    }
    /**
     * Method getting the last error for a certain method
     * @param string $_methoName method name to get error from
     * @return SoapFault|null
     */
    public function getLastErrorForMethod($_methoName)
    {
        return (is_array($this->lastError) && array_key_exists($_methoName,$this->lastError))?$this->lastError[$_methoName]:null;
    }
    /**
     * Method returning intern array to iterate trough
     * @return array
     */
    public function getInternArrayToIterate()
    {
        return $this->internArrayToIterate;
    }
    /**
     * Method setting intern array to iterate trough
     * @param array $_internArrayToIterate
     * @return array
     */
    public function setInternArrayToIterate($_internArrayToIterate)
    {
        return ($this->internArrayToIterate = $_internArrayToIterate);
    }
    /**
     * Method returnint intern array index when iterating trough
     * @return int
     */
    public function getInternArrayToIterateOffset()
    {
        return $this->internArrayToIterateOffset;
    }
    /**
     * Method initiating internArrayToIterate
     * @uses MystiflyWsdlClass::setInternArrayToIterate()
     * @uses MystiflyWsdlClass::setInternArrayToIterateOffset()
     * @uses MystiflyWsdlClass::setInternArrayToIterateIsArray()
     * @uses MystiflyWsdlClass::getAttributeName()
     * @uses MystiflyWsdlClass::initInternArrayToIterate()
     * @uses MystiflyWsdlClass::__toString()
     * @param array $_array the array to iterate trough
     * @param bool $_internCall indicates that methods is calling itself
     * @return void
     */
    public function initInternArrayToIterate($_array = array(),$_internCall = false)
    {
        if(stripos($this->__toString(),'array') !== false)
        {
            if(is_array($_array) && count($_array))
            {
                $this->setInternArrayToIterate($_array);
                $this->setInternArrayToIterateOffset(0);
                $this->setInternArrayToIterateIsArray(true);
            }
            elseif(!$_internCall && $this->getAttributeName() != '' && property_exists($this->__toString(),$this->getAttributeName()))
                $this->initInternArrayToIterate($this->_get($this->getAttributeName()),true);
        }
    }
    /**
     * Method setting intern array offset when iterating trough
     * @param int $_internArrayToIterateOffset
     * @return int
     */
    public function setInternArrayToIterateOffset($_internArrayToIterateOffset)
    {
        return ($this->internArrayToIterateOffset = $_internArrayToIterateOffset);
    }
    /**
     * Method returning true if intern array is an actual array
     * @return bool true|false
     */
    public function getInternArrayToIterateIsArray()
    {
        return $this->internArrayToIterateIsArray;
    }
    /**
     * Method setting if intern array is an actual array
     * @param bool $_internArrayToIterateIsArray
     * @return bool true|false
     */
    public function setInternArrayToIterateIsArray($_internArrayToIterateIsArray = false)
    {
        return ($this->internArrayToIterateIsArray = $_internArrayToIterateIsArray);
    }
    /**
     * Generic method setting value
     * @param string $_name property name to set
     * @param mixed $_value property value to use
     * @return bool
     */
    public function _set($_name,$_value)
    {
        $setMethod = 'set' . ucfirst($_name);
        if(method_exists($this,$setMethod))
        {
            $this->$setMethod($_value);
            return true;
        }
        else
            return false;
    }
    /**
     * Generic method getting value
     * @param string $_name property name to get
     * @return mixed
     */
    public function _get($_name)
    {
        $getMethod = 'get' . ucfirst($_name);
        if(method_exists($this,$getMethod))
            return $this->$getMethod();
        else
            return false;
    }
    /**
     * Method returning alone attribute name when class is *array* type
     * @return string
     */
    public function getAttributeName()
    {
        return '';
    }
    /**
     * Generic method telling if current value is valid according to the attribute setted with the current value
     * @param mixed $_value the value to test
     * @return bool true|false
     */
    public static function valueIsValid($_value)
    {
        return true;
    }
    /**
     * Method returning actual class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return __CLASS__;
    }

}