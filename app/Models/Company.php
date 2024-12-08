<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    /**
     * This function is used to insert or update company record
     *
     * @param Request $request
     * @return array
     */
    public static function createOrUpdateCompany(Request $request): array
    {
        $id = $request->input('id', null);
        $data = [
            'name' => $request->input('name', null),
            'address' => $request->input('address', null),
            'initial_bank' => $request->input('initialBank', null),
            'draws' => $request->input('draws', null),
        ];

        if ($id) {
            $updated = self::where('id', $id)->update($data);
            return [
                'success' => $updated,
                'message' => $updated ? 'Record updated successfully' : 'Failed to update record',
            ];
        } else {
            $inserted = self::insert($data);
            return [
                'success' => $inserted,
                'message' => $inserted ? 'Record inserted successfully' : 'Failed to insert record',
            ];
        }
    }

    public static function getCompanyData($id): array
    {
        $getCompany = self::where('id', $id)->first();
        if (!$getCompany) {
            return [
                'status' => 'error',
                'message' => 'Failed to get record',
                'code' => 404,
            ];
        }
        return [
            'status' => 'success',
            'message' => 'Record found successfully',
            'data' => $getCompany,
        ];
    }
}
