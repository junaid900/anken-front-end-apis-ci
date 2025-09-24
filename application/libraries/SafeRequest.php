<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SafeRequest {
    private $data;

    public function __construct(array $data = []) {
        $this->data = $data;
    }

    public function __get($key) {
        return $this->data[$key] ?? null;
    }

    public function __isset($key) {
        return isset($this->data[$key]);
    }

    public function toArray() {
        return $this->data;
    }
}
