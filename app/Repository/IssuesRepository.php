<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Status;
use Exception;

class IssuesRepository
{

    public function getCategories()
    {
        return Category::all();
    }

    public function getStatuses()
    {
        return Status::all();
    }
    public function findStatusByName($name)
    {
        return Status::where('name', '=', $name)->first();
    }

    public function getAll()
    {
         return Issue::orderBy('created_at', 'DESC')->with(['category', 'status'])->get();
    }

    public function create($data)
    {
        $issue = new Issue();
        $issue->description = $data['description'];
        $issue->os = $data['os'];
        $issue->version = $data['version'];
        $issue->steps_to_reproduce = $data['steps_to_reproduce'];
        $issue->user_discord_id = $data['user_discord_id'];
        $issue->category_id = $data['category_id'];
        $issue->extra_infos = $data['extra_infos'] ?? null;
        $issue->status_id = $data['status_id'];
        $issue->save();

        return Issue::find($issue->id);
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);

        try {
            $issue->deleteOrFail();
            return 0;
        } catch(Exception $ex) {
            return 1;
        }
    }
}
