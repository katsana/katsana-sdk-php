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
     * Per page limit.
     *
     * @var int|null
     */
    protected $perPage;

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
     * Set includes data.
     *
     * @param array $includes
     *
     * @return $this
     */
    protected function includes($includes)
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
    protected function excludes($excludes)
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
    protected function with(string $name, $value)
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
    protected function forPage(?int $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Set per page limit.
     *
     * @param int|null $perPage
     *
     * @return $this
     */
    protected function take(?int $perPage = null)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Build query string.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->build(function ($data, $customs) {
            return array_merge($customs, $data);
        });
    }

    /**
     * Build query string.
     *
     * @param callable $callback
     *
     * @return array
     */
    public function build(callable $callback): array
    {
        $data = [];

        foreach (['includes', 'excludes'] as $key) {
            if (! empty($this->{$key})) {
                $data[$key] = implode(',', $this->{$key});
            }
        }

        if (is_int($this->page) && $this->page > 0) {
            $data['page'] = $this->page;

            if (is_int($this->perPage) && $this->perPage > 5) {
                $data['per_page'] = $this->perPage;
            }
        }

        return call_user_func($callback, $data, $this->customs);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->$method(...$parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $parameters)
    {
        return (new static())->$method(...$parameters);
    }
}
