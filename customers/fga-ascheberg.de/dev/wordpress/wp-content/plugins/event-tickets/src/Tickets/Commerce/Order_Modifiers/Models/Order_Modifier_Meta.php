<?php
/**
 * The Order Modifier Meta model.
 *
 * @since 5.18.0
 *
 * @package TEC\Tickets\Commerce\Order_Modifiers\Models;
 */

namespace TEC\Tickets\Commerce\Order_Modifiers\Models;

use TEC\Common\StellarWP\Models\Contracts\ModelCrud;
use TEC\Common\StellarWP\Models\Contracts\ModelFromQueryBuilderObject;
use TEC\Common\StellarWP\Models\Model;
use TEC\Common\StellarWP\Models\ModelQueryBuilder;
use TEC\Tickets\Commerce\Order_Modifiers\Data_Transfer_Objects\Order_Modifier_Meta_DTO;
use TEC\Tickets\Commerce\Order_Modifiers\Repositories\Order_Modifiers_Meta;

/**
 * Class Order_Modifier_Meta.
 *
 * @since 5.18.0
 *
 * @package TEC\Tickets\Commerce\Order_Modifiers\Models;
 *
 * @property int    $id                The Order Modifier Meta ID.
 * @property int    $order_modifier_id The associated Order Modifier ID.
 * @property string $meta_key          The meta key.
 * @property string $meta_value        The meta value.
 * @property int    $priority          The priority of the meta entry.
 * @property string $created_at        Creation timestamp.
 */
class Order_Modifier_Meta extends Model implements ModelCrud, ModelFromQueryBuilderObject {

	/**
	 * @inheritDoc
	 */
	protected $properties = [
		'id'                => 'int',
		'order_modifier_id' => 'int',
		'meta_key'          => 'string',
		'meta_value'        => 'string|int',
		'priority'          => [ 'int', 0 ],
		'created_at'        => 'string',
	];

	/**
	 * Finds a model by its ID.
	 *
	 * @since 5.18.0
	 *
	 * @param int $id The model ID.
	 *
	 * @return Order_Modifier_Meta|null The model instance, or null if not found.
	 */
	public static function find( $id ): ?self {
		return tribe( Order_Modifiers_Meta::class )->find_by_id( $id );
	}

	/**
	 * Creates a new model and saves it to the database.
	 *
	 * @since 5.18.0
	 *
	 * @param array<string,mixed> $attributes The model attributes.
	 *
	 * @return Order_Modifier_Meta The model instance.
	 */
	public static function create( array $attributes ): self {
		$model = new self( $attributes );
		$model->save();

		return $model;
	}

	/**
	 * Saves the model to the database.
	 *
	 * @since 5.18.0
	 *
	 * @return Order_Modifier_Meta The model instance.
	 */
	public function save(): self {
		if ( $this->id ) {
			return tribe( Order_Modifiers_Meta::class )->update( $this );
		}

		$this->id = tribe( Order_Modifiers_Meta::class )->insert( $this )->id;

		return $this;
	}

	/**
	 * Deletes the model from the database.
	 *
	 * @since 5.18.0
	 *
	 * @return bool Whether the model was deleted.
	 */
	public function delete(): bool {
		return tribe( Order_Modifiers_Meta::class )->delete( $this );
	}

	/**
	 * Returns the query builder for the model.
	 *
	 * @since 5.18.0
	 *
	 * @return ModelQueryBuilder The query builder instance.
	 */
	public static function query(): ModelQueryBuilder {
		return tribe( Order_Modifiers_Meta::class )->query();
	}

	/**
	 * Builds a new model from a query builder object.
	 *
	 * @since 5.18.0
	 *
	 * @param object $object The object to build the model from.
	 *
	 * @return Order_Modifier_Meta The model instance.
	 */
	public static function fromQueryBuilderObject( $object ): self {
		return Order_Modifier_Meta_DTO::fromObject( $object )->toModel();
	}

	/**
	 * Validates an attribute to a PHP type.
	 *
	 * This adds the ability to have multiple types separated by a pipe character.
	 *
	 * @since 5.21.0
	 *
	 * @param string $key   Property name.
	 * @param mixed  $value Property value.
	 *
	 * @return bool
	 */
	public function isPropertyTypeValid( string $key, $value ): bool {
		$type = $this->getPropertyType( $key );

		if ( ! str_contains( $type, '|' ) ) {
			return parent::isPropertyTypeValid( $key, $value );
		}

		// With multiple types, check each one until we get a valid match, otherwise return false.
		$types = array_map(
			static fn( $item ) => trim( $item ),
			explode( '|', $type )
		);

		foreach ( $types as $type ) {
			switch ( $type ) {
				case 'int':
					$valid = is_int( $value );
					break;

				case 'string':
					$valid = is_string( $value );
					break;

				case 'bool':
					$valid = is_bool( $value );
					break;

				case 'array':
					$valid = is_array( $value );
					break;

				case 'float':
					$valid = is_float( $value );
					break;

				case 'number':
					$valid = is_int( $value ) || is_float( $value );
					break;

				default:
					$valid = $value instanceof $type;
					break;
			}

			// We've found a valid type, so we can return true.
			if ( $valid ) {
				return true;
			}
		}

		// If we've reached this point, we haven't found a valid type, so return false.
		return false;
	}
}
