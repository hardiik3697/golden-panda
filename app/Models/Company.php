<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'initial_bank',
        'initial_device_reading',
        'draws',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'initial_device_reading' => 'array',
        ];
    }

    /**
     * This function returns data for company datatable
     *
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public static function getDataTable(): \Illuminate\Database\Eloquent\Collection|null
    {
        return self::all();
    }

    /**
     * This function is used to delete company record
     *
     * @param int $id
     * @return bool|null
     */
    public static function deleteRecord($id): bool|null
    {
        return self::where('id', $id)->delete();
    }
}
