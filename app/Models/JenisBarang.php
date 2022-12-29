<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    protected $table = "jenis_barangs";

    /**
     * Get the barang associated with the JenisBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barang()
    {
        return $this->hasOne(Barang::class, 'jenis_barang', 'id');
    }
}
