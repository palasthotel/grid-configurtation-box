<?php
/**
 * Created by PhpStorm.
 * User: edward
 * Date: 2019-04-26
 * Time: 16:11
 */

namespace Palasthotel\Grid\ConfigurationBox;


/**
 * @property string filter
 */
class ConfigurationStructure {

	public function __construct($contentStructureFilter) {
		$this->filter = $contentStructureFilter;
	}

	var $cs = null;

	public function hasConfiguration(){
		return count($this->getContentStructure()) > 0;
	}

	public function getContentStructure(){

		if($this->cs != null) return $this->cs;

		$cs = array();
		$this->cs = apply_filters($this->filter, $cs);
		return $this->cs;
	}

}