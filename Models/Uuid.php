<?php

namespace Rpg\Models;

use Random\RandomException;

class Uuid
{
    const string salt = "d6xz52Y5b3WSFOD5U265fwY8vh4MioCFTn474Tt0OTxwgTs75bYHx77h87O34qm343gdfVDjoGnDIXbH3ch7ES6lSWTC37syomS9iYmmjD51jFD89B9Ry77Z4u7z12UG";
    const int uuid_length = 24;
    private string $hash = "";

    public static array $UUIDS = [];

    public function __construct(?string $uuidString = null)
    {
        if(!$uuidString){
            $hash = self::generateHash();
            self::$UUIDS[] = $hash;
            $this->hash = $hash;
            return;
        }
        $queryHash = str_replace('uuid_', '', $uuidString);
        if(in_array($queryHash, Uuid::$UUIDS)){
            $this->hash = $queryHash;

        }else{
            throw new \Exception("The uuid string provided is not a valid Uuid or not exist");
        }


    }

    private static function generateHash(): string{
        $hash = "";
        for ($i = 0; $i < self::uuid_length; $i++) {
            $parsedSalt = str_split(self::salt);
            // Try adding a secure hash char, if faild, create a rand hash char.
            try {
                $hash .= $parsedSalt[random_int(0, count($parsedSalt) - 1)];
            }catch (\Exception $e){
                $hash .= $parsedSalt[rand(0, count($parsedSalt) - 1)];
            }
        }
        return $hash;
    }

    public function value(): string
    {
        return "uuid_" . $this->hash;
    }
}