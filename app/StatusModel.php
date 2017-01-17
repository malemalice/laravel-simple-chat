<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
  // public $incrementing = false;

  protected $table = 't_status';
  protected $fillable = [
    'status',
    'user_id'
  ];

  public function scopeData($query, $key = NULL, $orderBy = NULL, $direction = 'asc', $offset = 0, $limit = 0)
  {
    if (is_array($key)) {
      $query->where($key);
    }

    if (!empty($offset) || !empty($limit)) {
      $query->take($limit)->skip($offset);
    }

    if (!empty($orderBy)) {
      $query->orderBy($orderBy, $direction);
    }

    return $query;
  }

  public function scopeOptions($query, $key = NULL, $default = NULL)
  {

    if (!empty($key) && !is_array($key)) {
      $query->find($key);
    }

    if (is_array($default)) {
            if (count($default)) {
                $default = $default;
            } else {
                $default = ['' => '-- Semua --'];
            }
        }
        $list = $default;
        foreach ($query->data($key, 'first_name')->get() as $dt) {
            $list[(string)$dt->id] = $dt->first_name . ' ' . $dt->middle_name . ' ' . $dt->last_name;
        }
        return $list;
  }

  public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }
}
