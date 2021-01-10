<?php

declare(strict_types=1);

namespace App\Modules\ShowEvents\DTO;

class EventPlaceDTO
{
    private int $id;
    private array $params;

    public function __construct(int $id, array $params)
    {
        $this->id = $id;
        $this->params = $params;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParams()
    {
        return $this->params;
    }
}
