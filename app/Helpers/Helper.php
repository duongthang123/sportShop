<?php

namespace App\Helpers;

class Helper
{
    public static function categories($categories, $parent_id = 0, $char = "")
    {
        $html = '';

        foreach ($categories as $key => $category) {
            if($category->parent_id == $parent_id) {
                $html .= '
                <tr>
                        <td> '.$category->id .' </td>
                        <td> '. $char . $category->name .'  </td>
                        <td> '. self::active($category->active) .'  </td>
                        <td> '.$category->updated_at .'  </td>
                        <td>
                            <a href="'. route('categories.edit', $category->id) .'" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="removeRow(\'/categories/'. $category->id .'\')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($categories[$key]);
                $html .= self::categories($categories, $category->id, $char.'|-----');
            }
        }
        return $html;
    }

    public static function active($active = 0)
    {
        return $active == 0 ? '<span class="btn btn-danger btn-sm">No</span>' : '<span class="btn btn-success btn-sm">Yes</span>';
    }
}
