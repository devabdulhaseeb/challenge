<?php

namespace App\Services;

class GroupByOwnersService
{
    public function groupByOwners(array $files)
    {
        $result = [];

        foreach ($files as $file => $owner) {
            if (isset($result[$owner])) {
                $result[$owner][] = $file;
            } else {
                $result[$owner] = [$file];
            }
        }

        return $result;
    }
}
