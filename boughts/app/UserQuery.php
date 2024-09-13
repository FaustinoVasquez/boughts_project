<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class UserQuery extends Builder
{
    use FiltersQueries;

    protected function filterRules(): array
    {
        return $rules = [
            'deleted' => 'in:all,active,inactive',
            'role' => 'in:admin,user',
        ];
    }

    public function filterByDeleted($deleted)
    {
        switch ($deleted) {
            case 'all':
                return $this->withTrashed();
                break;
            case 'active':
                break;
            case 'inactive':
                $this->onlyTrashed();
                break;
        }

        // return ($deleted == 'inactive')? $this->onlyTrashed(): $this->withTrashed();
//      return $this->where('Deleted', $deleted == 'inactive');
    }
}
