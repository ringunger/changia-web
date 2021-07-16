<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Entreaty extends Model
{
    use HasFactory;
    public $fillable = ['uid', 'reference_number', 'title', 'subtitle', 'description', 'long_description', 'target_amount', 'currency_id', 'deadline', 'is_public', 'is_published', 'published_date', 'image', 'status'];

    public static function forUser($id) {
        return Entreaty::where('user_id', $id)->get();
    }

    public function save(array $options = [])
    {
        $this->uid = $this->generateUniqueId();
        $this->user_id = Auth::user()->id();
        $this->reference_number = $this->generateReferenceNumber();
        $this->image = 'https://picsum.photos/id/'. rand(1, 9999). '/300/200';
        return parent::save($options);
    }


    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'reference_number', 'reference_number');
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
        return $this->image ?? "https://picsum.photos/id/12{$this->id}/300/200/";

    }

    private function generateUniqueId()
    {
        $uid = Str::random();
        return $uid;
    }

    public function generateReferenceNumber() {
        $last = self::latest()->first();
        if($last) {
            return 1 + ($last['reference_number'] ?? 1111);
        } else {
            return 1111;
        }
    }
}
