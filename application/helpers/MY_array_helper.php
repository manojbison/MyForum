<?php

// any_in_array() is not in the Array Helper, so it defines a new function
function any_in_array($needle, $haystack)
{
        $needle = is_array($needle) ? $needle : array($needle);

        foreach ($needle as $item)
        {
                if (in_array($item, $haystack))
                {
                        return TRUE;
                }
        }

        return FALSE;
}
// in_deep_array() is not in the Array Helper, so it defines a new function
function in_deep_array($string, $array)
{
        $array = is_array($array) ? $array : array($array);

        foreach ($array as $item)
        {
                if (in_array($string, $item))
                {
                        return TRUE;
                }
        }

        return FALSE;
}
?>
