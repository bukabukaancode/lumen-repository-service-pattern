<?php

namespace App\Services;

use App\Models\Sample;
use App\Repositories\SampleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SampleService
{
    /**
     * @var $sampleRepository
     */
    protected $sampleRepository;

    /**
     * SampleService constructor.
     *
     * @param SampleRepository $sampleRepository
     */
    public function __construct(SampleRepository $sampleRepository)
    {
        $this->sampleRepository = $sampleRepository;
    }

    /**
     * Delete sample by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $sample = $this->sampleRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete sample data');
        }

        DB::commit();

        return $sample;

    }

    /**
     * Get all sample.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->sampleRepository->getAll();
    }

    /**
     * Get sample by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->sampleRepository->getById($id);
    }

    /**
     * Update sample data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateSample($data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $sample = $this->sampleRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update sample data');
        }

        DB::commit();

        return $sample;

    }

    /**
     * Validate sample data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveSampleData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->sampleRepository->save($data);

        return $result;
    }

}