<?php

namespace App\Enum;

enum EventType: string
{
    case POST_CREATED = 'blog.post.new';
    case POST_UPDATED = 'blog.post.updated';
}
