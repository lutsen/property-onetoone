<?php

namespace Lagan\Property;

/**
 * Controller for the Lagan one-to-one property.
 * The Onetoone property type controller enables a one-to-one relation between 2 Lagan models.
 * The name of the property should be the name of the Lagan model this model can have a one-to-one
 * relation with. Unlike the many-to-many, many-to-one and one-to-many relations,
 * the Lagan model this model can have a one-to-one relation with should NOT have
 * a one-to-one relation with this model as well. 
 *
 * A property type controller can contain a set, read, delete and options method. All methods are optional.
 * To be used with Lagan: https://github.com/lutsen/lagan
 */

class Onetoone {

	/**
	 * The set method is executed each time a property with this type is set.
	 *
	 * @param bean		$bean		The Redbean bean object with the property.
	 * @param array		$property	Lagan model property arrray.
	 * @param integer	$new_value	The id of the object the object with this property has a one-to-one relation with.
	 *
	 * @return $id		The id of the Redbean bean object the object with this property has a one-to-one relation with.
	 */
	public function set($bean, $property, $new_value) {

		// Check and set relation
		$relation = \R::findOne( $property['name'], ' id = :id ', [ ':id' => $new_value ] );
		if ( !$relation ) {
			throw new \Exception('This '.$property['name'].' does not exist.');
		} else {
			return $new_value;
		}

	}

	/**
	 * The options method returns all the optional values this property can have,
	 * including the one it currently has.
	 *
	 * @param bean		$bean		The Redbean bean object with the property.
	 * @param array		$property	Lagan model property arrray.
	 *
	 * @return array	Array with all beans of the $property['name'] Lagan model.
	 */
	public function options($bean, $property) {
		return \R::findAll( $property['name'] );
	}

}

?>