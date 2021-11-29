<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * 
 */
class ImageService 
{
	//вывод всех картинок
	public function all()
	{
		$images = DB::table('images')->select('*')->get();
        $myImages = $images->all();
        return $myImages;
	}
	//вывод одной картинки
	public function select_one($id)
	{
		$image = DB::table('images')->select('*')->where('id', $id)->first();
        return $image;
	}
	
	//добавление картинки
    public function add_img($image)
    {
    	$filename = $image->store('uploads');
        DB::table('images')
            ->insert(['image' => $filename]);
    }

	//замена картинки
    public function update($new_image, $id){
        //по id выбираем картинку в бд
        $image = $this->select_one($id);
        //удаляем ее
        Storage::delete($image->image);
        //из формы генерируем название новой картинки в папке на сервере
        $filename = $new_image->store('uploads');
        //сохраняем в БД
        DB::table('images')
            ->where('id', $id)
            ->update(['image' => $filename]);
    }

    //удаление картинки
	public function delete($id){
        //по id выбираем картинку в бд
        $image = $this->select_one($id);
        //удаляем ее с сервера
        Storage::delete($image->image);
        //удаляем запись из БД
        DB::table('images')->where('id', $id)->delete();
    }
}