<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreaty extends Model
{
    use HasFactory;
    public $fillable = ['uid', 'title', 'subtitle', 'description', 'long_description', 'target_amount', 'currency_id', 'deadline', 'is_public', 'is_published', 'published_date', 'status'];

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'entreaty_id');
    }

    public function getRemainingAmount()
    {
       return  $this->getAmount() - $this->getPaidAmount();
    }

    public function getPaidAmount() {
        $contributions = $this->contributions()->get('amount_collected')->toArray();
        $paid = array_sum(array_column($contributions, 'amount_collected'));
        return $paid ?? 0;
    }

    public function getAmount()
    {
        return $this->target_amount ?? 0;
    }

    public function getReferenceNumber()
    {
        return 12345;
    }

    public function getImage()
    {
        return "https://picsum.photos/id/12{$this->id}/300/200/";

    }
}
