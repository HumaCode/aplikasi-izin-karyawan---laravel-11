<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $guarded = [];


    /**
     * Get all of the karyawan for the Divisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function karyawan(): HasMany
    {
        return $this->hasMany(Karyawan::class, 'divisi_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
