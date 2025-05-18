<?php

namespace App\Services;

use App\Models\VoteCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class VoteCategoryService
{
    public function list(): Collection
    {
        return VoteCategory::all();
    }

    public function create(Request $data): VoteCategory
    {
        $payload = $data->only(['name']);

        return VoteCategory::create($payload);
    }

    public function update(Request $data, int $id): VoteCategory
    {
        $category = VoteCategory::findOrFail($id);

        $payload = $data->only(['name']);

        $category->update($payload);

        return $category;
    }

    public function delete(int $id): void
    {
        $category = VoteCategory::findOrFail($id);
        $category->delete();
    }
}
