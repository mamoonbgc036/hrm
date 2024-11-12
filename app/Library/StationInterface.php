<?php


namespace App\Library;


use App\Http\Requests\StationRequest;

interface StationInterface
{
    public function getAll();
    public function store();
    public function edit($id);
    public function update($station);
    public function destroy($station);
}
