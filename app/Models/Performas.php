<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Performas extends Model
    {
        protected $fillable = array('id', 'portofolio_id', 'modal_investasi', 'keuntungan_terealisasi', 'total_pembelian', 'total_penjualan');
    }
?>
