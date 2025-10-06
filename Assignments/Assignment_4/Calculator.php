<?php

class Calculator{
    private $operator;
    private $firstValue;
    private $secondValue;
    private $result;

    public function calc ($opperator = "N/A", $firstValue = null, $secondValue = null){
        $this->operator = $opperator;
        $this->firstValue = $firstValue;
        $this->secondValue = $secondValue;
        if(!($this->operator == "N/A") || !($this->firstValue == null) || !($this->secondValue == null) ){
            if(is_string($this->operator) && is_numeric($this->firstValue) && is_numeric($this->secondValue)){
                if($this->operator == "/"){
                    if($this->secondValue == 0){
                        return "The calculation is $this->firstValue $this->operator $this->secondValue. The answer is cannot divide a number by zero.<br>";
                    }
                    else{
                        $this->result = $this->firstValue / $this->secondValue;
                        return "The calculation is $this->firstValue $this->operator $this->secondValue. The answer is $this->result.<br>";
                    }
                }
                elseif($this->operator== "*"){
                    $this->result = $this->firstValue * $this->secondValue;
                    return "The calculation is $this->firstValue $this->operator $this->secondValue. The answer is $this->result.<br>";
                }
                elseif($this->operator== "-"){
                    $this->result = $this->firstValue - $this->secondValue;
                    return "The calculation is $this->firstValue $this->operator $this->secondValue. The answer is $this->result.<br>";
                }
                elseif($this->operator == "+"){
                    $this->result = $this->firstValue + $this->secondValue;
                    return "The calculation is $this->firstValue $this->operator $this->secondValue. The answer is $this->result.<br>";
                }
            }
            else{
              return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.<br>";  
            }
        }
        else{
            return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.<br>";
        }
    }
    

}



?>