<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 06.06.2018
 * Time: 22:54
 */
namespace Currency;
use Requests\API as API;

class Currency
{
  protected  $Exchange;
  protected $curr_arr = array('UAH','EUR','GBP');
  protected $link = 'https://free.currencyconverterapi.com/api/v5/convert?';

  public function __construct(API $API)
  {
    $this->Exchange = new Exchange($API);
  }

    protected function CheckCurrency($curr) {
        return in_array($curr,$this->curr_arr);
    }

    function getInfo($curr) {
        try {
            if ($this->CheckCurrency($curr)) {
                $this->Prepare($curr);
                return $this->API->Request($this->link);
            }
            else throw new \InvalidArgumentException("Currency argument was not correct");
        }
        catch(\InvalidArgumentException $e) {echo json_encode(['error' => $e->getMessage(),'result' => 0]);die();}
    }

    private function Prepare($curr) {
        $this->link .= 'q='.$this->from.'_'.$curr.'&compact=ultra';
    }

}


class Exchange extends Currency
{
    protected $API;
    protected $from = 'USD';

    public function __construct(API $API)
    {
       $this->API = $API;
    }

   public function Convert($price,$curr) {
        try {
            $result = $this->getInfo($curr);
            if ($result) return round($result['USD_' . $curr . ''] * $price, 3);
            else throw new \Exception("InvalidArgumentException: Currency argument was not correct. Use EUR,UAH,GBP");
        }
        catch (\Exception $e) {echo json_encode([['error' => $e->getMessage(),'result' => 0]]);die();}
   }


}