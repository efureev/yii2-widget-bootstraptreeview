<?php
namespace efureev\widget;


use yii\web\AssetBundle;

/**
 * Custom styles
 *
 * @author efureev
 */
class TreeViewAsset extends AssetBundle
{
	public $sourcePath = '@efureev/widget/assets';
	public $css = [
		'css.css',
	];

	public $depends = [
		'efureev\widget\TreeViewBowerAsset',
	];
}