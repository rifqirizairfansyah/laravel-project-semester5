<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Topups extends Model
    {
        protected $fillable = array('id', 'jumlah_topup', 'tanggal', 'id_reksadana', 'bank');
    }
?>
