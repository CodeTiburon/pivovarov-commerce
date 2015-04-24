<?php namespace App\Services;

use App\Categori;
use Baum\Node;

class RenderCategoriManager extends Categori{

    public function hello(){
        return "hello";
    }


    public function renderTree($tree)
    {
       if( $tree->IsLeaf() ){
           return '<li data-id="'.$tree->id.'"">'.$tree->name.'</li>';
       }
       else{
            $html ='<li data-id="'.$tree->id.'"">'.$tree->name;

            $html .= '<ul>';

             foreach($tree->children as $child)
                 $html .= $this->renderTree($child);

           $html .= '</ul>';

           $html .= '</li>';

       }

        return $html;
    }
}