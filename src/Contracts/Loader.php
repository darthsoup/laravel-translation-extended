<?php

namespace DarthSoup\TranslationExtended\Contracts;

interface Loader
{
    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string|null  $namespace
     * @return array
     */
    public function load(string $locale, string $group, ?string $namespace = null): array;

    /**
     * Add a new namespace to the loader.
     *
     * @param  string  $namespace
     * @param  string  $hint
     * @return void
     */
    public function addNamespace(string $namespace, string $hint): void;

    /**
     * Get an array of all the registered namespaces.
     *
     * @return array
     */
    public function namespaces(): array;
}
