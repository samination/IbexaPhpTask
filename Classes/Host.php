<?php

use http\Client\Request;

class Host
{
    private float $Load;

    /**
     * @param float $Load
     */
    public function __construct(float $Load)
    {
        $this->Load = $Load;
    }

    /**
     * @return float
     */
    public function getLoad(): float
    {
        return $this->Load;
    }


    public function HandleRequest(Request $request):void
{
        //Handle Request Code
}


}