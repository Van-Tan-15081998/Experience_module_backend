<?php

namespace App\Http\Controllers\Base\Model;

class LogoModel
{
    private string $name;
    private string $src;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @param string $src
     */
    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}
