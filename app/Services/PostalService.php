<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PostalService
{
    /**
     * Get post office details by pincode
     */
    public function getPostOfficeByPinCode($pincode)
    {
        // Make the API call
        $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");

        if ($response->successful()) {
            $data = $response->json();
            // Check if the response has valid data
            if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success') {
                return $data[0]['PostOffice']; // Return post office data
            }
        }
        return null;
    }
}