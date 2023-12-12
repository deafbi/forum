<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\RequestException;

class CryptoPrices extends Component
{
    public $ethPrice;
    public $btcPrice;
    public $errorMessage;

    /**
     * TODO need to go through this one more time
     */
    public function getPrices()
    {
        $prices = Cache::remember('crypto_prices', 600, function () {
            try {
                $client = new Client();
                $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum&vs_currencies=usd');
                return json_decode($response->getBody(), true);
            } catch (RequestException $e) {
                // Log the error message if needed
                // Log::error('Error fetching crypto prices: ' . $e->getMessage());

                // Set default values or an error message
                $this->errorMessage = 'Error fetching crypto prices. Please try again later.';
                return [
                    'ethereum' => ['usd' => 0],
                    'bitcoin' => ['usd' => 0],
                ];
            }
        });

        $this->ethPrice = $prices['ethereum']['usd'];
        $this->btcPrice = $prices['bitcoin']['usd'];
    }

    public function render()
    {
        $this->getPrices();

        return view('livewire.crypto-prices', ['errorMessage' => $this->errorMessage]);
    }
}
