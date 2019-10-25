<?php

namespace Texlab\Route;

interface DispatcherInterface
{
    public function decodeUri(string $uri): array;

    public function encodeUri(string $handler, array $vars = []): string;
}