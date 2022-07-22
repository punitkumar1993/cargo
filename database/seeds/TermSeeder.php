<?php

use Illuminate\Database\Seeder;

use App\Models\Term;
use App\Models\TermTaxonomy;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create category
        $terms_category = Term::create(['name' => 'Uncategorized','slug' => 'uncategorized']);
        $term_category = Term::find($terms_category->id);
        $term_category->taxonomy()->create(['taxonomy'=>'category','parent'=> 0]);

        $terms_category = Term::create(['name' => 'News','slug' => 'news']);
        $term_category = Term::find($terms_category->id);
        $term_category->taxonomy()->create(['taxonomy'=>'category','parent'=> 0]);

        $terms_category = Term::create(['name' => 'Technology','slug' => 'technology']);
        $term_category = Term::find($terms_category->id);
        $term_category->taxonomy()->create(['taxonomy'=>'category','parent'=> 0]);

        $terms_category = Term::create(['name' => 'Business','slug' => 'business']);
        $term_category = Term::find($terms_category->id);
        $term_category->taxonomy()->create(['taxonomy'=>'category','parent'=> 0]);

        $terms_category = Term::create(['name' => 'Marketplace','slug' => 'marketplace']);
        $term_category = Term::find($terms_category->id);
        $term_category->taxonomy()->create(['taxonomy'=>'category','parent'=> 0]);


        // create tag
        $terms_tag = Term::create(['name' => 'Untag','slug' => 'untag']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Social Media','slug' => 'social-media']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Facebook','slug' => 'facebook']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Donald Trump','slug' => 'donald-trump']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'United States','slug' => 'united-states']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'China','slug' => 'china']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Beauty','slug' => 'beauty']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Fashion','slug' => 'fashion']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Lifestyle','slug' => 'lifestyle']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Couple','slug' => 'couple']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Romantice','slug' => 'romantice']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Stay Home','slug' => 'stay-home']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Explore Bali','slug' => 'explore-bali']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Startups','slug' => 'startups']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Investments','slug' => 'investments']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Envato','slug' => 'envato']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Creative Market','slug' => 'creative-market']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Digital Creative','slug' => 'digital-creative']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Framework','slug' => 'framework']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'Bootstrap','slug' => 'bootstrap']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'HTML','slug' => 'html']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

        $terms_tag = Term::create(['name' => 'CSS','slug' => 'css']);
        $term_tag = Term::find($terms_tag->id);
        $term_tag->taxonomy()->create(['taxonomy'=>'tag','parent'=> 0]);

    }
}
