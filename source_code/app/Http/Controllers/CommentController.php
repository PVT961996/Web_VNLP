<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 12/11/2017
 * Time: 5:03 PM
 */
namespace App\Http\Controllers;

class CommentController extends Controller
{
    protected $products;

    /**
     * @return mixed
     */
    public function index(){
       return view('comment');
    }
}
