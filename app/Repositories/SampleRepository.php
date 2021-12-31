<?php

namespace App\Repositories;

use App\Models\Sample;

class SampleRepository
{
    /**
     * @var sample
     */
    protected $sample;

    /**
     * SampleRepository constructor.
     *
     * @param Sample $sample
     */
    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    /**
     * Get all samples.
     *
     * @return Sample $sample
     */
    public function getAll()
    {
        return $this->sample->get();
    }

    /**
     * Get sample by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->sample
            ->where('id', $id)
            ->get();
    }

    /**
     * Save sample
     *
     * @param $data
     * @return sample
     */
    public function save($data)
    {
        $sample = new $this->sample;

        $sample->title = $data['title'];
        $sample->description = $data['description'];

        $sample->save();

        return $sample->fresh();
    }

    /**
     * Update sample
     *
     * @param $data
     * @return sample
     */
    public function update($data, $id)
    {
        
        $sample = $this->sample->find($id);

        $sample->title = $data['title'];
        $sample->description = $data['description'];

        $sample->update();

        return $sample;
    }

    /**
     * Update sample
     *
     * @param $data
     * @return sample
     */
    public function delete($id)
    {
        
        $sample = $this->sample->find($id);
        $sample->delete();

        return $sample;
    }

}