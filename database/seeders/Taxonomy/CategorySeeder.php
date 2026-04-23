<?php

namespace Database\Seeders\Taxonomy;

use App\Domains\Taxonomy\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $categories = [];
        $translations = [];

        // helper to add categories and their translations
        $addCategory = function ($id, $parentId, $slug, $taxonomy, $en, $ps, $fa) use (&$categories, &$translations, $now) {
            $categories[] = [
                'id' => $id,
                'parent_id' => $parentId,
                'slug' => $slug,
                'taxonomy' => $taxonomy,
                'root_at' => $id === 1 ? $now : null,
                'fixed_at' => $id === 1 ? $now : null,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $locales = ['en' => $en, 'ps' => $ps, 'fa' => $fa];
            foreach ($locales as $locale => $title) {
                $translations[] = [
                    'category_id' => $id,
                    'locale' => $locale,
                    'title' => $title,
                ];
            }
        };

        // insert the Root "None" Category
        $addCategory(1, 0,  '', null, 'None', 'هیڅ یو نه', 'هیچ کدام نه');


        // final Bulk Insert
        DB::transaction(function () use ($categories, $translations) {
            DB::table('categories')->insert($categories);
            DB::table('category_translations')->insert($translations);
        });

        // rebuild the tree & update tree depth
        $this->rebuildTree(0, 0);
        $this->updateTreeDepth();
    }

    /**
     * rebuild the tree structure
     */
    protected function rebuildTree($parentId, $left)
    {
        // the right value of this node is left + 1
        $right = $left + 1;

        // get all the children for this node
        $children = Category::where('parent_id', $parentId)
            ->orderBy('lft', 'asc')
            ->get();

        // recursive execution of this function for each of thechildren
        // $right is the current right value, which is incremented by this function
        foreach ($children as $child) {
            $right = $this->rebuildTree($child->id, $right);
        }

        // update the lft & rgt values of the node
        Category::where('id', $parentId)->update(['lft' => $left, 'rgt' => $right]);

        // return the right value of this node + 1
        return $right + 1;
    }

    /**
     * update the depth of every node in the tree
     */
    protected function updateTreeDepth()
    {
        $rows = Category::all();

        foreach ($rows as $row) {
            // calculate the depth of the node
            $depth = (int) Category::where(
                [
                    ['lft', '<', $row->lft],
                    ['rgt', '>', $row->rgt],
                    ['root_at', '=', null],
                ]
            )->count();

            // update the depth of this node
            Category::where('id', $row->id)->update(['depth' => $depth]);
        }
    }
}
