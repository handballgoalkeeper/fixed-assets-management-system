<?php

namespace App\Exceptions;

use Exception;

class EntityNotFoundException extends Exception
{
    protected string $entityName;
    protected ?int $entityId;

    /**
     * @param string $entityName
     * @param int|null $entityId
     */
    public function __construct(string $entityName, int $entityId = Null)
    {
        parent::__construct();
        $this->entityId = $entityId;
        $this->entityName = $entityName;
        $this->initMessage();

    }

    protected function initMessage(): void
    {
        if (is_null($this->entityId)) {
            $this->message = "No entries found for entity '$this->entityName'!";
        } else {
            $this->message = "Entity '$this->entityName' with id '$this->entityId' is not found!";
        }
    }
}
