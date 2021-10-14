<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Collections\TaskCollection;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class CSVTaskRepository implements TaskRepository
{
    private string $path = 'storage/AssignmentData.csv';
    private Reader $csvreader;

    public function readFromFile(): TaskCollection
    {
        $this->csvreader = Reader::createFromPath($this->path, 'r');
        $result = $this->csvreader->getRecords();
        $collection = [];
        foreach ($result as $item)
        {
            array_push($collection, new Assignment($item[0]));
        }
        return new TaskCollection($collection);
    }

    public function addToFile(Assignment $task): void
    {
        $csvwriter = Writer::createFromPath($this->path, 'a');
        $csvwriter->insertOne((array)$task);
    }

    public function delete(Assignment $task): void
    {
        $this->csvreader = Reader::createFromPath($this->path, 'r');
        $result = $this->csvreader->getRecords();
        $collection = [];
        foreach ($result as $item)
        {
            array_push($collection, new Assignment($item[0]));
        }

        $collectionToTasks = [];
        foreach ($collection as $item)
        {
            array_push($collectionToTasks, $item->getTask());
        }

        $key = array_search($task->getTask(), $collectionToTasks);
        array_splice($collectionToTasks, $key, 1);

        $csvwriter = Writer::createFromPath($this->path, 'w');
        foreach ($collectionToTasks as $task)
        {
            $csvwriter->insertOne((array)$task);
        }
    }
}