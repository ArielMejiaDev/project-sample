<?php

namespace App\Services\GeoIp;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\Model\Country;
use MaxMind\Db\Reader\InvalidDatabaseException;

class GeoIp
{
    protected Reader $reader;
    protected Country $record;

    public function __construct()
    {
        $countryDBPath = storage_path('geo-ip-2/GeoLite2-Country.mmdb');
        $this->reader = new Reader($countryDBPath);
    }

    /**
     * @throws AddressNotFoundException
     * @throws InvalidDatabaseException
     */
    public function ip(string $ip): GeoIp
    {
        $this->record = $this->reader->country($ip);
        return $this;
    }

    public function country(): \GeoIp2\Record\Country
    {
        return $this->record->country;
    }

    public function countryName(): ?string
    {
        return $this->record->country->name;
    }

    public function countryIso(): ?string
    {
        return $this->record->country->isoCode;
    }

    public function continent(): \GeoIp2\Record\Continent
    {
        return $this->record->continent;
    }

    public function continentName(): ?string
    {
        return $this->record->continent->name;
    }

    public function isInEuropeanUnion(): bool
    {
        return $this->record->country->isInEuropeanUnion;
    }
}
