<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'url_maps'
    ];
    
    /**
     * Get the HTML safe map URL.
     * This allows the iframe to be displayed properly when inserted into HTML
     */
    public function getUrlMapsAttribute($value)
    {
        // If the value is already an iframe HTML, return it directly
        if (str_contains($value, '<iframe')) {
            return $value;
        }
        
        // Otherwise, assume it's a URL and convert to iframe
        if ($value) {
            return '<iframe src="' . $value . '" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
        }
        
        return null;
    }
}