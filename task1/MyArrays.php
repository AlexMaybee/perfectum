<?php

class MyArrays
{
    private $arr1 = [];
    private $arr2 = [];

    private $times = 20;

    public function __construct()
    {
        $this->arr1 = $this->createArrValues();
        $this->arr2 = $this->createArrValues('1');

        echo 'Arr 1: <br>';
        $this->debug($this->arr1);

        echo 'Arr 2: <br>';
        $this->debug($this->arr2);

        echo 'Result Arr: <br>';
        $this->debug($this->mergeArrays());
    }

    private function createArrValues($flag = false)
    {
        $result = [];
        while(count($result) < $this->times)
        {
            $rand = ($flag) ? chr(rand(36,126)) : mt_rand();
            if(!in_array($rand,$result))
            {
                array_push($result,$rand);
            }
        }
        return $result;
    }

    private function mergeArrays()
    {
        $result = [];
        $i = 0;
        while($i < (count($this->arr1)))
        {

            array_push($result,$this->arr1[$i],$this->arr2[$i]);
            $i++;
        }
        return $result;
    }

    public function debug($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}