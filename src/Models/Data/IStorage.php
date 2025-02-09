<?php

namespace App\Models\Data;

interface IStorage
{
    function add(mixed $record): int;
    function findById(int $id);
    function findAll(array $params = []);
    function findMany(callable $condition);
    function findOne(array $params = []);
    function update(int $id, mixed $record);
    function updateMany(callable $condition, callable $updater);
    function delete(int $id);
    function deleteMany(callable $condition);

}