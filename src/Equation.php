<?php 
namespace Yudhaang;

class Equation {

    private 
        $unit_property      = 'name',
        $qty_property       = 'qty',
        $margin_left        = ' ',
        $padding            = ' ',
        $margin_right       = '',
        $separator          = ' ',
        $delimeter          = ',';
    
    public function __construct($options = []){
        $units = isset($options['units']) ? $options['units']: NULL;
        $units = is_array($units) && count($units) > 0 
            ? $units
            : include(__DIR__ . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'DefaultUnit.php');

        unset($options['units']);
        foreach($options AS $property => $value){
            if(isset($this->{$property})){
                $this->{$property} = $value;
            } else {
                continue;
            }
        }
        return $this->units($units);
    }

    public function units($units){
        $this->data = $units;
        return $this->build_conversion_ladder();
    }

    private function build_conversion_ladder(){
        $this->conversionLadder = [];
        $qty = 1;
        foreach($this->data AS $index => $row){
            $qty = $qty * $row[$this->qty_property];
            $this->conversionLadder[$row[$this->unit_property]] = $row[$this->qty_property];
        }
        return $this->build_conversion_multiplier();
    }

    private function build_conversion_multiplier(){
        $this->conversionMultiplier = [];
        $qty = 1;
        foreach($this->data AS $index => $row){
            $qty = $qty * $row[$this->qty_property];
            $this->conversionMultiplier[$row[$this->unit_property]] = $qty;
        }
        return $this->build_conversion_factor();
    }

    private function build_conversion_factor(){
        $this->conversionFactor = [];
        foreach($this->conversionMultiplier AS $from_unit => $from_qty){
            foreach($this->conversionMultiplier AS $to_unit => $to_qty){
                $factor = 1 / $this->conversionMultiplier[$from_unit] * $to_qty; 
                $this->conversionFactor[$from_unit][$to_unit] = $factor;
            }
        }
        return $this;
    }

    public function convert($qty = 0, $from_unit, $to_unit = ''){
        $to_unit = isset($from_unit) && !empty($to_unit) ? $to_unit : $from_unit;
        $factor = $this->conversionFactor[$from_unit][$to_unit] ?? 0;
        return $qty * $factor; 
    }

    public function renderText($qty = 0, $from_unit){
        $conversion_factor  = $this->conversionFactor[$from_unit];
        $units              = array_keys($conversion_factor);
        $output             = [];

        $prev_unit          = $units[0];
        $qty                = $this->convert($qty, $from_unit, $prev_unit);
        foreach($units AS $index => $unit){
            // Set Result
            $convert            = $this->convert($qty, $prev_unit, $unit);
            $real               = $convert;
            $rounded            = intval($real);

            if($rounded > 0){
                array_push($output, $this->margin_left . $rounded . $this->padding . $unit . $this->margin_right);
            }
            // Prepare to next
            $prev_unit      = $unit;
            $qty            = $real - $rounded;
            
        }
        return trim(implode($this->delimeter, $output));
    }

    public function convertText($text, $unit = '', $options = []){

        $break          = explode($this->delimeter, $text);
        $units          = array_keys($this->conversionLadder);

        $output_unit  = empty($unit) ? end($units) : $unit;
        $qty            = 0;
        foreach($break AS $row){
            $array  = explode($this->padding, trim($row));
            $row_qty    = $array[0] ?? 0;
            $row_unit   = $array[1] ?? 1;
            $qty    += $this->convert($row_qty, $row_unit, $output_unit);
        }

        if(empty($unit)){
            $output = [];
            foreach($units AS $unit){
                $output[$unit] = $this->convert($qty, $output_unit, $unit);
            }
            return $output;
        }
        return $qty;
        
    }

}