<?php
class HelpersModel extends smTitan {

  public function depluralize($word)
  {
    // Here is the list of rules. To add a scenario,
    // Add the plural ending as the key and the singular
    // ending as the value for that key. This could be
    // turned into a preg_replace and probably will be
    // eventually, but for now, this is what it is.
    //
    // Note: The first rule has a value of false since
    // we don't want to mess with words that end with
    // double 's'. We normally wouldn't have to create
    // rules for words we don't want to mess with, but
    // the last rule (s) would catch double (ss) words
    // if we didn't stop before it got to that rule.
    $rules = array(
        'ss' => false,
        'os' => 'o',
        'ies' => 'y',
        'xes' => 'x',
        'oes' => 'o',
        'ies' => 'y',
        'ves' => 'f',
        's' => '');
    // Loop through all the rules and do the replacement.
    foreach(array_keys($rules) as $key)
    {
      // If the end of the word doesn't match the key,
      // it's not a candidate for replacement. Move on
      // to the next plural ending.
      if(substr($word, (strlen($key) * -1)) != $key)
          continue;
      // If the value of the key is false, stop looping
      // and return the original version of the word.
      if($key === false)
          return $word;
      // We've made it this far, so we can do the
      // replacement.
      return substr($word, 0, strlen($word) - strlen($key)) . $rules[$key];
    }

    return $word;
  }


  /**
   * Strip out spaces between words and replace with special character. Such as underscore (_) or hyphen (-).
   *
   * @param string $string
   * @param string $character
   *
   * @return string
   */
  public function formatStripSpaces($string = '', $character = '_')
  {
    // make string lowercase and remove spaces and hyphens and replace with underscores
    $modifiedString = str_replace(array(' ', $character, 'and'),array($character, $character, ''), strtolower($string));

    // check for double underscores
    $modifiedString = str_replace("$character$character", $character, $modifiedString);

    return $modifiedString;
  }

  /**
   * Format an id name
   *
   * @param array $parameters
   *
   * @return array
   */
  public function formatId($name, $string, $character = '_')
  {
    // get total number of characters inside string
    $stringLength = strlen($string);

    // create regex word search
    for($i = 0; $i < $stringLength; $i++)
    {
      if($i == 0)
      {
        $regex = '[' . $string[0] . strtoupper($string[0]) . ']';
      }
      else
      {
        $regex .= $string[$i];
      }
    }

    $regex = (string)'/\b' . $regex . '\b/';

    // strip the word sidebar if it exists
    $id = trim(preg_replace($regex, "", $name));

    // modify formatting of id name
    $id = 'sidebar-' . HelpersModel::formatStripSpaces($id, '-');

    return $id;
  }
}
