<?php

declare(strict_types=1);

namespace App\Module\Post\Models;

use Carbon\Carbon;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Tag extends Model
{
    use HasFactory;

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
}
