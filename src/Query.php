<?php

namespace Katsana\Sdk;

class Query
{
    /**
     * Set requested page.
     *
     * @var int|null
     */
    protected $page;

    /**
     * Includes data.
     *
     * @var array
     */
    protected $includes = [];

    /**
     * Excludes data.
     *
     * @var array
     */
    protected $excludes = [];

    /**
     * Custom data.
     *
     * @var array
     */
    protected $customs = [];

    /**
     * Make Query builder.
     *
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * Set includes data.
     *
     * @param array $includes
     *
     * @return $this
     */
    public function includes($includes)
    {
        $includes = is_array($includes) ? $includes : func_get_args();

        $this->includes = $includes;

        return $this;
    }

    /**
     * Set excludes data.
     *
     * @param array $excludes
     *
     * @return $this
     */
    public function excludes($excludes)
    {
        $excludes = is_array($excludes) ? $excludes : func_get_args();

        $this->excludes = $excludes;

        return $this;
    }

    /**
     * Set custom data.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function with($name, $value)
    {
        $this->customs[$name] = $value;

        return $this;
    }

    /**
     * Set current page.
     *
     * @param int|null $page
     *
     * @return $this
     */
    public function forPage($page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Build query string.
     *
     * @param callable|null $callback
     *
     * @return array
     */
    public function build(callable $callback = null)
    {
        $data = [
            'includes' => implode(',', $this->includes),
            'excludes' => implode(',', $this->excludes),
        ];

        if (is_int($this->page) && $this->page > 0) {
            $data['page'] = $this->page;
        }

        if (is_null($callback)) {
            $callback = function ($data, $customs) {
                return array_merge($customs, $data);
            };
        }

        return call_user_func($callback, $data, $this->customs);
    }
}
