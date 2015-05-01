<?php namespace App\Services;

use Baum\Node;

class RenderCategoriManager
{
    public function renderTree($tree)
    {
       if( $tree->IsLeaf() ){
           return '<li  data-id="'.$tree->id.'""><h3><span id="dell"><button type="button" class="btn btn-danger btn-xs">Удалить</button></span>'.$tree->name.'</h3></li>';
       }
       else{
            $html ='<li data-id="'.$tree->id.'""><h3><span id="dell"><button type="button" class="btn btn-danger btn-xs">Удалить</button></span>'.$tree->name.'</h3>';

            $html .= '<ul>';

             foreach($tree->children as $child)
                 $html .= $this->renderTree($child);

           $html .= '</ul>';

           $html .= '</li>';

       }

        return $html;
    }

    public function tokenEncrypt(){
        {
            $encrypter = app('Illuminate\Encryption\Encrypter');
            $encrypted_token = $encrypter->encrypt(csrf_token());
            return $encrypted_token;
        }
    }

    public function CategoryFilter($tree)
    {
        foreach($tree as $category) {
            $character = '&larr;';
            if ($category->isLeaf()) {
                echo '<option value="' . $category->id . '">'.str_repeat($character,$category->depth) . $category->name . '</option>';
            } else {
                echo '<option value="' . $category->id . '" disabled="disabled">'.str_repeat($character,$category->depth). $category->name . '</option>';
                $this->CategoryFilter($category->children);
            }
        }
    }
    public function CategoryCrumbs($products)
    {
        foreach($products as $product) {
            echo '<div class="product" >>' . ucfirst($product->name) .  '</div>';
            $categories = $product->ProductToCategory()->get();
            foreach ($categories as $category) {
//                echo '<br/>';
                  echo '<div class="crum"> <ul class="breadcrumb">';
                foreach ($category->getAncestorsAndSelf() as $crumb) {
//                    echo $crumb->name . '/';
                    echo '<li class="add_form">' . $crumb->name . '<span class="divider"></span></li>';
                }
                echo '</ul></div>';
            }
        }
    }
}