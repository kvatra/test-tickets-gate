<?php

declare(strict_types=1);

namespace App\Modules\Show\DTO;

class ShowEventDTO
{
    private int $id;
    private string $date;

    public function __construct(int $id, string $date)
    {
        $this->id = $id;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }
}
