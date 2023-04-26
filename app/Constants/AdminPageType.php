<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class AdminPageType extends Enum
{
    public const MASTER_FAVORITE_APP_BOOK_LIST = [80000001];
    public const MASTER_FAVORITE_APP_BOOK_DETAIL = [80000002];

    public const MASTER_KNOWLEDGE_ARTICLE_SUBJECT_LIST = [80000003];
    public const MASTER_KNOWLEDGE_ARTICLE_SUBJECT_DETAIL = [80000004];

    public function getId(): int
    {
        return $this->value[0];
    }
}
