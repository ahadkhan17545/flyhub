<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Customer
 *
 * @OA\Schema (
 *      @OA\Xml(name="Customer"),
 *      required={""},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int64"
 *      ),
 *      @OA\Property(
 *          property="channel_id",
 *          description="channel_id",
 *          type="integer",
 *          format="int64"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="gender",
 *          description="gender",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="birthdate",
 *          description="birthdate",
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="subscribed_to_news_letter",
 *          description="subscribed_to_news_letter",
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="notes",
 *          description="notes",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 * @property int $id
 * @property int $channel_id
 * @property string $type
 * @property string $name
 * @property string|null $fantasy_name
 * @property string|null $gender
 * @property string|null $birthdate
 * @property string $email
 * @property bool $status
 * @property bool $subscribed_to_news_letter
 * @property string|null $phone
 * @property string|null $cellphone
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $remote_id
 * @property string|null $cpf_cnpj
 * @property string|null $ie
 * @property string|null $rg
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\Tenant\Channel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $ordersAddress
 * @property-read int|null $orders_address_count
 * @property-read \App\Models\Tenant|null $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCpfCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFantasyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRemoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSubscribedToNewsLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 * @property-read float $person_type
 * @mixin \Eloquent
 */
class Customer extends Model
{
	use HasFactory;

	/**
	 * @var string
	 */
	public $table = 'customers';

	/**
	 * @var string[]
	 */
	protected $guarded = ['id'];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'status' => 'boolean',
		'subscribed_to_news_letter' => 'boolean',
		'birthdate' => 'date',
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'channel_id' => 'required',
		'name' => 'required',
		'email' => 'required',
	];

	/**
	 * @var string[]
	 */
	protected $appends = ['person_type'];

	/**
	 * Create a new factory instance for the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	protected static function newFactory()
	{
		return \Database\Factories\CustomerFactory::new();
	}

	/**
	 * Ensure empty or falsy birthdate is exposed as null (prevents casting empty string to Carbon).
	 */
	    public function getBirthdateAttribute($value)
    {
        if (array_key_exists('birthdate', $this->attributes) && empty($this->attributes['birthdate'])) {
            return null;
        }
        if ($value instanceof Carbon) {
            return $value->format('Y-m-d');
        }
        return $value;
    }

	/**
	 * @return float
	 */
	public function getPersonTypeAttribute()
	{
		return strlen($this->cpf_cnpj) >= 14 ? 'J' : 'F';
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function channel()
	{
		return $this->belongsTo(Channel::class, 'channel_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function addresses()
	{
		return $this->hasMany(Address::class, 'customer_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orders()
	{
		return $this->hasMany(Order::class, 'customer_id');
	}
}
