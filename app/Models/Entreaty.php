<?php

namespace App\Models;

use App\Classes\BeemBroker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Entreaty extends Model
{
    use HasFactory;
    public $fillable = ['uid', 'reference_number', 'title', 'subtitle', 'description', 'long_description', 'target_amount', 'currency_id', 'deadline', 'is_public', 'is_published', 'published_date', 'image', 'status', 'wallet_number', 'wallet_code'];

    public static function forUser($id) {
        return Entreaty::where('user_id', $id)->get();
    }

    public static function allPublic() {
        return self::where('is_public', 1)->paginate(50);
    }

    public static function processContribution($reference_number) {
        $entreaty = self::where('reference_number', $reference_number)->first();
        if($entreaty){
            if($entreaty->getRemainingAmount() <= 0 && $entreaty->getAmount() > 0) {
               $entreaty->makeCompleted();
            }
        } else {

        }
    }

    public function makeCompleted()
    {
        if($this->status != 'COMPLETED') {
            if($this->wallet_number && $this->wallet_code){
                $beem = new BeemBroker();
                $beem->disburse($this->getPaidAmount(), $this->wallet_number, $this->wallet_code);
            }
            $this->status = 'COMPLETED';
            return $this->save();
        }
    }

    public function getStateData() {
        $data = [
          'amount' => $this->getAmount(),
            'paid' => $this->getPaidAmount(),
          'remaining' => $this->getRemainingAmount(),
            'status' => $this->status
        ];
        return $data;
    }

    public function save(array $options = [])
    {
        if (!$this->id) {
            $this->uid = $this->generateUniqueId();
            if (!$this->user_id) {
                $this->user_id = Auth::user()->id;
            }
            if ($this->deadline) {
                $this->deadline = date('Y-m-d :23:59:59', strtotime($this->deadline));
            }
            if ($this->is_published) {
                $this->status = 'PUBLISHED';
            }
            $this->reference_number = $this->generateReferenceNumber();
            $this->image = 'https://picsum.photos/id/' . rand(1, 999) . '/350/200';
        }
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
       $remaining =  $this->getAmount() - $this->getPaidAmount();
       return $remaining > 0 ? $remaining : 0;
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

    public function getPaidPercentage()
    {
        return ($this->getAmount()) > 0 ? ($this->getPaidAmount() / (100 / $this->getAmount())) : 0;
    }

    public function getReferenceNumber()
    {
        return $this->reference_number;
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
        $keyword = 'JAF-';
        $last = self::latest()->first();
        if($last) {
            $numeric_part = substr($last['reference_number'], strlen($keyword));
            $new_number = (1 + ($numeric_part ?? 1111));
        } else {
            $new_number =  1111;
        }
        return $keyword .= $new_number;
    }
}
