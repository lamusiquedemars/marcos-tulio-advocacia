<?php

namespace App\Modules\Assistant\Contracts;

use App\Modules\ContactForm\Data\ContactMessage;

interface AssistantProvider
{
    public function qualify(array $input): ContactMessage;
}
