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
}