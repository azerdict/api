<?php

namespace App\Dictionary;

class Result
{
    private $data = [];

    private $dictionaries = [];

    public function addData(string $name, array $data) : void
    {
        $this->data[$name][] = $data;

        if (!in_array($name, $this->dictionaries)) {
            $this->dictionaries[] = $name;
        }
    }

    /**
     * @return array
     */
    public function getResult() : array
    {
        $totalCount = 0;
        $meta = [];

        foreach ($this->dictionaries as $dictionary) {
            $meta[$dictionary]['count'] = count($this->data[$dictionary]);
            $totalCount += $meta[$dictionary]['count'];
        }

        $meta = array_merge(['all' => ['count' => $totalCount]], $meta);

        return [
            'meta' => $meta,
            'data' => $this->data,
        ];
    }

    public function hasResult() : bool
    {
        return !empty($this->data);
    }
}
