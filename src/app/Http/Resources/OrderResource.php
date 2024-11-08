<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Converts the current object into an associative array for API response.
     *
     * @param Request $request The HTTP request instance.
     *
     * @return array The associative array representation of the object.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->order_code,
            'name'  => $this->currency->name,
            'address' => [
                'city'      => $this->currency->address['city'],
                'district'  => $this->currency->address['district'],
                'street'    => $this->currency->address['street'],
            ],
            'price' => $this->currency->price,
            'currency' => $this->extractCurrencyCode($this->currency_type),
        ];
    }

    /**
     * Extracts the 3-letter currency code from a given string that represents a currency type.
     *
     * @param string $currencyType The string representing the currency type.
     *
     * @return string The 3-letter currency code in uppercase.
     */
protected function extractCurrencyCode(string $currencyType): string
{
    $currencyCode = substr($currencyType, strrpos($currencyType, '\\') + 1);
    return strtoupper(str_replace('Order', '', $currencyCode));
}
}
