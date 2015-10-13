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
	public $sourcePath = '@vendor/efureev/yii2-widget-bootstraptreeview/assets';
	public $css = [
		'css.css',
	];

	public $depends = [
		'efureev\widget\TreeViewBowerAsset',
	];
}