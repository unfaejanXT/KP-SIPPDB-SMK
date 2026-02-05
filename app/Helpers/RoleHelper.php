<?php

namespace App\Helpers;

class RoleHelper
{
    /**
     * Format role name untuk ditampilkan
     *
     * @param string $roleName
     * @return string
     */
    public static function formatRoleName(string $roleName): string
    {
        $roleDisplayNames = [
            'operator_sekolah' => 'Operator Sekolah',
            'staff_ppdb' => 'Staff PPDB',
            'kepala_sekolah' => 'Kepala Sekolah',
            'calon_siswa' => 'Calon Siswa',
        ];

        return $roleDisplayNames[$roleName] ?? ucfirst(str_replace('_', ' ', $roleName));
    }
}
