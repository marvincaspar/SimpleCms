<?php
namespace Mc388\SimpleCms\App\Models;

use Baum\Node;
use Illuminate\Support\Facades\URL;

/**
 * Class Content
 *
 * @package Mc388\SimpleCms\App\Models
 */
class Content extends Node
{
    const TYPE_SITE = 'site';
    const TYPE_LINK = 'link';
    const TYPE_GLOBAL = 'global';

    private $children;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * @return mixed
     */
    public static function getGlobal()
    {
        return Content::where('type', self::TYPE_GLOBAL)->get();
    }

    //////////////////////////////////////////////////////////////////////////////

    //
    // Below come the default values for Baum's own Nested Set implementation
    // column names.
    //
    // You may uncomment and modify the following fields at your own will, provided
    // they match *exactly* those provided in the migration.
    //
    // If you don't plan on modifying any of these you can safely remove them.
    //

    // /**
    //  * Column name which stores reference to parent's node.
    //  *
    //  * @var string
    //  */
    // protected $parentColumn = 'parent_id';

    // /**
    //  * Column name for the left index.
    //  *
    //  * @var string
    //  */
    // protected $leftColumn = 'lft';

    // /**
    //  * Column name for the right index.
    //  *
    //  * @var string
    //  */
    // protected $rightColumn = 'rgt';

    // /**
    //  * Column name for the depth field.
    //  *
    //  * @var string
    //  */
    // protected $depthColumn = 'depth';

    // /**
    //  * Column to perform the default sorting
    //  *
    //  * @var string
    //  */
    // protected $orderColumn = null;

    // /**
    // * With Baum, all NestedSet-related fields are guarded from mass-assignment
    // * by default.
    // *
    // * @var array
    // */
    // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    //
    // This is to support "scoping" which may allow to have multiple nested
    // set trees in the same database table.
    //
    // You should provide here the column names which should restrict Nested
    // Set queries. f.ex: company_id, etc.
    //

    // /**
    //  * Columns which restrict what we consider our Nested Set list
    //  *
    //  * @var array
    //  */
    // protected $scoped = array();

    //////////////////////////////////////////////////////////////////////////////

    //
    // Baum makes available two model events to application developers:
    //
    // 1. `moving`: fired *before* the a node movement operation is performed.
    //
    // 2. `moved`: fired *after* a node movement operation has been performed.
    //
    // In the same way as Eloquent's model events, returning false from the
    // `moving` event handler will halt the operation.
    //
    // Please refer the Laravel documentation for further instructions on how
    // to hook your own callbacks/observers into this events:
    // http://laravel.com/docs/5.0/eloquent#model-events


    /**
     * Set slug when setting title
     *
     * @param string $value Title value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if ($this->isChild()) {
            $this->attributes['slug'] = str_slug($this->getRoot()->title) . '-' . str_slug($value);
        } else {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    /**
     * Get the url to this content or to the content link
     *
     * @return string Url to this content
     */
    public function getUrl()
    {
        $content = $this;

        // if this is type is a link, get url to linked content
        if ($this->type == self::TYPE_LINK) {
            $content = Content::find($this->link_to_content_id);
        }

        return URL::route('contents.show', array('content' => $content->slug));
    }

    /**
     * Get the url to this content or to the content link
     *
     * @return string Url to this content
     */
    public function getEditUrl()
    {
        $content = $this;

        // if this is type is a link, get url to linked content
        if ($this->type == self::TYPE_LINK) {
            $content = Content::find($this->link_to_content_id);
        }

        return URL::route('manage.contents.edit', array('content' => $content->slug));
    }

    /**
     * Get the banner url
     *
     * @return string Url to banner image
     */
    public function getBannerUrl()
    {
        return URL::asset($this->banner);
    }

    /**
     * Gets all children for the current content
     *
     * @return array Array with contents
     */
    public function getChildren()
    {
        if (isset($this->children)) {
            return $this->children;
        }

        $this->children = $this->children()->get();

        return $this->children()->get();
    }

    /**
     * Check if the current content has children
     *
     * @return bool True if content has children, otherwise false
     */
    public function hasChildren()
    {
        return $this->getChildren()->count() > 0;
    }

    /**
     * @param $node
     *
     * @return bool
     */
    public function isActive($node)
    {
        $content = $this;

        if ($content->slug == $node->slug) {
            return true;
        }

        if ($node->link_to_content_id == $content->id) {
            return true;
        }

        if ($content->isDescendantOf($node)) {
            return true;
        }

        return false;
    }
}
