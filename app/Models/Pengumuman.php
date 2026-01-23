<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'views',
        'is_pinned',
        'target_roles',
        'status',
    ];

    protected $casts = [
        'target_roles' => 'array',
        'is_pinned' => 'boolean',
        'views' => 'integer',
    ];

    /**
     * Scope a query to only include announcements visible to a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\User|null  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $user = null)
    {
        return $query->where('status', 'published')
            ->where(function ($q) use ($user) {
                // Always show public announcements (null or empty array or explicitly 'public')
                $q->whereNull('target_roles')
                  ->orWhereJsonLength('target_roles', 0)
                  ->orWhereJsonContains('target_roles', 'public');

                if ($user) {
                    // Start a nested OR group for user roles
                    $q->orWhere(function ($subQ) use ($user) {
                        // Check if any of user's roles are in target_roles
                        // Note: SQLite/MySQL differences exist for JSON overlaps, 
                        // but loops of orWhereJsonContains are safest for cross-db compatibility in simple arrays
                        $roles = $user->getRoleNames(); // Spatie returns Collection
                        foreach ($roles as $role) {
                            $subQ->orWhereJsonContains('target_roles', $role);
                        }
                    });
                }
            });
    }
}
