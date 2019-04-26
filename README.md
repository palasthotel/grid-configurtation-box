# Grid – Configuration Box

Append configuration objects to your containers and slots.

## Installation

Like always: copy to wp-content/plugins/grid-configuration-box and activate in backend.

## Usage

If you provide a content structure with the filters mentioned further down, you can use up to two new boxes in grid.

Containers and Slots will have a new property called `$container->config` or `$slot->config` which is `null` or a assoc array.

## Hooks

### Container configuration content structure

To use the configuration box for containers you have to implement the filter and add a content structure.

```php
add_filter('grid_configuration_box_container_content_structure', function($cs){
	$cs[] = array(
		"key"   => "containerconfigvar",
		"label" => "My var",
		"type"  => "text",
	);
	return $cs;
});
```

### Slot configuration content structure

```php
add_filter('grid_configuration_box_slot_content_structure', function($cs){  
	$cs[] = array(
		"key"   => "containerconfigvar",
		"label" => "My var",
		"type"  => "text",
	);
	return $cs;  
});
```