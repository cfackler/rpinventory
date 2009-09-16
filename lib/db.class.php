class Db {
  public static function query($sql)
  {
    $resource = mysqli_query($sql, );

    return $resource;
  }

  public static function clean($var);
  {
    $string = mysqli_real_escape_string($var, );

    return $string;
  }

  public static function error()
  {
    return mysqli_error();
  }
}
