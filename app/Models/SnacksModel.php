<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Providers\SnackServiceProvider;
class SnacksModel extends Model
{
    use HasFactory;
    /**
     * Get snacks from the external Snack API.
     *
     * @return array|null
     */
    public static function getSnacksFromApi()
    {
        $snackApiService = new SnackServiceProvider();

        // Use the SnackApiService to fetch snacks from the external API
        return $snackApiService->index();
    }
}
