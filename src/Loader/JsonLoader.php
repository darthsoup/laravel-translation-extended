<?php

namespace DarthSoup\TranslationExtended\Loader;

use DarthSoup\TranslationExtended\Exceptions\ResourceException;

class JsonLoader extends FileLoader
{
    /**
     * Load a local namespaced translation group for overrides.
     *
     * @param array $lines
     * @param string $locale
     * @param string $group
     * @param string $namespace
     * @return array
     */
    protected function loadNamespaceOverrides(array $lines, string $locale, string $group, string $namespace): array
    {
        $file = "{$this->path}/vendor/{$namespace}/{$locale}/{$group}.json";

        if ($this->files->exists($file)) {
            return array_replace_recursive($lines, $this->loadJson($this->files->get($file)));
        }

        return $lines;
    }

    /**
     * Load a locale from a given path.
     *
     * @param string $path
     * @param string $locale
     * @param string $group
     * @return array
     */
    protected function loadPath(string $path, string $locale, string $group): array
    {
        if ($this->files->exists($full = "{$path}/{$locale}/{$group}.json")) {
            return $this->loadJson($this->files->get($full));
        }

        return [];
    }

    /**
     * Decodes and validates the JSON Data
     *
     * @param string $data
     * @return mixed
     * @throws ResourceException
     */
    protected function loadJson(string $data)
    {
        try {
            return json_decode($data, true, $depth = 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new ResourceException('JSON Parsing error: ' . $e->getMessage());
        }
    }
}
