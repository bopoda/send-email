<?php

namespace Core;

use Core\Exception\NotFoundException;

class View
{
    /**
     * @param string $viewName
     * @param array $data
     * @return View
     */
    public static function create($viewName, array $data = array())
    {
        return new self ($viewName, $data);
    }

    /**
     * @param string $viewName
     * @param array $data
     */
    public function __construct($viewName, array $data = array())
    {
        $this->viewName = $viewName;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function render()
    {
        ob_start();
        require ROOT_DIR.'/app/view/'.$this->viewName;
        $content = ob_get_clean();

        return $content;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws NotFoundException
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw new NotFoundException(
            "Accessing unknown view data variable '{$name}' withing '{$this->viewName}'"
        );
    }
}