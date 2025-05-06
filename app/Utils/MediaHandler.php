<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;

class MediaHandler
{
    /**
     * Handle media upload for a model
     *
     * @param HasMedia $model
     * @param string $collectionName
     * @param mixed $mediaInput
     * @param array $options
     * @return void
     */
    public function handleMediaUpload(HasMedia $model, string $collectionName, $mediaInput, array $options = [])
    { 

        $deleteExisting = $options['delete_existing'] ?? true;
        $single = $options['single'] ?? true; 

        if ($mediaInput) {
            if ($single) {
                $this->handleSingleMediaUpload($model, $collectionName, $mediaInput, $deleteExisting);
            } else {
                $this->handleMultipleMediaUpload($model, $collectionName, $mediaInput, $deleteExisting);
            }
        } elseif ($deleteExisting) {
            $this->deleteExistingMedia($model, $collectionName);
        }
    }

    /**
     * Handle single media upload
     *
     * @param HasMedia $model
     * @param string $collectionName
     * @param mixed $mediaInput
     * @param bool $deleteExisting
     * @return void
     */
    protected function handleSingleMediaUpload(HasMedia $model, string $collectionName, $mediaInput, bool $deleteExisting)
    { 

        $existingMedia = $model->getMedia($collectionName)->first();
        
        if (!$existingMedia || $mediaInput !== $existingMedia->file_name) {
            if ($deleteExisting && $existingMedia) {
                $existingMedia->delete();
            }
            
            $model->addMedia(storage_path('tmp/uploads/' . basename($mediaInput)))
                ->toMediaCollection($collectionName);
        }
    }

    /**
     * Handle multiple media upload
     *
     * @param HasMedia $model
     * @param string $collectionName
     * @param array $mediaInputs
     * @param bool $deleteExisting
     * @return void
     */
    protected function handleMultipleMediaUpload(HasMedia $model, string $collectionName, array $mediaInputs, bool $deleteExisting)
    {
        if ($deleteExisting) {
            $this->deleteExistingMedia($model, $collectionName);
        }

        foreach ($mediaInputs as $mediaInput) {
            $model->addMedia(storage_path('tmp/uploads/' . basename($mediaInput)))
                ->toMediaCollection($collectionName);
        }
    }

    /**
     * Delete existing media from collection
     *
     * @param HasMedia $model
     * @param string $collectionName
     * @return void
     */
    protected function deleteExistingMedia(HasMedia $model, string $collectionName)
    {
        $model->clearMediaCollection($collectionName);
    }

    /**
     * Handle CKEditor image upload
     *
     * @param Model $model
     * @param string $collectionName
     * @param array $requestData
     * @return array
     */
    public function handleCKEditorImages(Model $model, string $collectionName, array $requestData)
    {
        $model->id = $requestData['crud_id'] ?? 0;
        $model->exists = true;
        
        $media = $model->addMediaFromRequest('upload')
            ->toMediaCollection($collectionName);

        return [
            'id' => $media->id,
            'url' => $media->getUrl()
        ];
    }

    /**
     * Update media model IDs
     *
     * @param Model $model
     * @param array $mediaIds
     * @return void
     */
    public function updateMediaModelIds(Model $model, array $mediaIds)
    {
        if (!empty($mediaIds)) {
            Media::whereIn('id', $mediaIds)
                ->update(['model_id' => $model->id]);
        }
    }
} 