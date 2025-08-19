<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductInventory
 *
 * @property int $id
 * @property int $qty
 * @property int $product_id
 * @property int $inventory_source_id
 * @property-read \App\Models\InventorySource $inventory_source
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory whereInventorySourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductInventory whereQty($value)
 * @mixin \Eloquent
 */
class ProductInventory extends Model
{
	use HasFactory;

	/**
	 * @var string
	 */
	public $table = 'product_inventories';

	/**
	 * @var string[]
	 */
	protected $guarded = ['id'];

	/**
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Create a new factory instance for the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	protected static function newFactory()
	{
		return \Database\Factories\ProductInventoryFactory::new();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function inventory_source()
	{
		return $this->belongsTo(InventorySource::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
