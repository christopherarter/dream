<?php

namespace Dream\Enums;

enum TextEntityType: string
{
    case PERSON = 'PERSON';
    case LOCATION = 'LOCATION';
    case ORGANIZATION = 'ORGANIZATION';
    case EVENT = 'EVENT';
    case TITLE = 'TITLE';
    case DATE = 'DATE';
    case OTHER = 'OTHER';
    case QUANTITY = 'QUANTITY';
    case COMMERCIAL_ITEM = 'COMMERCIAL_ITEM';
}
