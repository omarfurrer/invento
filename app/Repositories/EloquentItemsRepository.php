<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Models\Item;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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

            $model = $this->find($id);

            if (!$this->_deleteImage($model)) {
                return false;
            }
            $image = $fields['image'];
            $imagePath = $image->store('images/items', 'public');
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

}
