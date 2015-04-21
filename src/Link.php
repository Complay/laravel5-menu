<?php namespace Kiwina\Menu;

class Link
{
    /**
     * Path Information.
     *
     * @var array
     */
    protected $path = array();

    /**
     * Explicit href for the link.
     *
     * @var string
     */
    protected $href;

    /**
     * Link attributes.
     *
     * @var array
     */
    public $attributes = array();

    /**
     * Creates a hyper link instance.
     *
     * @param array $path
     */
    public function __construct($path = array())
    {
        $this->path = $path;
    }

    /**
     * Make the anchor active.
     *
     * @return Kiwina\Menu\Link
     */
    public function active()
    {
        $this->attributes['class'] = Builder::formatGroupClass(array('class' => 'active'), $this->attributes);
        return $this;
    }

    /**
     * Set Anchor's href property.
     *
     * @return Kiwina\Menu\Link
     */
    public function href($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * Make the url secure.
     *
     * @return Kiwina\Menu\Item
     */
    public function secure()
    {
        $this->path['secure'] = true;
        return $this;
    }

    /**
     * Add attributes to the link.
     *
     * @param  mixed
     *
     * @return string|Kiwina\Menu\Link
     */
    public function attr()
    {
        $args = func_get_args();
        if (isset($args[0]) && is_array($args[0])) {
            $this->attributes = array_merge($this->attributes, $args[0]);
            return $this;
        } elseif (isset($args[0]) && isset($args[1])) {
            $this->attributes[$args[0]] = $args[1];
            return $this;
        } elseif (isset($args[0])) {
            return isset($this->attributes[$args[0]]) ? $this->attributes[$args[0]] : null;
        }

        return $this->attributes;
    }

    /**
     * Check for a method of the same name if the attribute doesn't exist.
     *
     * @param  string
     */
    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }

        return $this->attr($prop);
    }
}
