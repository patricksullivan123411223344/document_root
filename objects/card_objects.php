<?php

// Class representing a therapy specialty
class Specialty {
    public string $title;
    protected string $description;
    protected string $sessionType;
    protected bool $acceptingClients;

    public function __construct(
        string $title,
        string $description,
        string $sessionType = "In-person & Virtual",
        bool $acceptingClients = true
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->sessionType = $sessionType;
        $this->acceptingClients = $acceptingClients;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getSessionType(): string {
        return $this->sessionType;
    }

    public function getAvailabilityMessage(): string {
        if ($this->acceptingClients) {
            return "Currently accepting new clients";
        }

        return "Please contact for current availability";
    }
}

// Respective specialties to fill 3 cards
$specialtyOne = new Specialty(
    "Anxiety and stress",
    "Tools to manage overwhelm, worry cycles, and regain calm",
    "Virtual & In-person",
    true
);

$specialtyTwo = new Specialty(
    "Life transitions",
    "Support through change in relationships, careers, identity, and more",
    "Virtual only",
    false
);

$specialtyThree = new Specialty(
    "Trauma-informed care",
    "A grounded, compassionate approach that prioritizes safety and pacing",
    "Virtual and In-person",
    true
);

// All three specialtiy objects inside an array for foreach
$specialties = [
    $specialtyOne,
    $specialtyTwo,
    $specialtyThree
];

?>