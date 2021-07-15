<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;
    public $fillable = ['mcc_network', 'mnc_network', 'network_name', 'amount_collected', 'transaction_id', 'subscriber_msisdn', 'source_currency', 'target_currency', 'reference_number', 'paybill_number', 'timestamp',];
}
