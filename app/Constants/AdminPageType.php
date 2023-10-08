<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class AdminPageType extends Enum
{
    public const MASTER_FAVORITE_APP_BOOK_LIST = [80000001];
    public const MASTER_FAVORITE_APP_BOOK_DETAIL = [80000002];

    public const MASTER_KNOWLEDGE_ARTICLE_SUBJECT_LIST = [80000003];
    public const MASTER_KNOWLEDGE_ARTICLE_SUBJECT_DETAIL = [80000004];

    public const MASTER_KNOWLEDGE_ARTICLE_LIST = [80000005];
    public const MASTER_KNOWLEDGE_ARTICLE_DETAIL = [80000006];

    public const MASTER_KNOWLEDGE_ARTICLE_CONTENT_UNIT_LIST = [80000007];
    public const MASTER_KNOWLEDGE_ARTICLE_CONTENT_UNIT_DETAIL = [80000008];

    public const MASTER_KNOWLEDGE_ARTICLE_MASTER_SEARCH = [80000009];

    public function getId(): int
    {
        return $this->value[0];
    }
}
