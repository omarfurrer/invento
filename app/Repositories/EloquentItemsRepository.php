<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Models\Item;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EloquentItemsRepository extends EloquentAbstractRepository implements ItemsRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Item';
    }

    /**
     * Create an item.
     * 
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields = null)
    {
        if (isset($fields['image'])) {
            $image = $fields['image'];
            $imagePath = $image->store('images/items', 'public');
            $this->_resizeImage($imagePath);
            $fields['image_path'] = $imagePath;
        }
        return parent::create($fields);
    }

    /**
     * Update an item.
     *
     * @param Integer $id
     * @param array $fields
     * @return mixed
     */
    public function update($id, array $fields = [])
    {

        if (isset($fields['image'])) {

            $model = $this->getById($id);

            if (!$this->_deleteImage($model)) {
                return false;
            }
            $image = $fields['image'];
            $imagePath = $image->store('images/items', 'public');
            $this->_resizeImage($imagePath);
            $fields['image_path'] = $imagePath;
        }

        return parent::update($id, $fields);
    }

    /**
     * Get items that have been approved by an admin.
     * 
     * @return Collection
     */
    public function getInitiallyApproved()
    {
        return Item::where('is_initially_approved', true)->get();
    }

    /**
     * Get items that need to be approved by an admin.
     * 
     * @return Collection
     */
    public function getNeedsInitialApproval()
    {
        return Item::where('is_initially_approved', false)->get();
    }

    /**
     * Set initial approval for an item.
     * 
     * @param Integer $id
     * @return Item
     */
    public function approveInitially($id)
    {
        $item = $this->getById($id);
        $item->is_initially_approved = true;
        $item->initially_approved_at = Carbon::now();
        $item->save();
        return $item;
    }

    /**
     * Get items where minimum quantity threshold has exceeded.
     * 
     * @return Collection
     */
    public function getLowQuantity()
    {
        return Item::whereColumn('minimum_quantity', '>', 'current_quantity')->get();
    }

    /**
     * Delete an item's image.
     * 
     * @param Item $item
     * @return boolean
     */
    protected function _deleteImage(Item $item)
    {
        if ($item->image_path != NULL) {
            $deleted = Storage::disk('public')->delete($item->image_path);
            if (!$deleted) {
                return $deleted;
            }
        }
        return true;
    }

    /**
     * Delete an item.
     * 
     * @param Integer $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->getById($id);

        if (!$this->_deleteImage($model)) {
            return false;
        }

        return parent::delete($model);
    }

    /**
     * Resize image to reduce size and proper display.
     * 
     * @param string $imagePath
     * @param string $height
     * @param string $width
     */
    protected function _resizeImage($imagePath, $height = 150, $width = 150)
    {
        Image::make(storage_path('app/public/' . $imagePath))->resize($width, $height)->save(storage_path('app/public/' . $imagePath));
    }

    /**
     * Get all items expiring within 3 months.
     *  
     * @return Collection
     */
    public function getExpiringSoon()
    {
        return Item::join('item_batches', 'items.id', '=', 'item_batches.item_id')
                        ->join('measurement_units', 'items.unit_id', '=', 'measurement_units.id')
                        ->where('item_batches.expiry_date', '<', Carbon::now()->addMonths(3))
                        ->where('item_batches.expiry_date', '>', Carbon::now())
                        ->where('item_batches.current_quantity', '!=', 0)
                        ->select('items.description', 'item_batches.current_quantity', 'measurement_units.short_name', 'item_batches.expiry_date')
                        ->get();
    }

    /**
     * Get all items which have expired.
     *  
     * @return Collection
     */
    public function getExpired()
    {
        return Item::join('item_batches', 'items.id', '=', 'item_batches.item_id')
                        ->join('measurement_units', 'items.unit_id', '=', 'measurement_units.id')
                        ->where('item_batches.expiry_date', '<', Carbon::now())
                        ->where('item_batches.current_quantity', '!=', 0)
                        ->select('items.description', 'item_batches.current_quantity', 'measurement_units.short_name', 'item_batches.expiry_date')
                        ->get();
    }

}
