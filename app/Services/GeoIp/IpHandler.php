<?php

namespace App\Services\GeoIp;

use App\Services\Contracts\IpHandlerContract;
use Exception;
use Illuminate\Support\Facades\Log;

class IpHandler implements IpHandlerContract
{
    protected GeoIp $geoIp;

    public function __construct(GeoIp $geoIp)
    {
        $this->geoIp = $geoIp;
    }

    public function getIpContinent(): ?string
    {
        try {
            return $this->geoIp->ip(request()->ip())->continentName();
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            return 'North America';
        }
    }
}
