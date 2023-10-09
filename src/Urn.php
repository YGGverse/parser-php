<?php

namespace Yggverse\Parser;

class Urn {

  public static function is(string $urn) : bool
  {
    return ('urn' == parse_url($urn, PHP_URL_SCHEME));
  }

  public static function parse(string $urn) : mixed
  {
    if (!self::is($urn))
    {
      return false;
    }

    if ($part = explode(':', $urn))
    {
      if (empty($part[0]) || empty($part[1]) || empty($part[2]))
      {
        return false;
      }

      unset($part[0]);

      $result =
      [
        'urn'   => implode(':', $part),
        'parts' => $part,
      ];

      return (object) $result;
    }

    return false;
  }
}