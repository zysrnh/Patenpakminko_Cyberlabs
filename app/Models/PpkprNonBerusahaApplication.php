<?php

namespace App\Models;

/**
 * Alias class untuk PpkprApplication (Layanan Non-Berusaha)
 * Memastikan kompatibilitas jika ada controller atau view yang memanggil PpkprNonBerusahaApplication.
 */
class PpkprNonBerusahaApplication extends PpkprApplication
{
    protected $table = 'ppkpr_applications';
}
