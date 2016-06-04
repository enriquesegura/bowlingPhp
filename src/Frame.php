<?php
/**
 * Created by PhpStorm.
 * User: enriquesegura
 * Date: 04.06.2016
 * Time: 14:45
 */

namespace KataBowling;


class Frame
{
    private $firstRollResult;
    private $secondRollResult;
    private $firstExtraRollResult;
    private $secondExtraRollResult;

    public function __construct($firstRollResult, $secondRollResult, $firstExtraRollResult, $secondExtraRollResult)
    {
        $this->firstRollResult = $firstRollResult;
        $this->secondRollResult = $secondRollResult;
        $this->firstExtraRollResult = $firstExtraRollResult;
        $this->secondExtraRollResult = $secondExtraRollResult;
    }

    private function getNumberOfPins($rollResult)
    {
        if ($rollResult == Roll::MISS) {
            return 0;
        } elseif ($rollResult == Roll::STRIKE) {
            return 10;
        }
        return intval($rollResult);
    }

    public function getScore()
    {
        if ($this->secondRollResult === Roll::SPARE) {
            return 10  + $this->getNumberOfPins($this->firstExtraRollResult);
        } elseif ($this->firstRollResult === Roll::STRIKE) {
            if ($this->secondExtraRollResult === Roll::SPARE) {
                return 20;
            }
            return 10 + $this->getNumberOfPins($this->firstExtraRollResult) + $this->getNumberOfPins($this->secondExtraRollResult);
        }
        return $this->getNumberOfPins($this->firstRollResult) + $this->getNumberOfPins($this->secondRollResult);
    }
}