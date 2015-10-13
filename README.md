# Bootstrap Tree View widget wrapper for yii2

[Widget page](https://github.com/efureev/bootstrap-treeview)

![Bootstrap Tree View Default](https://raw.github.com/efureev/bootstrap-treeview/master/screenshot/default.PNG)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

### Install

Either run

```
$ php composer.phar require efureev/yii2-widget-bootstraptreeview "dev-master"
```

or add

```
"efureev/yii2-widget-bootstraptreeview": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Simple example
```php
use execut\widget\TreeView;
use yii\web\JsExpression;

$items = [
    [
        'text' => 'Parent 1',
        'nodes' => [
            [
                'text' => 'Child 1',
                'nodes' => [
                    [
                       'text' => 'Grandchild 1'
                    ],
                    [
                       'text' => 'Grandchild 2'
                    ]
                ]
            ],
            [
                'text' => 'Child 2',
            ]
        ],
    ],
    [
        'text' => 'Parent 2',
    ]
];

$onSelect = new JsExpression(<<<JS
function (undefined, item) {
    console.log(item);
}
JS
);
$groupsContent = TreeView::widget([
    'data' => $data,
    'size' => TreeView::SIZE_SMALL,
    'clientOptions' => [
        'onNodeSelected' => $onSelect,
        'selectedBackColor' => 'rgb(40, 153, 57)',
        'borderColor' => '#fff',
    ],
]);
```

## Pjax navigation example
```php
use yii\widgets\Pjax;
use yii\web\JsExpression;
use execut\widget\TreeView;
Pjax::begin([
    'id' => 'pjax-container',
]);

echo \yii::$app->request->get('page');

Pjax::end();

$onSelect = new JsExpression(<<<JS
function (undefined, item) {
    if (item.href !== location.pathname) {
        $.pjax({
            container: '#pjax-container',
            url: item.href,
            timeout: null
        });
    }

    var otherTreeWidgetEl = $('.treeview.small').not($(this)),
        otherTreeWidget = otherTreeWidgetEl.data('treeview'),
        selectedEl = otherTreeWidgetEl.find('.node-selected');
    if (selectedEl.length) {
        otherTreeWidget.unselectNode(Number(selectedEl.attr('data-nodeid')));
    }
}
JS
);

$items = [
    [
        'text' => 'Parent 1',
        'def' => 'Description',
        'href' => Url::to(['', 'page' => 'parent1']),
        'nodes' => [
            [
                'text' => 'Child 1',
                'href' => Url::to(['', 'page' => 'child1']),
                'tags' => [12],
                'nodes' => [
                    [
                        'text' => 'Grandchild 1',
                        'href' => Url::to(['', 'page' => 'grandchild1'])
                    ],
                    [
                        'text' => 'Grandchild 2',
                        'href' => Url::to(['', 'page' => 'grandchild2'])
                    ]
                ]
            ],
        ],
    ],
];

$onNodeHover = new \yii\web\JsExpression(<<<JS
		function (undefined, item, tv) {
			item.def = 'Description';
			tv.treeview('redrawNode', item);
		}
JS
	);

	$onNodeLeave= new \yii\web\JsExpression(<<<JS
function (undefined, item, tv) {
		delete item.def;
		tv.treeview('redrawNode', item);
}
JS
	);

echo TreeView::widget([
    'data' => $items,
    'size' => TreeView::SIZE_SMALL,
    'clientOptions' => [
        'onNodeSelected' => $onSelect,
        'showTags' => true,
		'showTips' => true,
		'onNodeSelected' => $onSelect,
		'onNodeHover' => $onNodeHover,
		'onNodeLeave' => $onNodeLeave,
    ],
]);
```
## License

**yii2-widget-bootstraptreeview** is released under the Apache License Version 2.0. See the bundled `LICENSE.md` for details.