<?php

namespace Package\Support\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class DispatchableEmailAttribute
{
    public function __construct(private string $view, private string $subject)
    {

    }

    public function getView(array $binds)
    {
        return view($this->view, $binds);
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
}