<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Currency
 *
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $name_es
 * @property string|null $prefix
 * @property string|null $suffix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereIso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereNameEs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $decimals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CurrencyRate[] $rates
 * @property-read int|null $rates_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereDecimals($value)
 */
class Currency extends Model
{
    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * @param $source
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|CurrencyRate
     */
    public function rates($source)
    {
        return $this->hasMany(CurrencyRate::class, 'target_id')->where('source_id', $source);
    }
}
