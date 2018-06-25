<?php namespace PHPBook\Console;

class Resource {
    
    private $name;
    
    private $notes;

    private $controller;

    private $arguments;
	
	public function setName(String $name): Resource {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?String {
        return $this->name;
    }

    public function setNotes(String $notes): Resource {
        $this->notes = $notes;
        return $this;
    }

    public function getNotes(): ?String {
        return $this->notes;
    }

    public function setController(String $controller, String $method): Resource {
        $this->controller = [$controller, $method];
        return $this;
    }

    public function getController(): Array {
        return $this->controller;
    }

    public function setArguments(Array $arguments): Resource {
        $this->arguments = $arguments;
        return $this;
    }

    public function getArguments(): ?Array {
        return $this->arguments;
    }

}