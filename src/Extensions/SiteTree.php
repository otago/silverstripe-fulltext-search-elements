<?php

namespace OP\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;

class SiteTree extends DataExtension
{
    private static $db = [
        'Content' => 'HTMLText'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
            'Root.Search',
            [
                LiteralField::create('SearchData', 'Search Data')
                    ->setValue($this->owner->Content)
            ]
        );
    }

    public function onBeforeWrite()
    {
        $this->owner->Content = '';
        foreach ($this->owner->ElementalArea()->Elements() as $element) {
            $this->owner->Content .= $element->HTML;
        }
        parent::onBeforeWrite();
    }
}
