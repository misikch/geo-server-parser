<?php

namespace App\Values;

class GeoNameDataValue
{
    private $geonameid; //integer id of record in geonames database
    private $name; //name of geographical point (utf8) varchar(200)
    private $asciiname; //name of geographical point in plain ascii characters, varchar(200)
    private $alternatenames; //alternatenames, comma separated, ascii names automatically transliterated,
                            // convenience attribute from alternatename table, varchar(10000)
    private $latitude;
    private $longitude;

    private $featureClass; //see http://www.geonames.org/export/codes.html, char(1)
    private $featureCode; //see http://www.geonames.org/export/codes.html, varchar(10)
    private $countryCode; //ISO-3166 2-letter country code, 2 characters
    private $cc2; //alternate country codes, comma separated, ISO-3166 2-letter country code, 200 characters

    private $admin1Code; //fipscode (subject to change to iso code), see exceptions below, see file admin1Codes.txt for display names of this code; varchar(20)
    private $admin2Code; //code for the second administrative division, a county in the US, see file admin2Codes.txt; varchar(80)
    private $admin3Code; //code for third level administrative division, varchar(20)
    private $admin4Code; //code for fourth level administrative division, varchar(20)

    private $population; //bigint (8 byte int)
    private $elevation; //in meters, integer

    private $dem; //digital elevation model, srtm3 or gtopo30, average elevation of 3''x3''
                    // (ca 90mx90m) or 30''x30'' (ca 900mx900m) area in meters, integer. srtm processed by cgiar/ciat.
    private $timezone; //the iana timezone id (see file timeZone.txt) varchar(40)
    private $modificationDate; //date of last modification in yyyy-MM-dd format


    public function __construct(array $data)
    {
        //geoname table fields, see http://download.geonames.org/export/dump/readme.txt
        $this->geonameid = $data[0];
        $this->name = $data[1];
        $this->asciiname = $data[2];
        $this->alternatenames = $data[3];

        $this->latitude = $data[4];
        $this->longitude = $data[5];

        $this->featureClass = $data[6];
        $this->featureCode = $data[7];
        $this->countryCode = $data[8];
        $this->cc2 = $data[9];

        $this->admin1Code = $data[10];
        $this->admin2Code = $data[11];
        $this->admin3Code = $data[12];
        $this->admin4Code = $data[13];

        $this->population = $data[14];

        $this->elevation = $data[15];

        $this->dem = $data[16];

        $this->timezone = $data[17];
        $this->modificationDate = $data[18];
    }

    /**
     * @return mixed
     */
    public function getGeonameid()
    {
        return $this->geonameid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAsciiname()
    {
        return $this->asciiname;
    }

    /**
     * @return mixed
     */
    public function getAlternatenames()
    {
        return $this->alternatenames;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getFeatureClass()
    {
        return $this->featureClass;
    }

    /**
     * @return mixed
     */
    public function getFeatureCode()
    {
        return $this->featureCode;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return mixed
     */
    public function getCc2()
    {
        return $this->cc2;
    }

    /**
     * @return mixed
     */
    public function getAdmin1Code()
    {
        return $this->admin1Code;
    }

    /**
     * @return mixed
     */
    public function getAdmin2Code()
    {
        return $this->admin2Code;
    }

    /**
     * @return mixed
     */
    public function getAdmin3Code()
    {
        return $this->admin3Code;
    }

    /**
     * @return mixed
     */
    public function getAdmin4Code()
    {
        return $this->admin4Code;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return mixed
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * @return mixed
     */
    public function getDem()
    {
        return $this->dem;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @return mixed
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }
}