<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_name', 'user_email', 'image_path', 'message_text'];

    /**
     * Pagination for admin panel.
     *
     * @param int|null $perPage
     *
     * @return mixed
     */
    public function getAllWithPaginate(int $perPage = null)
    {
        $columns = ['id', 'user_name', 'user_email','image_path', 'message_text', 'status'];

        $result = $this
            ->select($columns)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        return $result;
    }

    /**
     * Pagination for frontend panel.
     *
     * @param int|null $perPage
     *
     * @return mixed
     */
    public function getApprovedWithPaginate(int $perPage = null)
    {
        $columns = ['id', 'user_name', 'user_email', 'image_path', 'is_edited', 'message_text'];

        $result = $this
            ->select($columns)
            ->where('status', 'approved')
            ->orderBy('updated_at', 'DESC')
            ->paginate($perPage);

        return $result;
    }
}
