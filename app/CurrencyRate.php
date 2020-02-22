<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CurrencyRate
 *
 * @property int $id
 * @property string $provider
 * @property int $source_iso
 * @property int $target_iso
 * @property float $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereSourceIso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereTargetIso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereValue($value)
 * @mixin \Eloquent
 * @property int $target_id
 * @property int $source_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyRate whereTargetId($value)
 * @property-read \App\Currency $source
 * @property-read \App\Currency $target
 */
class CurrencyRate extends Model
{
    protected $guarded = [];

    public function source()
    {
        return $this->belongsTo(Currency::class, 'source_id');
    }

    public function target()
    {
        return $this->belongsTo(Currency::class, 'target_id');
    }
}
