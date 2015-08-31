<?php

namespace exchange\classes;

/**
 * Variant characteristics handler
 * 
 * Клас знає про характеристики товарів. Він може повернути характеристики 
 * товарів із початкового імпорту пропарсивши ім’я варіанту
 * 
 * Щоб клас знав характеристики їх потрібно добавляти при імпорті
 * 
 * Примітка для розробників:
 * Клас дуже простий і крутиться тільки навколо властивості класу $characteristics
 * Всі методи працюють тільки із даним масивом, і тільки методи що зберігають
 * за збереження/отримання при створенні знають де зберегти/отримати дані. 
 * Зараз дані зберігаються просто в json-файлі, потім можна буде перекинути 
 * сховище на будь-що.
 * 
 * There is test for this class - if you make changes here make sure test passes
 *
 * @author kolia
 */
class VariantCharacteristics {

    /**
     * Path to storage path (whatever it is - txt file or sqlite db file)
     * @var string
     */
    protected $storageFilePath;

    /**
     * Known characteristics
     * @var array [[characteristicName => [possibleValue1, possibleValue2,...]],...]
     */
    protected $characteristics = array();

    /**
     * 
     * @param string $storageFilePath
     */
    public function __construct($storageFilePath) {
        $this->storageFilePath = $storageFilePath;
        $this->loadCharacteristics();
    }

    /**
     * This method along with saveCharacteristics
     * handles storage of characteristics and knows only
     * about $characteristics property
     */
    protected function loadCharacteristics() {
        if (!file_exists($this->storageFilePath)) {
            return;
        }

        $dataJson = file_get_contents($this->storageFilePath);
        if (!isset($dataJson[0])) {
            return;
        }

        $data = json_decode($dataJson, true);
        if (is_array($data)) {
            $this->characteristics = $data;
        }
    }

    /**
     * Should be called after any changes in characteristic storage
     * 
     * This method along with loadCharacteristics
     * handles storage of characteristics and knows only
     * about $characteristics property
     */
    public function saveCharacteristics() {

        $dataJson = json_encode($this->characteristics);
        $writed = file_put_contents($this->storageFilePath, $dataJson);

        if ($writed) {
            return;
        }

        $message = sprintf('Unable to write file [%s]', $this->storageFilePath);

        if (defined('ENVIRONMENT') && ENVIRONMENT != 'production') {
            throw new \RuntimeException($message);
        } else {
            log_message('error', $message);
        }
    }

    /**
     * Returns characteristic name by it value
     * @param string $characteristicValue value of characteristic
     * @return string|null
     */
    public function getCharacteristicName($characteristicValue) {
        
        $characteristicValue = trim($characteristicValue);
        
        foreach ($this->characteristics as $name => $values) {
            if (in_array($characteristicValue, $values)) {
                return $name;
            }
        }
        
        return null;
    }

    /**
     * Parses and return all variant characteristics (if there are any)
     * @param string $variantName
     * @return array [[name => value],...] list of characteristics names and values 
     */
    public function getVariantCharacteristics($variantName) {
        /*
         * Примітка до визначення характеристик варіанту - може бути накладка 
         * із визначенням характеристик що складаються більше ніж із одного 
         * слова - може краще тоді треба буде визначати по strpos()?... 
         * Куроче час покаже.
         */
        $variantNameParts = explode(' ', $variantName);
        $variantCharacterisctics = array();
        
        foreach ($variantNameParts as $possibleCharacteristicValue) {
            foreach ($this->characteristics as $name => $values) {
                if (in_array($possibleCharacteristicValue, $values)) {
                    $variantCharacterisctics[$name] = $possibleCharacteristicValue;
                }
            }
        }
        
        return $variantCharacterisctics;
    }

    /**
     * Stores new characterictic and its value (use on import)
     * Please run saveCharacteristics() method after one or more changes
     * @param string $name
     * @param string $value
     */
    public function addCharacteristic($name, $value) {
        if (!is_string($name) || !is_string($value)) {
            // not a string
            return;
        }

        if (!isset($name[0]) || !isset($value[0])) {
            // one of arguments are empty
            return;
        }

        $value = trim($value);
        if (!isset($this->characteristics[$name])) {
            $this->characteristics[$name] = array();
        }

        if (!in_array($value, $this->characteristics[$name])) {
            $this->characteristics[$name][] = $value;
        }
    }

    /**
     * Dengerous method - deletes one or all characteristics
     * Please run saveCharacteristics() method after one or more changes
     * @param string|array $namesToDelete (optional)
     */
    public function deleteCharacteristic($namesToDelete = null) {
        if (is_null($namesToDelete)) {
            $this->characteristics = array();
            return;
        }

        if (!is_array($namesToDelete)) {
            $namesToDelete = array($namesToDelete);
        }

        foreach ($this->characteristics as $nameI => $values) {
            if (in_array($nameI, $namesToDelete)) {
                unset($this->characteristics[$nameI]);
            }
        }
    }

}
