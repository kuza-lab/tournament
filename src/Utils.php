<?php


/**
 * Handle response formatting
 * @author Phelix Juma <jumaphelix@kuzalab.com>
 * @copyright (c) 2020, Kuza Lab
 * @package Kuzalab
 */

namespace Phelix\Tournaments;


final class Utils
{

    /**
     * Function to search array data for a specific value by the provided key
     * Returns the found array keys
     * @param array $arrayData
     * @param string $searchKey
     * @param string $searchValue
     * @return array|boolean
     */
    public static function searchMultiArrayByKeyReturnKeys($arrayData, $searchKey, $searchValue)
    {
        $size = is_array($arrayData) ? sizeof($arrayData) : 0;
        for ($i = 0; $i < $size; $i++) {
            if (strtolower($arrayData[$i][$searchKey]) == strtolower($searchValue)) {
                return $arrayData[$i];
            }
        }
        return false;
    }

    /**
     * Search for array data by key
     * @param $arrayData
     * @param $searchKey
     * @param $searchValue
     * @return array
     */
    public static function searchMultiArrayByKey($arrayData, $searchKey, $searchValue)
    {

        $found = [];

        $size = is_array($arrayData) ? sizeof($arrayData) : 0;
        for ($i = 0; $i < $size; $i++) {
            if (strtolower($arrayData[$i][$searchKey]) == strtolower($searchValue)) {
                $found[] =  $arrayData[$i];
            }
        }
        return $found;
    }

    /**
     * Sort by a specific key
     * @param $key
     * @param $array
     * @param string $direction
     * @return bool
     */
    public static function sortBy($key, &$array, $direction = 'asc')
    {
        usort($array, create_function('$a, $b', '
            $a = $a["' . $key . '"];
            $b = $b["' . $key . '"];
    
            if ($a == $b)
            {
                return 0;
            }
            return ($a ' . ($direction == 'desc' ? '>' : '<') . ' $b) ? -1 : 1;
        '));

        return true;
    }

    /**
     * Implements PHP's uasort in a stable way
     * @param $array
     * @param $cmp_function
     */
    public static function stableuasort(&$array, $cmp_function)
    {
        if (count($array) < 2) {
            return;
        }

        $halfway = count($array) / 2;
        $array1 = array_slice($array, 0, $halfway, TRUE);
        $array2 = array_slice($array, $halfway, NULL, TRUE);

        self::stableuasort($array1, $cmp_function);
        self::stableuasort($array2, $cmp_function);
        if (call_user_func($cmp_function, end($array1), reset($array2)) < 1) {
            $array = $array1 + $array2;
            return;
        }
        $array = array();
        reset($array1);
        reset($array2);
        while (current($array1) && current($array2)) {
            if (call_user_func($cmp_function, current($array1), current($array2)) < 1) {
                $array[key($array1)] = current($array1);
                next($array1);
            } else {
                $array[key($array2)] = current($array2);
                next($array2);
            }
        }
        while (current($array1)) {
            $array[key($array1)] = current($array1);
            next($array1);
        }
        while (current($array2)) {
            $array[key($array2)] = current($array2);
            next($array2);
        }
        return;
    }

    /**
     * Implement stable php usort public static function
     * @param $array
     * @param $cmp_function
     */
    public static function stableusort(&$array, $cmp_function)
    {
        // Arrays of size < 2 require no action.
        if (count($array) < 2)
            return;
        // Split the array in half
        $halfway = count($array) / 2;
        $array1 = array_slice($array, 0, $halfway);
        $array2 = array_slice($array, $halfway);
        // Recurse to sort the two halves
        self::stableusort($array1, $cmp_function);
        self::stableusort($array2, $cmp_function);
        // If all of $array1 is <= all of $array2, just append them.
        if (call_user_func($cmp_function, end($array1), $array2[0]) < 1) {
            $array = array_merge($array1, $array2);
            return;
        }
        // Merge the two sorted arrays into a single sorted array
        $array = array();
        $ptr1 = $ptr2 = 0;
        while ($ptr1 < count($array1) && $ptr2 < count($array2)) {
            if (call_user_func($cmp_function, $array1[$ptr1], $array2[$ptr2]) < 1) {
                $array[] = $array1[$ptr1++];
            } else {
                $array[] = $array2[$ptr2++];
            }
        }
        // Merge the remainder
        while ($ptr1 < count($array1))
            $array[] = $array1[$ptr1++];
        while ($ptr2 < count($array2))
            $array[] = $array2[$ptr2++];
        return;
    }
}