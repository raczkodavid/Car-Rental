<?php

namespace App\Models\Data;

/**
 * Class representing a queryable collection of elements.
 * @template T
 * @implements IStorage<T>
 */
class Storage implements IStorage {
    /** @var T[] array of records */
    protected array $contents;

    /** @var IFileIO FileIO implementation to use for reading and writing records */
    protected IFileIO $io;

    public function __construct(IFileIO $io, $assoc = true) {
        $this->io = $io;
        $this->contents = (array)$this->io->load($assoc);
    }

    public function __destruct() {
        $this->io->save($this->contents);
    }

    // Add a record to the storage, return the id of the newly added record
    function add(mixed $record): int
    {
        $this->contents[] = $record;

        //  Save the updated contents
        $this->io->save($this->contents);

        return $record->id;
    }

    // Return the record with the given id, or null if not found
    function findById(int $id)
    {
        foreach ($this->contents as $record) {
            if ($record->id === $id)
                return $record;
        }
        return null;
    }


    // Return all records that satisfy the conditions
    function findAll(array $params = [])
    {
        if (empty($params))
            return $this->contents;

        return array_filter($this->contents, function($record) use ($params) {
            foreach ($params as $field => $value) {
                if (!property_exists($record, $field) || $record->$field !== $value)
                    return false;
            }
            return true;
        });
    }

    // Return all records that satisfy the condition
    function findMany(callable $condition): array
    {
        return array_filter($this->contents, $condition);
    }

    // Return the first record that satisfies the conditions
    function findOne(array $params = [])
    {
        foreach ($this->contents as $record) {
            $match = true;

            foreach ($params as $field => $value) {
                if (!property_exists($record, $field) || $record->$field !== $value) {
                    $match = false;
                    break;
                }
            }

            if ($match)
                return $record;

        }
        return null;
    }

    // Update the record with the given id
    function update(int $id, mixed $record): void
    {
        $recordToUpdate = $this->findById($id);

        var_dump($recordToUpdate);

        if (!$recordToUpdate)
            return;

        // Update only existing properties from the $record
        foreach ($record as $key => $value) {
            if (property_exists($recordToUpdate, $key))
                $recordToUpdate->$key = $value;
        }

        // Save the updated contents
        $this->io->save($this->contents);
    }

    // Update many records that satisfy a condition
    function updateMany(callable $condition, callable $updater): void
    {
        foreach ($this->contents as $record) {
            if ($condition($record))
                $updater($record);
        }

        // Save the updated contents
        $this->io->save($this->contents);
    }

    // Delete the record with the given id
    function delete(int $id): void
    {
        // find the first record with the given id
        $index = array_search($id, array_column($this->contents, 'id'));

        // if found, remove the record
        if ($index !== false)
            array_splice($this->contents, $index, 1);

        // Save the updated contents
        $this->io->save($this->contents);
    }

    // Delete many records that satisfy a condition
    function deleteMany(callable $condition): void
    {
        // filter out records that satisfy the condition
        $this->contents = array_filter($this->contents, fn($record) => !$condition($record));

        // Save the updated contents
        $this->io->save($this->contents);
    }
}
