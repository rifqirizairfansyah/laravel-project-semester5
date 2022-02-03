<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Transakses extends Model
    {
        protected $fillable = array('id', 'no_order', 'nilai_jual', 'jenis_transaksi', 'reksadana_id', 'jumlah_unit', 'rekening_id', 'status');
    }
?>
