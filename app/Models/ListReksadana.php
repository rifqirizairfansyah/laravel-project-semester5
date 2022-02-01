<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ListReksadana extends Model
    {
        protected $fillable = array('id', 'nama_reksadana', 'biaya_pembelian', 'biaya_penjualan', 'tingkat_resiko', 'jenis_produk');
    }
?>
