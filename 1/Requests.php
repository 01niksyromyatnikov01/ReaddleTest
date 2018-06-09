<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 06.06.2018
 * Time: 23:34
 */

namespace Requests;



abstract class Requests {
  protected $request,$answer;

  abstract function Request($link);
}


class API extends Requests {

  public function Request($link)  {
      try {
          if(empty($link)) throw new \InvalidArgumentException("Param Link is empty at Requests->API");

          $info = file_get_contents($link);
          return json_decode($info, true);

      }
      catch (\Exception $e) {
          echo json_encode(['error' => $e->getMessage()]); die();
      }
  }

}