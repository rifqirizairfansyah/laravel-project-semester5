<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserReksadana extends Model
    {
        protected $fillable = array('id', 'user_id', 'reksadana_id', 'jumlah_unit', 'nilai_portofolio', 'keuntungan', 'imba_hasil');
    }
?>
