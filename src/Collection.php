<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim-Psr7/blob/master/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Psr7;

use ArrayIterator;
use Slim\Psr7\Interfaces\CollectionInterface;

class Collection implements CollectionInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $items Pre-populate collection with this key-value array
     */
    public function __construct(array $items = [])
    {
        $this->replace($items);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $items): void
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function keys(): array
    {
        return array_keys($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $key): void
    {
        unset($this->data[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $this->data = [];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($key, $value): void
    {
        $this->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($key): void
    {
        $this->remove($key);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new ArrayIterator($this->data);
    }
}
