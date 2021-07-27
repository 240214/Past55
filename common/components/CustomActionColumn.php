<?php
namespace common\components;

use yii\grid\ActionColumn;

class CustomActionColumn extends ActionColumn {
	
	public $filterContent;
	#public $template;
	
	/**
	 * Renders the filter cell content.
	 * The default implementation simply renders a blank space.
	 * This method may be overridden to customize the rendering of the filter cell (if any).
	 * @return string the rendering result
	 */
	protected function renderFilterCellContent(){
		return $this->filterContent;
	}
	
	/*protected function renderDataCellContent($model, $key, $index){
		return $this->template;
	}*/
	
}