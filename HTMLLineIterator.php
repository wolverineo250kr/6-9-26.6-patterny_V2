<?php

class HTMLLineIterator implements Iterator
{
    private $lines;
    private $position;
    private $patterns = [
        '/<title>(.*?)<\/title>/',
        '/<meta\s+name="keywords"\s+content="([^"]+)">/',
        '/<meta\s+name="description"\s+content="([^"]+)">/'
    ];

    public function __construct($html)
    {
        $this->lines = explode(PHP_EOL, $html);
        $this->position = 0;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function getPatterns()
    {
        return $this->patterns;
    }

    public function current()
    {
        $position = $this->lines[$this->position];

        foreach ($this->getPatterns() as $pattern) {
            preg_match($pattern, $position, $matches);
            if (isset($matches[1])) {
                return "";
            }
        }

        return $position;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return isset($this->lines[$this->position]);
    }
}
