<?php namespace App\Services;

use Baum\Node;

class RenderCategoriManager
{
    public function renderTree($tree)
    {
       if( $tree->IsLeaf() ){
           return '<li data-id="'.$tree->id.'""><h3><span id="dell"><button type="button" class="btn btn-danger btn-xs">Удалить</button></span>'.$tree->name.'</h3></li>';
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
            if ($category->isLeaf()) {
                echo '<option value="' . $category->id . '">' . $category->name . '</option>';
            } else {
                echo '<option  value="' . $category->id . '" disabled="disabled">' . $category->name . '</option>';
                $this->CategoryFilter($category->children);
            }
        }
    }
}