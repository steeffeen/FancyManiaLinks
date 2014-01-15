<?php

namespace FML\Controls;

use FML\Elements\FrameModel;
use FML\Types\Renderable;

/**
 * Class representing an Instance of a Frame Model
 * (CMlFrame)
 *
 * @author steeffeen
 */
// TODO: check if control id will be modelid or own id
class FrameInstance extends Control {
	/**
	 * Protected Properties
	 */
	protected $modelId = '';
	protected $model = null;

	/**
	 * Create a new Frame Instance
	 *
	 * @param string $modelId (optional) Frame Model Id
	 * @return \FML\Controls\Frame
	 */
	public static function create($modelId = null) {
		$frameInstance = new FrameInstance($modelId);
		return $frameInstance;
	}

	/**
	 * Construct a new Frame Instance
	 *
	 * @param string $id (optional) Control Id
	 * @param string $modelId (optional) Frame Model Id
	 */
	public function __construct($modelId = null) {
		parent::__construct(null);
		$this->tagName = 'frameinstance';
		if ($modelId !== null) {
			$this->setModelId($modelId);
		}
	}

	/**
	 * Set Model Id
	 *
	 * @param string $modelId Model Id
	 * @return \FML\Controls\FrameInstance
	 */
	public function setModelId($modelId) {
		$this->modelId = (string) $modelId;
		$this->model = null;
		return $this;
	}

	/**
	 * Set Frame Model to use
	 *
	 * @param FrameModel $frameModel Frame Model
	 * @return \FML\Controls\FrameInstance
	 */
	public function setModel(FrameModel $frameModel) {
		$this->model = $frameModel;
		$this->modelId = '';
		return $this;
	}

	/**
	 *
	 * @see \FML\Renderable::render()
	 */
	public function render(\DOMDocument $domDocument) {
		$xmlElement = parent::render($domDocument);
		if ($this->model) {
			$this->model->checkId();
			$xmlElement->setAttribute('modelid', $this->model->getId());
		}
		else if ($this->modelId) {
			$xmlElement->setAttribute('modelid', $this->modelId);
		}
		return $xmlElement;
	}
}
