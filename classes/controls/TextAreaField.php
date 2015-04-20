<?php
require_once getabspath('classes/controls/TextControl.php');
class TextAreaField extends TextControl
{
	function TextAreaField($field, $pageObject, $id)
	{
		parent::EditControl($field, $pageObject, $id);
		$this->format = EDIT_FORMAT_TEXT_AREA;
	}
	
	function buildControl($value, $mode, $fieldNum = 0, $validate, $additionalCtrlParams, $data)
	{
		parent::buildControl($value, $mode, $fieldNum, $validate, $additionalCtrlParams, $data);
		$nWidth = $this->pageObject->pSetEdit->getNCols($this->field);
		$nHeight = $this->pageObject->pSetEdit->getNRows($this->field);
		if($this->pageObject->pSetEdit->isUseRTE($this->field))
		{
			$value = RTESafe($value);
					}
		else
		{
			echo '<textarea id="'.$this->cfield.'" '.(($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD) && $this->is508==true ? 'alt="'
				.$this->strLabel.'" ' : '').'name="'.$this->cfield.'" style="';
			if (!isMobile())
				echo "width: ".($nWidth)."px;";
			echo 'height: '.$nHeight.'px;">'.htmlspecialchars($value).'</textarea>';
		}
		$this->buildControlEnd($validate);
	}
}
?>