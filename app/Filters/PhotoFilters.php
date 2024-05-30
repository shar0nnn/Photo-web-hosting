<?php

namespace App\Filters;

use App\Models\Group;
use Illuminate\Http\Request;

class PhotoFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function date($order)
    {
        $order = in_array($order, ['desc', 'asc']) ? $order : 'desc';

        return $this->builder->orderBy('created_at', $order);
    }

    public function likes($order)
    {
        $order = in_array($order, ['desc', 'asc']) ? $order : 'desc';

        return $this->builder->withCount('usersLikes')->orderBy('users_likes_count', $order);
    }

    public function group($groupId = null)
    {
        $groupId = in_array($groupId, Group::all()->pluck('id')->toArray()) ? $groupId : null;

        if ($groupId) {
            return $this->builder->whereRelation('user', 'group_id', $groupId);
        }
    }
}
