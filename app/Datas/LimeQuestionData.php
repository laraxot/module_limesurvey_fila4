<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Datas;

use Livewire\Attributes\Computed;
use Modules\Limesurvey\Models\LimeQuestion;
use Spatie\LaravelData\Data;

class LimeQuestionData extends Data
{
    public ?LimeQuestion $parent;

    public ?string $mandatory;

    #[Computed]
    public string $parent_mandatory;

    public function __construct(
    ) {
        $this->parent_mandatory = $this->parent->mandatory ?? '';
    }
}
