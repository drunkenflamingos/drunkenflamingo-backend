<?php
/**
 * Created by PhpStorm.
 * User: spriz
 * Date: 07/06/2017
 * Time: 18.00
 */

namespace App\Utility;


class Gravatar
{
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param int|string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $imageSetSize Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $maxRating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole|bool $img True to return a complete IMG tag False for just the URL
     * @param array $extraAttributes Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public static function getGravatarUrl(
        $email,
        $size = 80,
        $imageSetSize = 'mm',
        $maxRating = 'x',
        $img = false,
        array $extraAttributes = []
    ): string {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$imageSetSize&r=$maxRating";

        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($extraAttributes as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }

        return $url;
    }
}