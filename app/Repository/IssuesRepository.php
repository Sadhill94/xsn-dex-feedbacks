<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\File;
use App\Models\Issue;
use App\Models\Status;
use Exception;

class IssuesRepository
{

    public function getById($id)
    {
        return Issue::with(['category', 'status', 'files'])
            ->get()
            ->find($id);
    }

    public function getCategories()
    {
        return Category::orderBy('order')->get();
    }
    public function findCategoryByName($name)
    {
        return Category::where('name', '=', $name)->first();
    }

    public function getStatuses()
    {
        return Status::orderBy('order')->get();
    }
    public function findStatusByName($name)
    {
        return Status::where('name', '=', $name)->first();
    }

    public function getAll()
    {
         return Issue::orderBy('created_at', 'DESC')
             ->with(['category', 'status', 'files'])
             ->get();
    }

    public function getIssuesWithCategoryAndStatusWhereNotIn($property, $arr)
    {
        return Issue::whereNotIn($property, $arr)
            ->with(['category', 'status', 'files'])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function create($data)
    {
        $issue = new Issue();
        $issue->description = $data['description'];
        $issue->os = $data['os'];
        $issue->version = $data['version'];
        $issue->os_distribution = $data['os_distribution'] ?? null;
        $issue->steps_to_reproduce = $data['steps_to_reproduce'];
        $issue->user_discord_id = $data['user_discord_id'];
        $issue->category_id = $data['category_id'];
        $issue->extra_infos = $data['extra_infos'] ?? null;
        $issue->status_id = $data['status_id'];

        $issue->save();

        return Issue::find($issue->id);
    }

    public function edit($data)
    {
        $issue = Issue::find($data['id']);

        $issue->description = $data['description'];
        $issue->os = $data['os'];

        $issue->os_distribution = $data['os_distribution'] ?? null;
        $issue->version = $data['version'];

        $issue->steps_to_reproduce = $data['steps_to_reproduce'];
        $issue->user_discord_id = $data['user_discord_id'];
        $issue->category_id = $data['category_id'];
        $issue->status_id = $data['status_id'];

        $issue->github_link = $data['github_link'] ?? null;
        $issue->assignee = $data['assignee'] ?? null;
        $issue->extra_infos = $data['extra_infos'] ?? null;

        $issue->save();

        return $issue;
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

    public function createFile($data)
    {
        $fileModel = new File();
        $fileModel->name = $data['fileName'];
        $fileModel->file_path = '/storage/'.$data['filePath'];
        $fileModel->display_name = $data['display_name'];
        $fileModel->extension = $data['extension'];
        $fileModel->size = $data['size'];
        $fileModel->issue_id = $data['issueId'];

        $fileModel->save();

        return File::find($fileModel->id);
    }

    public function getFileById($id)
    {
        return File::findOrFail($id);
    }

    public function deleteFile($id)
    {
        $issue = File::findOrFail($id);

        try {
            $issue->deleteOrFail();
            return 0;
        } catch(Exception $ex) {
            return 1;
        }
    }
}
