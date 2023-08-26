<?php

namespace YGGverse\Parser;

class Magnet {

  public static function is(string $link) : bool
  {
    return ('magnet' == parse_url($link, PHP_URL_SCHEME));
  }

  public static function parse(string $link) : mixed
  {
    $result =
    [
      'xt'   => null,
      'dn'   => null,
      'xl'   => 0,
      'tr'   => [],
      'ws'   => [],
      'as'   => [],
      'xs'   => [],
      'kt'   => [],
      'mt'   => [],
      'so'   => [],
      'x.pe' => [],
    ];

    if (!self::is($link))
    {
      return false;
    }

    $link = urldecode($link);

    $link = str_replace(
      [
        'magnet:',
        '?',
        'tr=',
        'ws=',
        'as=',
        'xs=',
        'mt=',
        'x.pe=',
      ],
      [
        false,
        false,
        'tr[]=',
        'ws[]=',
        'as[]=',
        'xs[]=',
        'mt[]=',
        'x.pe[]=',
      ],
      $link
    );

    parse_str($link, $attributes);

    switch (true)
    {
      case empty($attributes['xt']):
      case empty($attributes['tr']):
      // ...

      return false;
    }

    foreach ((array) $attributes as $key => $value)
    {

      switch ($key)
      {
        case 'kt':

          foreach ((array) explode(' ', $value) as $keyword)
          {
            $result[$key][] = trim($keyword);
          }

        break;
        default:

          $result[$key] = $value;
      }
    }

    return (object) $result;
  }
}