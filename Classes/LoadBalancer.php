<?php


use http\Client\Request;

class LoadBalancer
{
    /**
     * @var Host[] The hosts
     */
    private array $hosts;
    private int $variant;
    // Variant defined as int if variant value is 0 then the request executes the first algorithm if variant value is 1 then it executes the second algorithm
    public function __construct(int $variant,Host ...$hosts)
    {
        $this->hosts = $hosts;
        $this->variant=$variant;
    }
    public function HandleRequest(Request $request): Host
    {
        $minLoadHost =new Host(-1);

        foreach ($this->hosts as $host )
        {
            if($this->variant==0)
            {
                $host->HandleRequest($request);
            }
            elseif ($this->variant==1)
            {
                if($host->getLoad()<0.75) {
                    //Retruns the first host that has a load inferior than 0.75
                    return $host;
                }
                else {
                        if($host->getLoad()<$minLoadHost->getLoad())
                        {
                            $minLoadHost=$host;
                        }
                }
            }
            //In case an invalid variant was set in the constructor
            else
            {
                throw new Exception('Invalid Variant');
            }




        }
        //Returns the the host with the least load in case all loads are above 0.75
        // if the load is -1 then the first variant was executed
        return $minLoadHost;
    }


}