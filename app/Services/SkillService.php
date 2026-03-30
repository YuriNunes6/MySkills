<?php

namespace App\Services;
class SkillService
{
    public function getIconByName($name)
    {
        $name = mb_strtolower($name, 'UTF-8');

        $map = [
            'fa-guitar' => ['violão', 'guitarra', 'música'],
            'fa-code' => ['program', 'php', 'javascript', 'código'],
            'fa-language' => ['inglês', 'espanhol', 'idioma'],
            'fa-paintbrush' => ['design', 'arte'],
            'fa-dumbbell' => ['academia', 'fitness'],
        ];

        foreach ($map as $icon => $keywords) {
            foreach ($keywords as $word) {
                if (str_contains($name, $word)) {
                    return $icon;
                }
            }
        }

        return 'fa-star'; // padrão
    }
}