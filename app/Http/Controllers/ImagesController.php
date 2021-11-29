<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    private $images;

    public function __construct(ImageService $imageService)
    {
        $this->images = $imageService;
    }
    //вывод галлереи на главной странице
    public function index() {
        $myImages = $this->images->all();
        return view('index', ['imagesInView' => $myImages]);
    }

    //добавление картинки в галлерею
    public function create() {
        return view('create');
    }

    //просмотр одной картинки в галлереи
    public function show($id){
        $image = $this->images->select_one($id);
        return view('show', ['imageInView' => $image->image]);
    }

    //добавление картинки в БД
    //Request - получить экземпляр текущего HTTP-запроса
    public function store(Request $request){
        $image = $request->file('image');
        $this->images->add_img($image);
        return redirect('/');
    }

    //выбор картинки для замены
    public function edit($id){
        $image = $this->images->select_one($id);
        return view('edit', ['imageInView' => $image]);
    }

    //замена картинки
    public function update(Request $request, $id){
        $this->images->update($request->image, $id);
        return redirect('/');    
    }

    //удаление картинки
    public function delete($id){
        $this->images->delete($id);
        return redirect('/');
    }
}
