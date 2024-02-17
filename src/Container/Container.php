<?php declare(strict_types=1);

namespace App\Container;

use Psr\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private mixed $services = [];
    private mixed $factories = [];
    private mixed $arguments = [];
    private ?string $currentServiceId = null;


    public function get($id)
    {
        if (!$this->has($id)) {
            throw new class("Service not found: $id") extends \Exception implements NotFoundExceptionInterface {};
        }

        if (!isset($this->services[$id]) && isset($this->factories[$id])) {
            $this->services[$id] = $this->factories[$id]($this->arguments[$id] ?? []);
        }

        return $this->services[$id];
    }

    public function has($id): bool
    {
        return isset($this->services[$id]) || isset($this->factories[$id]);
    }

    public function add(string $id, string $concrete = null): self
    {
        if ($this->has($id)) {
            throw new class("Service already exists: $id") extends \Exception implements ContainerExceptionInterface {};
        }
        $this->currentServiceId = $id;
        $concrete = $concrete ?? $id;
        $this->factories[$id] = fn() => new $concrete(...array_map(fn($arg) => $this->get($arg), $this->arguments[$id] ?? []));
        return $this;
    }
    public function addArgument(string $argument): self
    {
        if ($this->currentServiceId === null) {
            throw new \LogicException('No service is being defined. Call add() before calling addArgument().');
        }
        $this->arguments[$this->currentServiceId][] = $argument;
        return $this;
    }
}