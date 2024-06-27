<?php

namespace Omnipay\Yoomoney\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class NotificationResponse extends AbstractResponse implements RedirectResponseInterface
{
    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';

    public function isSuccessful()
    {
        return $this->getStatus() === self::STATUS_COMPLETED;
    }

    public function getTransactionReference()
    {
        return $this->getDataItem('operation_id');
    }

    public function getTransactionId()
    {
        return $this->getDataItem('label');
    }

    public function getStatus()
    {
        if (!$this->isValid()) {
            return self::STATUS_FAILED;
        }

        if ($this->getUnaccepted() || $this->getCodePro()) {
            return self::STATUS_PENDING;
        }

        return self::STATUS_COMPLETED;
    }

    public function getMessage()
    {
        if (!$this->isValid()) {
            return NotificationRequest::HASH_ERROR; // Hash mismatch
        }

        if ($this->getUnaccepted()) {
            return NotificationRequest::UNACCEPTED; // Transfer not yet credited
        }

        if ($this->getCodePro()) {
            return NotificationRequest::PROTECTED; // Transfer is protected by a code
        }

        return null;
    }

    public function isValid()
    {
        return $this->getSignature() === $this->buildSignature();
    }

    private function getSignature()
    {
        return $this->getDataItem('sha1_hash');
    }

    private function buildSignature()
    {
        $params = [
            $this->getDataItem('notification_type'),
            $this->getDataItem('operation_id'),
            $this->getDataItem('amount'),
            $this->getDataItem('currency'),
            $this->getDataItem('datetime'),
            $this->getDataItem('sender'),
            $this->getDataItem('codepro'),
            $this->getSecret(),
            $this->getDataItem('label', ''),
        ];

        return hash('sha1', implode('&', $params));
    }

    protected function getDataItem($name, $default = null)
    {
        $data = $this->getData();
        return $data[$name] ?? $default;
    }

    public function getSecret()
    {
        return $this->getRequest()->getSecret();
    }

    public function getUnaccepted()
    {
        return filter_var($this->getDataItem('unaccepted'), FILTER_VALIDATE_BOOLEAN);
    }

    public function getCodePro()
    {
        return filter_var($this->getDataItem('codepro'), FILTER_VALIDATE_BOOLEAN);
    }

    public function getCurrency()
    {
        return 'RUB';
    }

    public function getNotificationType()
    {
        return $this->getDataItem('notification_type');
    }

    public function getSender()
    {
        return $this->getDataItem('sender');
    }

    public function getDatetime()
    {
        return $this->getDataItem('datetime');
    }

    public function getTestMode()
    {
        return filter_var($this->getDataItem('test_notification', false), FILTER_VALIDATE_BOOLEAN);
    }

    public function getLabel()
    {
        return $this->getDataItem('label');
    }

    public function getSha1Hash()
    {
        return $this->getDataItem('sha1_hash');
    }

    public function getFirstname()
    {
        return $this->getDataItem('firstname');
    }

    public function getLastName()
    {
        return $this->getDataItem('lastname');
    }

    public function getFathersname()
    {
        return $this->getDataItem('fathersname');
    }

    public function getEmail()
    {
        return $this->getDataItem('email');
    }

    public function getPhone()
    {
        return $this->getDataItem('phone');
    }

    public function getCity()
    {
        return $this->getDataItem('city');
    }

    public function getStreet()
    {
        return $this->getDataItem('street');
    }

    public function getBuilding()
    {
        return $this->getDataItem('building');
    }

    public function getSuite()
    {
        return $this->getDataItem('suite');
    }

    public function getFlat()
    {
        return $this->getDataItem('flat');
    }

    public function getZip()
    {
        return $this->getDataItem('zip');
    }
}
