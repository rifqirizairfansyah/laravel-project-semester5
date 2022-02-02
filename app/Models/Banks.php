<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Banks extends Model
    {
        protected $fillable = array('id', 'nama_bank', 'jenis_bank', 'no_rekening');
    }
?>
