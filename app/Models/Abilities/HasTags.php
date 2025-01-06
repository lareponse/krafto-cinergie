<?php
namespace App\Models\Abilities;

use \HexMakina\kadro\Models\Tag;

trait HasTags
{
    abstract public function tagIds(): array;
    
    public function tags($ids=null): array
    {
        $ids ??= $this->tagIds();
        
        $flat_ids = [];

        foreach($ids as $id_or_ids){
            if(is_array($id_or_ids))
                $flat_ids = array_merge($flat_ids, $id_or_ids);
            else $flat_ids []= $id_or_ids;
        }
        
        return Tag::any(['ids' => $flat_ids]);
    }

    public function tagsByParent($parent_id): array
    {
        return Tag::any(['parent_id' => $parent_id]);
    }

}