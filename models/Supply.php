<?php

class Supply {
    public $name;
    public $quantity;
    public $unitCost;
    public $orderDate;
    public $expirationDate;
    public $status;
    public $createdAt;

    public function __construct($data) {
        $this->name = $data['name'] ?? '';
        
        $rawQuantity = trim((string) ($data['quantity'] ?? ''));
        $validatedQuantity = filter_var(
            $rawQuantity,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );
        $this->quantity = $validatedQuantity !== false ? $validatedQuantity : 0;
        
        $this->unitCost = (float) ($data['unitCost'] ?? 0);
        $this->orderDate = $data['orderDate'] ?? '';
        $this->expirationDate = $data['expirationDate'] ?? '';
        $this->status = $this->calculateStatus();
        $this->createdAt = new MongoDB\BSON\UTCDateTime();
    }

    public function isValidQuantity() {
        return $this->quantity > 0;
    }

    public function areDatesValid() {
        if (empty($this->orderDate) || empty($this->expirationDate)) {
            return false;
        }
        $order = new DateTime($this->orderDate);
        $expiration = new DateTime($this->expirationDate);
        return $expiration >= $order;
    }

    public function calculateStatus() {
        if (empty($this->expirationDate)) {
            return 'Pending';
        }

        $currentDate = new DateTime();
        $expiration = new DateTime($this->expirationDate);
        $interval = $currentDate->diff($expiration);

        if ($expiration < $currentDate) {
            return 'Expired';
        } elseif ($interval->days <= 30 && $interval->invert == 0) {
            return 'NearExpiration';
        } else {
            return 'Current';
        }
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'unitCost' => $this->unitCost,
            'orderDate' => $this->orderDate,
            'expirationDate' => $this->expirationDate,
            'status' => $this->status,
            'createdAt' => $this->createdAt
        ];
    }
}