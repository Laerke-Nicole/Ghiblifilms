<?php
class GetID
{
    public static function getValues(array $keys): array

    {
        // empty array to store arrays
        $values = [];

        // loop through the keys
        foreach ($keys as $key) {
            if (isset($_GET[$key])) {
                $values[$key] = htmlspecialchars(trim($_GET[$key]));
            } else {
                $values[$key] = null;
            }
        }

        return $values;
    }
}