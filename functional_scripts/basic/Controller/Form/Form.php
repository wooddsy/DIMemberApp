<?php 
class Form 
{ 
    public $aMemberVar = 'aMemberVar Member Variable'; 
    public $aFuncName = 'aMemberFunc'; 
    
    
    function input(
    	$name,
    	$properties,
    	$attributes)
    { 
        $html = '<div ' . (isset($properties['id']) ? 'id="' . $properties['id'] . '"' : '') . ' class="input-group mg-b-pro-edt ' . (isset($properties['class']) ? $properties['class'] : '') . '">';
        if(isset($properties['icon']['pre'])) {
        	$html .= '<span class="input-group-addon"><i class="icon ' . $properties['icon']['pre'] . '" aria-hidden="true"></i></span>';
        }
        $html .= '<input ' . (isset($attributes['id']) ? 'id="' . $attributes['id'] . '"' : '') . ' type="text" class="form-control ' . (isset($attributes['class']) ? $attributes['class'] : '') . '" name="' . $name . '" ' . (isset($attributes['placeholder']) ? 'placeholder="' . $attributes['placeholder'] . '"' : '') . '>';
        $html .= '</div>' ;
    }

    function checkbox()
    { 
        print 'Inside `aMemberFunc()`'; 
    }

    function radio(
    	$name,
    	$properties,
    	$attributes)
    {
    	$html = '<div ' . (isset($properties['id']) ? 'id="' . $properties['id'] . '"' : '') . ' class="radio radiofill ' . (isset($properties['class']) ? $properties['class'] : '') . '">';
		$html .= '<label>';
		$html .= '<input ' . (isset($attributes['id']) ? 'id="' . $attributes['id'] . '"' : '') . ' ' . (isset($attributes['class']) ? 'class="' . $attributes['class'] . '"' : '') . ' type="radio" name="' . $name . '" ' . (isset($attributes['value']) ? 'value="' . $attributes['value'] . '"' : '') . '>';
		if(isset($properties['helper'])) {
			$html .= '<i class="helper"></i>';
		}
		if(isset($properties['content'])) {
			$html .= $properties['content'];
		}
		$html .= '</label>';
        $html .= '</div>';
    }

    function select(
    	$name,
    	$properties,
    	$attributes,
    	$options)
    {
    	$html = '<select name="select" class="form-control pro-edt-select form-control-primary">';
    	foreach($options as $value => $content) {
    		$html .= '<option value="' . $value . '">' . $content . '</option>';
    	}
		$html .= '</select>';
    }
} 

$foo = new Foo; 
?> 