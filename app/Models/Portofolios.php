<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Portofolios extends Model
    {
        protected $fillable = array('id', 'nama_portofolio', 'target_dana', 'tanggal_tercapai', 'nilai_portofolio', 'keuntungan', 'imba_hasil', 'reksadana_id');
    }
?>
